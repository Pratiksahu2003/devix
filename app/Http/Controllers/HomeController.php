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



