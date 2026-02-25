<?php
ini_set('memory_limit', '512M');

$directories = [
    __DIR__ . '/public/pooja',
    __DIR__ . '/public/vidhu',
    __DIR__ . '/public/studio',
    __DIR__ . '/public/brand',
    __DIR__ . '/public/logo',
    __DIR__ . '/public/logo/fav'
];

function optimizeImage($source, $destination, $quality = 80, $maxWidth = 1200) {
    $info = getimagesize($source);
    if ($info === false) return false;

    switch ($info['mime']) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source);
            break;
        case 'image/png':
            $image = imagecreatefrompng($source);
            break;
        default:
            return false;
    }

    if (!$image) return false;

    // Preserve transparency for PNG
    if ($info['mime'] == 'image/png') {
        imagealphablending($image, false);
        imagesavealpha($image, true);
    }

    // Save optimized image directly
    if ($info['mime'] == 'image/jpeg') {
        imagejpeg($image, $destination, $quality);
    } elseif ($info['mime'] == 'image/png') {
        // PNG quality is 0-9, where 0 is no compression. Map 0-100 to 0-9 roughly.
        // Actually, for PNG, it's compression level (0-9). 
        // Let's use default for PNG to avoid quality loss issues.
        imagepng($image, $destination, 9);
    }

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

        // Optimize
        if (optimizeImage($backupPath, $filePath)) {
            echo "Done.\n";
        } else {
            echo "Failed.\n";
        }
    }
}

echo "All tasks completed.\n";
