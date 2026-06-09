<?php

use App\Services\Seo\SeoUrlResolver;

if (! function_exists('seo_url')) {
    function seo_url(string $type, string $serviceSlug, ?string $entitySlug = null): string
    {
        return app(SeoUrlResolver::class)->url($type, $serviceSlug, $entitySlug);
    }
}

if (! function_exists('seo_slug')) {
    function seo_slug(string $type, string $serviceSlug, ?string $entitySlug = null): string
    {
        return app(SeoUrlResolver::class)->slug($type, $serviceSlug, $entitySlug);
    }
}

if (! function_exists('blog_cover_url')) {
    function blog_cover_url(?string $cover): ?string
    {
        if (! $cover) {
            return null;
        }

        if (str_starts_with($cover, 'banner/') || str_starts_with($cover, 'images/')) {
            return asset($cover);
        }

        return asset('storage/'.$cover);
    }
}
