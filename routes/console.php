<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('site:public-pages', function () {
    $base = rtrim(URL::to('/'), '/');
    $routes = Route::getRoutes();

    $pages = [];
    foreach ($routes as $route) {
        if (! in_array('GET', $route->methods(), true)) {
            continue;
        }
        $name = $route->getName();
        // Only public view pages: home or named pages.* (from Route::view or similar)
        if ($name !== 'home' && (! $name || ! str_starts_with($name, 'pages.'))) {
            continue;
        }
        $uri = $route->uri();
        if (str_contains($uri, '{')) {
            continue;
        }
        $pages[] = [
            'url'  => $base . '/' . ($uri === '/' ? '' : $uri),
            'name' => $name,
        ];
    }

    usort($pages, fn ($a, $b) => strcmp($a['url'], $b['url']));

    $this->info('Public view pages:');
    $this->newLine();
    foreach ($pages as $page) {
        $this->line('  ' . $page['url']);
        $this->comment('    name: ' . $page['name']);
    }
    $this->newLine();
    $this->info('Total: ' . count($pages) . ' pages');
})->purpose('List all public view/page URLs from web routes');

Artisan::command('site:sitemap', function () {
    $base = rtrim(URL::to('/'), '/');
    $routes = Route::getRoutes();

    $pages = [];
    foreach ($routes as $route) {
        if (! in_array('GET', $route->methods(), true)) {
            continue;
        }
        $name = $route->getName();
        if ($name !== 'home' && (! $name || ! str_starts_with($name, 'pages.'))) {
            continue;
        }
        $uri = $route->uri();
        if (str_contains($uri, '{')) {
            continue;
        }
        $pages[] = [
            'loc' => $base . '/' . ($uri === '/' ? '' : $uri),
        ];
    }

    usort($pages, fn ($a, $b) => strcmp($a['loc'], $b['loc']));

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($pages as $entry) {
        $loc = htmlspecialchars($entry['loc'], ENT_XML1, 'UTF-8');
        $xml .= "  <url>\n";
        $xml .= "    <loc>{$loc}</loc>\n";
        $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
        $xml .= "    <changefreq>weekly</changefreq>\n";
        $xml .= "    <priority>0.8</priority>\n";
        $xml .= "  </url>\n";
    }
    $xml .= '</urlset>';

    $path = base_path('public/sitemap.xml');
    file_put_contents($path, $xml);

    $this->info('Sitemap written to public/sitemap.xml (' . count($pages) . ' URLs).');
})->purpose('Generate sitemap.xml from public view pages');
