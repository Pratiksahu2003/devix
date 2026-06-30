<?php
/**
 * Logo and Brand Image Compressor / Optimizer (PNG to WebP)
 * 
 * This script resizes and converts logo.png and brand images to WebP format.
 * - Main logo: max width 300px
 * - Client brand logos: max width 150px
 */

ini_set('memory_limit', '1024M');

$logoSource = __DIR__ . '/public/logo/logo.png';
$logoDest = __DIR__ . '/public/logo/logo.webp';
$brandDir = __DIR__ . '/public/brand';

echo "=========================================\n";
echo "   Logo & Brand Optimizer (PNG -> WebP)  \n";
echo "=========================================\n\n";

function optimizePngToWebp($source, $destination, $maxWidth) {
    if (!file_exists($source)) {
        echo "[Source file not found] ";
        return false;
    }

    // Method A: Imagick
    if (class_exists(\Imagick::class)) {
        try {
            $imagick = new \Imagick($source);
            $imagick->setImageFormat('webp');
            $geometry = $imagick->getImageGeometry();
            if ($geometry['width'] > $maxWidth) {
                $newHeight = intval($geometry['height'] * ($maxWidth / $geometry['width']));
                $imagick->resizeImage($maxWidth, $newHeight, \Imagick::FILTER_LANCZOS, 1);
            }
            $imagick->setImageCompressionQuality(80);
            $imagick->writeImage($destination);
            $imagick->clear();
            $imagick->destroy();
            return true;
        } catch (\Throwable $e) {
            echo "[Imagick failed: " . $e->getMessage() . "] ";
        }
    }

    // Method B: GD
    if (function_exists('imagecreatefrompng') && function_exists('imagewebp')) {
        try {
            $image = @imagecreatefrompng($source);
            if ($image) {
                $width = imagesx($image);
                $height = imagesy($image);

                if ($width > $maxWidth) {
                    $newWidth = $maxWidth;
                    $newHeight = intval($height * ($newWidth / $width));
                    $newImage = imagecreatetruecolor($newWidth, $newHeight);
                    imagealphablending($newImage, false);
                    imagesavealpha($newImage, true);
                    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagedestroy($image);
                    $image = $newImage;
                } else {
                    imagealphablending($image, false);
                    imagesavealpha($image, true);
                }

                @imagewebp($image, $destination, 80);
                imagedestroy($image);
                return file_exists($destination);
            }
        } catch (\Throwable $e) {
            echo "[GD failed: " . $e->getMessage() . "] ";
        }
    }

    return false;
}

// 1. Optimize Main Logo
if (file_exists($logoSource)) {
    echo "Optimizing main logo... ";
    if (optimizePngToWebp($logoSource, $logoDest, 300)) {
        echo "Done! Saved to logo.webp (" . round(filesize($logoDest) / 1024, 1) . " KB)\n";
    } else {
        echo "Failed.\n";
    }
} else {
    echo "Main logo not found at $logoSource\n";
}

// 2. Optimize Brand Logos
if (is_dir($brandDir)) {
    echo "\nScanning brand logos in: $brandDir\n";
    $files = scandir($brandDir);
    $success = 0;
    foreach ($files as $file) {
        if ($file === '.' || $file === '..' || strtolower(pathinfo($file, PATHINFO_EXTENSION)) !== 'png') {
            continue;
        }
        $sourcePath = $brandDir . '/' . $file;
        $destPath = $brandDir . '/' . pathinfo($file, PATHINFO_FILENAME) . '.webp';
        
        echo "Optimizing brand logo: $file... ";
        if (optimizePngToWebp($sourcePath, $destPath, 150)) {
            echo "Done! Saved to " . basename($destPath) . " (" . round(filesize($destPath) / 1024, 1) . " KB)\n";
            $success++;
        } else {
            echo "Failed.\n";
        }
    }
    echo "Optimized $success brand logos.\n";
} else {
    echo "Brand directory not found at $brandDir\n";
}

echo "\nAll tasks completed.\n";
