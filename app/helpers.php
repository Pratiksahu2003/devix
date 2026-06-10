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

if (! function_exists('blog_default_cover')) {
    function blog_default_cover(): string
    {
        return 'banner/blog.avif';
    }
}

if (! function_exists('blog_cover_url')) {
    function blog_cover_url(?string $cover): string
    {
        if (! $cover) {
            return asset(blog_default_cover());
        }

        if (str_starts_with($cover, 'banner/') || str_starts_with($cover, 'images/')) {
            return asset($cover);
        }

        return asset('storage/'.$cover);
    }
}

if (! function_exists('seo_post_description')) {
    function seo_post_description(object $post): string
    {
        if (! empty($post->meta_description)) {
            return $post->meta_description;
        }

        return \Illuminate\Support\Str::limit(strip_tags($post->content ?? ''), 160);
    }
}

if (! function_exists('seo_post_page_title')) {
    function seo_post_page_title(object $post): string
    {
        return $post->meta_title ?: $post->title.' | Blog — '.config('company.brand');
    }
}

if (! function_exists('seo_parse_meta_content')) {
    /**
     * @return array{description: string, robots: string}
     */
    function seo_parse_meta_content(string $metaContent): array
    {
        $description = '';
        $robots = 'index,follow';

        if (preg_match('/meta\s+name=["\']description["\']\s+content=["\']([^"\']*)["\']/i', $metaContent, $match)) {
            $description = html_entity_decode($match[1], ENT_QUOTES, 'UTF-8');
        }

        if (preg_match('/meta\s+name=["\']robots["\']\s+content=["\']([^"\']+)["\']/i', $metaContent, $match)) {
            $robots = $match[1];
        }

        return compact('description', 'robots');
    }
}
