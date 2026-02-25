<?php
ini_set('memory_limit', '1024M');

$directories = [
    __DIR__ . '/public/storage/pooja',
    __DIR__ . '/public/storage/studio'
];

function optimizeImage($source, $destination, $targetSize = 204800, $maxWidth = 1500) {
    $info = getimagesize($source);
    if ($info === false) return false;

    // Load image
    switch ($info['mime']) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source);
            // Handle EXIF Orientation
            if (function_exists('exif_read_data')) {
                $exif = @exif_read_data($source);
                if ($exif && isset($exif['Orientation'])) {
                    $orientation = $exif['Orientation'];
                    switch ($orientation) {
                        case 3:
                            $image = imagerotate($image, 180, 0);
                            break;
                        case 6:
                            $image = imagerotate($image, -90, 0);
                            break;
                        case 8:
                            $image = imagerotate($image, 90, 0);
                            break;
                    }
                }
            }
            break;
        case 'image/png':
            $image = imagecreatefrompng($source);
            break;
        default:
            return false;
    }

    if (!$image) return false;

    // Get current dimensions
    $width = imagesx($image);
    $height = imagesy($image);
    
    // Initial resize if larger than max width
    // Use the orientation-corrected dimensions
    if ($width > $maxWidth) {
        $newWidth = $maxWidth;
        $newHeight = intval($height * ($newWidth / $width));
        
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        
        // Preserve transparency for PNG
        if ($info['mime'] == 'image/png') {
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
        }
        
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagedestroy($image);
        $image = $newImage;
    }

    // Preserve transparency for PNG
    if ($info['mime'] == 'image/png') {
        imagealphablending($image, false);
        imagesavealpha($image, true);
    }

    // Iterative quality reduction loop
    $quality = 85;
    $minQuality = 40;
    $tempFile = $destination . '.temp';
    
    do {
        if ($info['mime'] == 'image/jpeg') {
            imagejpeg($image, $tempFile, $quality);
        } elseif ($info['mime'] == 'image/png') {
            // PNG compression 0-9. 
            // PNG is lossless-ish, so quality parameter in imagepng is compression level.
            // It doesn't affect size as dramatically as JPEG quality.
            // We'll stick to max compression (9).
            imagepng($image, $tempFile, 9);
            // If it's PNG and too big, we might need to convert to JPEG or resize more, 
            // but for now let's just break if it's PNG as we can't do much more with standard GD.
            if (filesize($tempFile) > $targetSize) {
                 // Optional: Convert to JPEG if transparency not critical? 
                 // But let's assume we keep format.
            }
        }
        
        clearstatcache();
        $size = filesize($tempFile);
        
        if ($size <= $targetSize || $quality <= $minQuality) {
            break;
        }
        
        $quality -= 5;
    } while ($quality >= $minQuality);

    // If still too big and we hit min quality, we could resize down further, 
    // but for now let's accept the result to avoid infinite loops or tiny images.
    
    rename($tempFile, $destination);
    imagedestroy($image);

    return true;
}

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        echo "Directory not found: $dir\n";
        continue;
    }

    echo "Processing directory: $dir\n";
    
    // Create backup directory
    $backupDir = $dir . '/original';
    if (!is_dir($backupDir)) {
        mkdir($backupDir, 0755, true);
    }

    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..' || $file === 'original') continue;
        
        $filePath = $dir . '/' . $file;
        if (is_dir($filePath)) continue;

        // Check if image
        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png'])) continue;

        echo "Optimizing: $file... ";

        // Move original to backup if not already there
        $backupPath = $backupDir . '/' . $file;
        if (!file_exists($backupPath)) {
            copy($filePath, $backupPath);
        }

        // Optimize using BACKUP as source
        if (optimizeImage($backupPath, $filePath)) {
            echo "Done. Size: " . round(filesize($filePath) / 1024) . "KB\n";
        } else {
            echo "Failed.\n";
        }
    }
}

echo "All tasks completed.\n";
