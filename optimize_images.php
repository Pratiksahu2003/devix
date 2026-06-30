<?php
ini_set('memory_limit', '1024M');

$directories = [
    __DIR__ . '/public/storage/room',
    __DIR__ . '/public/storage/studio',
    __DIR__ . '/public/storage/podcast',
];

$targetSize = 81920; // 80 KB in bytes
$maxWidth = 1000;    // Max width in pixels

function optimizeImage($source, $destination, $targetSize, $maxWidth) {
    $optimized = false;

    // Method A: Imagick
    if (class_exists(\Imagick::class)) {
        try {
            $imagick = new \Imagick($source);
            $format = strtolower($imagick->getImageFormat());
            
            // Adjust geometry
            $geometry = $imagick->getImageGeometry();
            if ($geometry['width'] > $maxWidth) {
                $newHeight = intval($geometry['height'] * ($maxWidth / $geometry['width']));
                $imagick->resizeImage($maxWidth, $newHeight, \Imagick::FILTER_LANCZOS, 1);
            }
            
            // Quality reduction loop
            $quality = 85;
            $minQuality = 40;
            $tempFile = $destination . '.temp';

            do {
                $imagick->setImageCompressionQuality($quality);
                $imagick->writeImage($tempFile);
                clearstatcache();
                $size = filesize($tempFile);
                if ($size <= $targetSize || $quality <= $minQuality || in_array($format, ['png'])) {
                    break;
                }
                $quality -= 5;
            } while ($quality >= $minQuality);

            if (file_exists($tempFile)) {
                if (file_exists($destination)) {
                    unlink($destination);
                }
                rename($tempFile, $destination);
                $imagick->clear();
                $imagick->destroy();
                return true;
            }
            $imagick->clear();
            $imagick->destroy();
        } catch (\Throwable $e) {
            echo "[Imagick failed: " . $e->getMessage() . "] ";
        }
    }

    // Method B: GD (Fallback)
    $info = getimagesize($source);
    if ($info === false) return false;

    // Load image
    switch ($info['mime']) {
        case 'image/jpeg':
            if (!function_exists('imagecreatefromjpeg')) return false;
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
            if (!function_exists('imagecreatefrompng')) return false;
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
        imagedestroy($image);
        return true;
    }
    
    imagedestroy($image);
    return false;
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
        if (optimizeImage($backupPath, $filePath, $targetSize, $maxWidth)) {
            echo "Done. Size: " . round(filesize($filePath) / 1024) . "KB\n";
        } else {
            echo "Failed.\n";
        }
    }
}

echo "All tasks completed.\n";
