<?php
/**
 * Slider Image Compressor / Optimizer
 * 
 * This script compresses WebP images inside the public/slider directory.
 * It resizes large images to a maximum width of 1600px and reduces quality to fit within 250KB.
 * Original files are backed up in a subdirectory named 'original'.
 */

ini_set('memory_limit', '1024M');

$targetDir = __DIR__ . '/public/slider';
$targetSize = 256000; // 250 KB in bytes
$maxWidth = 1600; // Max width in pixels

echo "=========================================\n";
echo "   Slider Image Compressor & Optimizer   \n";
echo "=========================================\n\n";

if (!is_dir($targetDir)) {
    echo "Error: Target directory not found: $targetDir\n";
    exit(1);
}

// Create backup directory
$backupDir = $targetDir . '/original';
if (!is_dir($backupDir)) {
    if (!mkdir($backupDir, 0755, true)) {
        echo "Error: Failed to create backup directory: $backupDir\n";
        exit(1);
    }
}

function optimizeWebPImage($source, $destination, $targetSize, $maxWidth) {
    if (!function_exists('imagecreatefromwebp') || !function_exists('imagewebp')) {
        echo "[GD WebP not supported by PHP installation] ";
        return false;
    }

    $image = @imagecreatefromwebp($source);
    if (!$image) {
        echo "[Failed to read WebP image] ";
        return false;
    }

    // Get current dimensions
    $width = imagesx($image);
    $height = imagesy($image);
    
    // Resize if larger than max width
    if ($width > $maxWidth) {
        $newWidth = $maxWidth;
        $newHeight = intval($height * ($newWidth / $width));
        
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        
        // Preserve transparency for WebP
        imagealphablending($newImage, false);
        imagesavealpha($newImage, true);
        
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagedestroy($image);
        $image = $newImage;
    } else {
        // Preserve transparency for WebP
        imagealphablending($image, false);
        imagesavealpha($image, true);
    }

    // Iterative quality reduction loop for WebP
    $quality = 80;
    $minQuality = 45;
    $tempFile = $destination . '.temp';
    
    do {
        imagewebp($image, $tempFile, $quality);
        
        clearstatcache();
        $size = filesize($tempFile);
        
        if ($size <= $targetSize || $quality <= $minQuality) {
            break;
        }
        
        $quality -= 5;
    } while ($quality >= $minQuality);

    if (file_exists($tempFile)) {
        if (file_exists($destination)) {
            unlink($destination);
        }
        rename($tempFile, $destination);
        imagedestroy($image);
        return true;
    }
    
    imagedestroy($image);
    return false;
}

$files = scandir($targetDir);
$successCount = 0;
$skippedCount = 0;
$totalOriginalSize = 0;
$totalCompressedSize = 0;

echo "Target Directory: $targetDir\n";
echo "Backup Directory: $backupDir\n\n";

foreach ($files as $file) {
    if ($file === '.' || $file === '..' || $file === 'original') {
        continue;
    }
    
    $filePath = $targetDir . '/' . $file;
    if (is_dir($filePath)) {
        continue;
    }

    $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    if ($ext !== 'webp') {
        $skippedCount++;
        continue;
    }

    $originalSize = filesize($filePath);
    $totalOriginalSize += $originalSize;
    
    echo "Optimizing: $file (" . round($originalSize / 1024, 1) . " KB)... ";

    // Move original to backup if not already there
    $backupPath = $backupDir . '/' . $file;
    if (!file_exists($backupPath)) {
        if (!copy($filePath, $backupPath)) {
            echo "Failed to create backup copy. Skipping.\n";
            continue;
        }
    }

    // Optimize using backup as source, writing back to target location
    if (optimizeWebPImage($backupPath, $filePath, $targetSize, $maxWidth)) {
        clearstatcache();
        $newSize = filesize($filePath);
        $totalCompressedSize += $newSize;
        $saved = $originalSize - $newSize;
        $savedPercent = ($originalSize > 0) ? round(($saved / $originalSize) * 100, 1) : 0;
        
        echo "Done! " . round($newSize / 1024, 1) . " KB (Reduced by $savedPercent%)\n";
        $successCount++;
    } else {
        echo "Failed.\n";
        $totalCompressedSize += $originalSize;
    }
}

echo "\n=========================================\n";
echo "             Summary Report              \n";
echo "=========================================\n";
echo "Successfully optimized: $successCount images\n";
echo "Skipped non-webp files:  $skippedCount\n";
if ($totalOriginalSize > 0) {
    $totalSaved = $totalOriginalSize - $totalCompressedSize;
    $totalSavedPercent = round(($totalSaved / $totalOriginalSize) * 100, 1);
    echo "Total Original Size:   " . round($totalOriginalSize / (1024 * 1024), 2) . " MB\n";
    echo "Total Compressed Size: " . round($totalCompressedSize / (1024 * 1024), 2) . " MB\n";
    echo "Total Space Saved:     " . round($totalSaved / (1024 * 1024), 2) . " MB ($totalSavedPercent%)\n";
}
echo "=========================================\n";
