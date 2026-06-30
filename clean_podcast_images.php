<?php
/**
 * Podcast Image Cleaner
 * 
 * This script removes any image in storage/app/public/podcast whose size is larger than 300KB.
 */

$targetDir = __DIR__ . '/storage/app/public/podcast';
$maxSizeBytes = 300 * 1024; // 300 KB in bytes

echo "=========================================\n";
echo "      Podcast Image Size Cleaner         \n";
echo "=========================================\n\n";

if (!is_dir($targetDir)) {
    echo "Error: Target directory not found: $targetDir\n";
    exit(1);
}

$files = scandir($targetDir);
$removedCount = 0;
$keptCount = 0;

foreach ($files as $file) {
    if ($file === '.' || $file === '..' || $file === 'original') {
        continue;
    }
    
    $filePath = $targetDir . '/' . $file;
    if (is_dir($filePath)) {
        continue;
    }

    $size = filesize($filePath);
    $sizeKB = round($size / 1024, 1);

    if ($size > $maxSizeBytes) {
        echo "Removing: $file ({$sizeKB} KB) - Exceeds 300 KB limit... ";
        if (unlink($filePath)) {
            echo "Removed successfully.\n";
            $removedCount++;
        } else {
            echo "Failed to remove.\n";
        }
    } else {
        echo "Keeping: $file ({$sizeKB} KB)\n";
        $keptCount++;
    }
}

echo "\n=========================================\n";
echo "             Summary Report              \n";
echo "=========================================\n";
echo "Total files kept:    $keptCount\n";
echo "Total files removed: $removedCount\n";
echo "=========================================\n";
