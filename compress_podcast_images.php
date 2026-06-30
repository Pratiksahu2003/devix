<?php
/**
 * Podcast Image Compressor / Optimizer
 * 
 * This script compresses JPG, JPEG, and PNG images inside the storage/app/public/podcast directory.
 * It resizes large images to a maximum width of 1500px and reduces quality iteratively to fit within 200KB.
 * Original files are backed up in a subdirectory named 'original'.
 */

ini_set('memory_limit', '1024M');

$targetDir = __DIR__ . '/storage/app/public/podcast';
$targetSize = 204800; // 200 KB in bytes
$maxWidth = 1500; // Max width in pixels

echo "=========================================\n";
echo "  Podcast Image Compressor & Optimizer   \n";
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

function optimizeImage($source, $destination, $targetSize, $maxWidth) {
    $info = getimagesize($source);
    if ($info === false) {
        return false;
    }

    // Load image based on mime type
    switch ($info['mime']) {
        case 'image/jpeg':
            if (!function_exists('imagecreatefromjpeg')) {
                echo "[GD JPEG not supported] ";
                return false;
            }
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
            if (!function_exists('imagecreatefrompng')) {
                echo "[GD PNG not supported] ";
                return false;
            }
            $image = imagecreatefrompng($source);
            break;
        default:
            echo "[Unsupported format: " . $info['mime'] . "] ";
            return false;
    }

    if (!$image) {
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

    // Iterative quality reduction loop for JPEGs
    $quality = 85;
    $minQuality = 40;
    $tempFile = $destination . '.temp';
    
    do {
        if ($info['mime'] == 'image/jpeg') {
            imagejpeg($image, $tempFile, $quality);
        } elseif ($info['mime'] == 'image/png') {
            // PNG compression level (0-9)
            imagepng($image, $tempFile, 9);
        }
        
        clearstatcache();
        $size = filesize($tempFile);
        
        if ($size <= $targetSize || $quality <= $minQuality || $info['mime'] == 'image/png') {
            break;
        }
        
        $quality -= 5;
    } while ($quality >= $minQuality);

    if (file_exists($tempFile)) {
        if (file_exists($destination)) {
            unlink($destination);
        }
        rename($tempFile, $destination);
    }
    
    imagedestroy($image);
    return true;
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
    if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
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
    if (optimizeImage($backupPath, $filePath, $targetSize, $maxWidth)) {
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
echo "Skipped/Non-image files: $skippedCount\n";
if ($totalOriginalSize > 0) {
    $totalSaved = $totalOriginalSize - $totalCompressedSize;
    $totalSavedPercent = round(($totalSaved / $totalOriginalSize) * 100, 1);
    echo "Total Original Size:   " . round($totalOriginalSize / (1024 * 1024), 2) . " MB\n";
    echo "Total Compressed Size: " . round($totalCompressedSize / (1024 * 1024), 2) . " MB\n";
    echo "Total Space Saved:     " . round($totalSaved / (1024 * 1024), 2) . " MB ($totalSavedPercent%)\n";
}
echo "=========================================\n";
