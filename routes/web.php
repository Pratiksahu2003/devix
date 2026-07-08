<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\OgController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Seo\SeoHubController;
use App\Http\Controllers\Seo\SeoMasterHubController;
use App\Http\Controllers\Seo\SitemapController as SeoSitemapController;
use App\Http\Controllers\SeoPageController;

Route::get('/', HomeController::class)->name('home');

// Legacy URLs → 301 to canonical SEO hub slugs
foreach (config('seo.legacy_redirects', []) as $legacy => $canonical) {
    Route::permanentRedirect('/'.$legacy, '/'.$canonical);
}

// SEO service hub pages (replaces static Blade service pages)
foreach (config('seo.service_route_names', []) as $slug => $routeName) {
    Route::get('/'.$slug, [SeoHubController::class, 'showHub'])
        ->defaults('slug', $slug)
        ->name($routeName);
}

// Remaining studio pages (not yet in SEO service hubs)
Route::view('/edit-room', 'pages.edit-room')->name('pages.edit-room');

Route::view('/services', 'pages.services')->name('pages.services');
Route::view('/pricing', 'pages.pricing')->name('pages.pricing');
Route::view('/about', 'pages.about')->name('pages.about');
Route::view('/contact', 'pages.contact')->name('pages.contact');
Route::get('/gallery', [GalleryController::class, 'index'])->name('pages.gallery');

Route::view('/help', 'pages.help')->name('pages.help');
Route::view('/booking', 'pages.booking')->name('pages.booking');
Route::view('/location', 'pages.location')->name('pages.location');

Route::view('/studio-spaces', 'pages.studio-specs')->name('pages.studio-specs');
Route::view('/use-cases', 'pages.use-cases')->name('pages.use-cases');
Route::view('/collaborations', 'pages.collaborations')->name('pages.collaborations');

// Legal & policy pages
Route::view('/terms-and-conditions', 'pages.terms')->name('pages.terms');
Route::view('/privacy-policy', 'pages.privacy')->name('pages.privacy');
Route::view('/cookie-policy', 'pages.cookie-policy')->name('pages.cookie-policy');
Route::view('/accessibility', 'pages.accessibility')->name('pages.accessibility');
Route::view('/studio-rules', 'pages.studio-rules')->name('pages.studio-rules');
Route::view('/cancellation-policy', 'pages.cancellation')->name('pages.cancellation');

// Contact form submission
Route::post('/contact', [ContactController::class , 'store'])->name('contact.submit');
Route::post('/subscribe', [SubscriberController::class , 'store'])->name('subscribe.store');

// Dynamic OG image (SVG)
Route::get('/og', [OgController::class , 'image'])->name('og.image');

// Blog public routes
Route::get('/blog', [App\Http\Controllers\BlogController::class , 'index'])->name('blog.index');
Route::get('/blog/{slug}', [App\Http\Controllers\BlogController::class , 'show'])->name('blog.show');

// Category public routes
Route::get('/category/{slug}', [App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');

// ==========================================
// SEO HUB SYSTEM (Central Authority Architecture)
// ==========================================
foreach (config('seo.hub_legacy_redirects', []) as $legacy => $canonical) {
    Route::permanentRedirect('/'.$legacy, '/'.$canonical);
}

Route::get(config('seo.hubs.locations'), [SeoMasterHubController::class, 'locations'])->name('seo.locations');
Route::get(config('seo.hubs.industries'), [SeoMasterHubController::class, 'industries'])->name('seo.industries');
Route::get(config('seo.hubs.guides'), [SeoMasterHubController::class, 'guides'])->name('seo.guides');
Route::get(config('seo.hubs.resources'), [SeoMasterHubController::class, 'resources'])->name('seo.resources');
Route::get(config('seo.hubs.directory'), [SeoMasterHubController::class, 'directory'])->name('seo.directory');
Route::get(config('seo.hubs.sitemaps'), [SeoMasterHubController::class, 'sitemaps'])->name('seo.sitemaps');

Route::get('/sitemap.xml', [SeoSitemapController::class, 'index'])->name('seo.sitemap.index');
Route::get('/sitemap-{type}.xml', [SeoSitemapController::class, 'show'])->name('seo.sitemap.show');

Route::get('/dev/generate-seo', function (
    \App\Services\SeoPageGenerator $generator,
    \App\Services\SeoSitemapGenerator $sitemapGenerator,
    \App\Services\SeoPageRepository $repository
) {
    try {
        $pages = $generator->generate();
        file_put_contents(storage_path('app/seo/pages.json'), json_encode($pages, JSON_PRETTY_PRINT));
        $repository->clearCache();

        $sitemapCount = $sitemapGenerator->generate();

        return response()->json([
            'status' => 'success',
            'message' => 'Programmatic SEO pages and sitemaps generated successfully!',
            'pages_generated' => count($pages),
            'sitemap_urls' => $sitemapCount
        ]);
    } catch (\Throwable $th) {
        return response()->json([
            'status' => 'error',
            'message' => $th->getMessage()
        ], 500);
    }
});

// ==========================================
// CATCH-ALL: SEO PROGRAMMATIC PAGES → CMS FALLBACK
// ==========================================
// Must remain at the absolute bottom.
Route::get('/{slug}', [SeoPageController::class, 'show'])->where('slug', '[A-Za-z0-9-]+')->name('pages.show');
