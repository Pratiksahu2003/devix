<?php

$targetDir = __DIR__ . '/storage/app/public/bts';
$backupDir = $targetDir . '/original';

// Check if ffmpeg is installed
$ffmpegPath = 'ffmpeg';
if (file_exists(__DIR__ . '/ffmpeg.exe')) {
    $ffmpegPath = realpath(__DIR__ . '/ffmpeg.exe');
} elseif (file_exists(__DIR__ . '/bin/ffmpeg.exe')) {
    $ffmpegPath = realpath(__DIR__ . '/bin/ffmpeg.exe');
}

echo "Using FFmpeg path: $ffmpegPath\n";

$cmd = "\"$ffmpegPath\" -version";
exec($cmd, $output, $returnVar);

if ($returnVar !== 0) {
    echo "Error: FFmpeg execution failed.\n";
    echo "Command tried: $cmd\n";
    echo "Output:\n";
    print_r($output);
    echo "Please install FFmpeg to compress videos.\n";
    echo "Download from: https://ffmpeg.org/download.html\n";
    echo "Or place ffmpeg.exe in the project root.\n";
    exit(1);
} else {
    echo "FFmpeg version verified.\n";
}

if (!is_dir($targetDir)) {
    echo "Target directory not found: $targetDir\n";
    exit(1);
}

if (!is_dir($backupDir)) {
    mkdir($backupDir, 0755, true);
}

$videoExtensions = ['mp4', 'mov', 'avi', 'mkv', 'webm'];

echo "Scanning for videos in: $targetDir\n";

// Recursive scan
$directoryIterator = new RecursiveDirectoryIterator($targetDir, RecursiveDirectoryIterator::SKIP_DOTS);
$iterator = new RecursiveIteratorIterator($directoryIterator);

foreach ($iterator as $file) {
    if ($file->isDir()) continue;
    
    $filePath = $file->getPathname();
    
    // Skip original backup folder and temp files
    if (strpos($filePath, DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR) !== false) continue;
    if (strpos($file->getFilename(), 'temp_') === 0) continue;

    $ext = strtolower($file->getExtension());
    if (!in_array($ext, $videoExtensions)) continue;

    echo "Processing: " . $file->getFilename() . "\n";
    echo "  Path: $filePath\n";

    $originalSize = filesize($filePath);
    
    // Create mirrored backup path
    $relativePath = substr($filePath, strlen($targetDir));
    $backupPath = $backupDir . $relativePath;
    $backupPathDir = dirname($backupPath);
    
    if (!is_dir($backupPathDir)) {
        mkdir($backupPathDir, 0755, true);
    }

    // Move original to backup if not already there
    if (!file_exists($backupPath)) {
        copy($filePath, $backupPath);
    }

    // Get video duration to calculate target bitrate
    $cmd = "\"$ffmpegPath\" -i \"$backupPath\" 2>&1";
    exec($cmd, $output, $returnVar);
    $duration = 0;
    foreach ($output as $line) {
        if (preg_match('/Duration: (\d{2}):(\d{2}):(\d{2})\.(\d{2})/', $line, $matches)) {
            $duration = ($matches[1] * 3600) + ($matches[2] * 60) + $matches[3] + ($matches[4] / 100);
            break;
        }
    }

    if ($duration <= 0) {
        echo "  Could not determine duration. Skipping custom compression logic.\n";
        continue;
    }

    // Target size calculation (Aim for 300-700KB range)
    // We target 500KB.
    $targetSizeKB = 500;
    $maxSizeKB = 680; // Hard limit below 700KB
    
    $targetBits = $targetSizeKB * 8192; 
    $maxBits = $maxSizeKB * 8192;
    
    $totalBitrate = $targetBits / $duration;
    $maxTotalBitrate = $maxBits / $duration;
    
    // Audio bitrate
    $audioBitrate = 48000; // 48k to save space
    
    // Video bitrate
    $videoBitrate = $totalBitrate - $audioBitrate;
    $maxVideoBitrate = $maxTotalBitrate - $audioBitrate;
    
    // Minimum video bitrate safety
    if ($videoBitrate < 30000) {
        $videoBitrate = 30000;
        // If we are forced to go very low, we might exceed target size, but we can't produce 0 bitrate video.
    }

    // Resolution scaling based on bitrate to maintain perceptual quality
    $scaleFilter = "";
    if ($videoBitrate < 150000) { // < 150kbps -> 360p
        $scaleFilter = "-vf scale=-2:360";
    } elseif ($videoBitrate < 400000) { // < 400kbps -> 480p
        $scaleFilter = "-vf scale=-2:480";
    } else { // >= 400kbps -> Keep resolution or max 720p
        $scaleFilter = "-vf \"scale='min(1280,iw)':-2\"";
    }

    $videoK = round($videoBitrate / 1000);
    $maxVideoK = round($maxVideoBitrate / 1000);
    $audioK = round($audioBitrate / 1000);

    echo "  Duration: {$duration}s\n";
    echo "  Target Bitrate: Video {$videoK}k (Max {$maxVideoK}k), Audio {$audioK}k\n";
    echo "  Scaling: " . ($scaleFilter ?: "None") . "\n";

    // Compress using ffmpeg with constrained bitrate
    $tempFile = dirname($filePath) . '/temp_' . $file->getFilename();
    
    $attempts = 0;
    $maxAttempts = 3;
    $currentVideoK = $videoK;
    $currentMaxVideoK = $maxVideoK;
    $currentScale = $scaleFilter;

    while ($attempts < $maxAttempts) {
        $attempts++;
        
        // Using -maxrate and -bufsize to strictly constrain size
        $command = sprintf(
            '"%s" -i "%s" -c:v libx264 -b:v %dk -maxrate %dk -bufsize %dk %s -c:a aac -b:a %dk -y "%s" 2>&1',
            $ffmpegPath,
            $backupPath,
            $currentVideoK,
            $currentMaxVideoK, 
            $currentMaxVideoK,   // Buffer size = max bitrate
            $currentScale,
            $audioK,
            $tempFile
        );

        $output = [];
        exec($command, $output, $returnVar);

        if ($returnVar === 0 && file_exists($tempFile)) {
            $newSize = filesize($tempFile);
            $sizeKB = round($newSize / 1024);
            
            if ($sizeKB > 700) {
                echo "  Attempt $attempts: Result {$sizeKB}KB > 700KB. reducing bitrate...\n";
                // Reduce bitrate by 40%
                $currentVideoK = round($currentVideoK * 0.6);
                $currentMaxVideoK = round($currentMaxVideoK * 0.6);
                // Force downscale if not already
                if (strpos($currentScale, '360') === false) {
                     if (strpos($currentScale, '480') === false) {
                         $currentScale = "-vf scale=-2:480";
                     } else {
                         $currentScale = "-vf scale=-2:360";
                     }
                }
                continue; // Retry
            }
            
            // Success or acceptable
            if (file_exists($filePath)) unlink($filePath); 
            rename($tempFile, $filePath);
            
            $reduction = round(($originalSize - $newSize) / 1024, 2);
            $percent = round(($originalSize - $newSize) / $originalSize * 100, 1);
            echo "  Compressed! Reduced by {$reduction} KB ({$percent}%)\n";
            echo "  Original: " . round($originalSize / 1024, 2) . " KB\n";
            echo "  New:      " . round($newSize / 1024, 2) . " KB\n";
            break; // Exit loop
            
        } else {
            echo "  Error compressing video.\n";
            if (file_exists($tempFile)) unlink($tempFile);
            break;
        }
    }
    
    echo "----------------------------------------\n";
}

echo "All videos processed.\n";
