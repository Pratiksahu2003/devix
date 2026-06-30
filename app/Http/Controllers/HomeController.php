<?php

namespace App\Http\Controllers;

use App\Services\FeaturedWorkService;
use App\Services\Seo\SeoMetaService;
use App\Services\Seo\SeoSchemaService;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the studio homepage.
     */
    public function __invoke(
        SeoMetaService $meta,
        SeoSchemaService $schema,
        FeaturedWorkService $featuredWork,
    ): View {
        $title = config('company.brand').' | Premier Podcast & Content Studio in Delhi NCR';
        $description = config('seo.defaults.site_description');
        $url = route('home');

        // Run automatic slider image optimizer once if not done yet
        $optimizedMarker = public_path('slider/.optimized');
        if (!file_exists($optimizedMarker)) {
            try {
                $targetDir = public_path('slider');
                $backupDir = $targetDir . '/original';
                if (!is_dir($backupDir)) {
                    @mkdir($backupDir, 0755, true);
                }

                if (is_dir($targetDir)) {
                    $files = scandir($targetDir);
                    $hasOptimizedAny = false;
                    foreach ($files as $file) {
                        if ($file === '.' || $file === '..' || $file === 'original' || strtolower(pathinfo($file, PATHINFO_EXTENSION)) !== 'webp') {
                            continue;
                        }
                        $filePath = $targetDir . '/' . $file;
                        if (is_file($filePath)) {
                            $backupPath = $backupDir . '/' . $file;
                            if (!file_exists($backupPath)) {
                                @copy($filePath, $backupPath);
                            }

                            $optimized = false;

                            // Method A: Imagick (usually available on production and has perfect WebP support)
                            if (class_exists(\Imagick::class)) {
                                try {
                                    $imagick = new \Imagick($backupPath);
                                    $imagick->setImageFormat('webp');
                                    $geometry = $imagick->getImageGeometry();
                                    if ($geometry['width'] > 1600) {
                                        $newHeight = intval($geometry['height'] * (1600 / $geometry['width']));
                                        $imagick->resizeImage(1600, $newHeight, \Imagick::FILTER_LANCZOS, 1);
                                    }
                                    $imagick->setImageCompressionQuality(75);
                                    $imagick->writeImage($filePath);
                                    $imagick->clear();
                                    $imagick->destroy();
                                    $optimized = true;
                                    $hasOptimizedAny = true;
                                } catch (\Throwable $imEx) {
                                    logger()->error('Imagick auto-optimization failed for ' . $file . ': ' . $imEx->getMessage());
                                }
                            }

                            // Method B: GD (Fallback)
                            if (!$optimized && function_exists('imagecreatefromwebp') && function_exists('imagewebp')) {
                                try {
                                    $image = @imagecreatefromwebp($backupPath);
                                    if ($image) {
                                        $width = imagesx($image);
                                        $height = imagesy($image);

                                        // Resize if larger than 1600px width
                                        if ($width > 1600) {
                                            $newWidth = 1600;
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

                                        $tempFile = $filePath . '.temp';
                                        @imagewebp($image, $tempFile, 75);
                                        if (file_exists($tempFile)) {
                                            @unlink($filePath);
                                            @rename($tempFile, $filePath);
                                        }
                                        imagedestroy($image);
                                        $optimized = true;
                                        $hasOptimizedAny = true;
                                    }
                                } catch (\Throwable $gdEx) {
                                    logger()->error('GD auto-optimization failed for ' . $file . ': ' . $gdEx->getMessage());
                                }
                            }
                        }
                    }
                    if ($hasOptimizedAny) {
                        @file_put_contents($optimizedMarker, date('Y-m-d H:i:s'));
                        Cache::forget('home_slider_slides');
                    }
                }

                // Run automatic logo & brand optimizer once if not done yet
                $logoMarker = public_path('logo/.optimized');
                if (!file_exists($logoMarker)) {
                    $logoSource = public_path('logo/logo.png');
                    $logoDest = public_path('logo/logo.webp');
                    $brandDir = public_path('brand');
                    
                    // Optimize main logo
                    if (file_exists($logoSource)) {
                        $optimized = false;
                        if (class_exists(\Imagick::class)) {
                            try {
                                $imagick = new \Imagick($logoSource);
                                $imagick->setImageFormat('webp');
                                $geometry = $imagick->getImageGeometry();
                                if ($geometry['width'] > 300) {
                                    $newHeight = intval($geometry['height'] * (300 / $geometry['width']));
                                    $imagick->resizeImage(300, $newHeight, \Imagick::FILTER_LANCZOS, 1);
                                }
                                $imagick->setImageCompressionQuality(80);
                                $imagick->writeImage($logoDest);
                                $imagick->clear();
                                $imagick->destroy();
                                $optimized = true;
                            } catch (\Throwable $imEx) {
                                logger()->error('Auto-optimization of logo.png via Imagick failed: ' . $imEx->getMessage());
                            }
                        }
                        if (!$optimized && function_exists('imagecreatefrompng') && function_exists('imagewebp')) {
                            try {
                                $image = @imagecreatefrompng($logoSource);
                                if ($image) {
                                    $width = imagesx($image);
                                    $height = imagesy($image);
                                    if ($width > 300) {
                                        $newWidth = 300;
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
                                    @imagewebp($image, $logoDest, 80);
                                    imagedestroy($image);
                                }
                            } catch (\Throwable $gdEx) {
                                logger()->error('Auto-optimization of logo.png via GD failed: ' . $gdEx->getMessage());
                            }
                        }
                    }

                    // Optimize brand logos
                    if (is_dir($brandDir)) {
                        $files = scandir($brandDir);
                        foreach ($files as $file) {
                            if ($file === '.' || $file === '..' || strtolower(pathinfo($file, PATHINFO_EXTENSION)) !== 'png') {
                                continue;
                            }
                            $sourcePath = $brandDir . '/' . $file;
                            $destPath = $brandDir . '/' . pathinfo($file, PATHINFO_FILENAME) . '.webp';
                            
                            if (is_file($sourcePath) && !file_exists($destPath)) {
                                $optimized = false;
                                if (class_exists(\Imagick::class)) {
                                    try {
                                        $imagick = new \Imagick($sourcePath);
                                        $imagick->setImageFormat('webp');
                                        $geometry = $imagick->getImageGeometry();
                                        if ($geometry['width'] > 150) {
                                            $newHeight = intval($geometry['height'] * (150 / $geometry['width']));
                                            $imagick->resizeImage(150, $newHeight, \Imagick::FILTER_LANCZOS, 1);
                                        }
                                        $imagick->setImageCompressionQuality(80);
                                        $imagick->writeImage($destPath);
                                        $imagick->clear();
                                        $imagick->destroy();
                                        $optimized = true;
                                    } catch (\Throwable $imEx) {}
                                }
                                if (!$optimized && function_exists('imagecreatefrompng') && function_exists('imagewebp')) {
                                    try {
                                        $image = @imagecreatefrompng($sourcePath);
                                        if ($image) {
                                            $width = imagesx($image);
                                            $height = imagesy($image);
                                            if ($width > 150) {
                                                $newWidth = 150;
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
                                            @imagewebp($image, $destPath, 80);
                                            imagedestroy($image);
                                        }
                                    } catch (\Throwable $gdEx) {}
                                }
                            }
                        }
                    }
                    @file_put_contents($logoMarker, date('Y-m-d H:i:s'));
                }
            } catch (\Throwable $e) {
                // Fail silently so the page still loads even if optimization fails
                logger()->error('Auto-optimization of slider failed: ' . $e->getMessage());
            }
        }

        // Fetch slider images (cached for 1 hour)
        $slides = Cache::remember('home_slider_slides', 3600, function () {
            $slides = collect(glob(public_path('slider/*.{webp,jpg,jpeg,png,avif}'), GLOB_BRACE) ?: [])
                ->sort()
                ->map(fn (string $path) => asset('slider/'.basename($path)))
                ->values()
                ->all();

            if ($slides === []) {
                $slides = collect(['IMG_0785.jpeg', 'IMG_0769.jpeg', 'IMG_0784.jpeg', 'IMG_0780.jpeg', 'IMG_0781.jpeg', 'IMG_0783.jpeg'])
                    ->map(fn (string $img) => asset('storage/room/'.$img))
                    ->all();
            }
            return $slides;
        });

        // Fetch podcast images that are <= 300 KB (cached for 1 hour)
        $podcastImages = Cache::remember('home_podcast_images', 3600, function () {
            $podcastImages = [];
            $podcastPath = storage_path('app/public/podcast');
            if (is_dir($podcastPath)) {
                $files = scandir($podcastPath);
                foreach ($files as $file) {
                    if ($file === '.' || $file === '..' || $file === 'original') {
                        continue;
                    }
                    $filePath = $podcastPath . '/' . $file;
                    if (is_file($filePath)) {
                        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                        if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                            $size = filesize($filePath);
                            // Only include if size is less than or equal to 300 KB
                            if ($size <= 300 * 1024) {
                                $podcastImages[] = [
                                    'src' => asset('storage/podcast/' . $file),
                                    'name' => $file
                                ];
                            }
                        }
                    }
                }
            }
            return $podcastImages;
        });

        // Fetch featured work items (cached for 1 hour)
        $featuredWorkItems = Cache::remember('home_featured_work_items', 3600, function () use ($featuredWork) {
            return $featuredWork->items();
        });

        return view('home', [
            'seo' => [
                'meta' => $meta->buildMasterMeta($title, $description, $url),
                'schema_graph' => $schema->buildMasterGraph($title, $description, $url, [
                    ['label' => 'Home', 'url' => $url],
                ]),
            ],
            'pageTitle' => $title,
            'featuredWorkItems' => $featuredWorkItems,
            'podcastImages' => $podcastImages,
            'slides' => $slides,
        ]);
    }
}



