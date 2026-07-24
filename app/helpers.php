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

if (! function_exists('dywix_image')) {
    /**
     * Resolve a DyWix studio image path under storage/dywix.
     *
     * @param  string|null  $keyOrFile  Role key (hero, podcast, …), filename, or null for default hero.
     */
    function dywix_image(?string $keyOrFile = null): string
    {
        $dir = rtrim((string) config('dywix.images_dir', 'storage/dywix'), '/');
        $roles = config('dywix.roles', []);

        if ($keyOrFile === null || $keyOrFile === '') {
            $file = $roles['hero'] ?? (config('dywix.images.0') ?? 'IMG_4008.jpg');

            return $dir.'/'.$file;
        }

        if (isset($roles[$keyOrFile]) && is_string($roles[$keyOrFile])) {
            return $dir.'/'.$roles[$keyOrFile];
        }

        $file = ltrim($keyOrFile, '/');
        if (str_starts_with($file, 'storage/dywix/')) {
            return $file;
        }

        return $dir.'/'.basename($file);
    }
}

if (! function_exists('dywix_asset')) {
    /**
     * Public URL for a DyWix studio image.
     */
    function dywix_asset(?string $keyOrFile = null): string
    {
        return asset(dywix_image($keyOrFile));
    }
}

if (! function_exists('dywix_at')) {
    /**
     * Image path by index into the dywix gallery (wraps safely).
     */
    function dywix_at(int $index): string
    {
        $files = config('dywix.images', []);
        $count = count($files);

        if ($count === 0) {
            return dywix_image();
        }

        $file = $files[(($index % $count) + $count) % $count];

        return rtrim((string) config('dywix.images_dir', 'storage/dywix'), '/').'/'.$file;
    }
}

if (! function_exists('dywix_slice')) {
    /**
     * Consecutive unique image paths starting at $offset.
     *
     * @return list<string>
     */
    function dywix_slice(int $offset, int $count): array
    {
        $paths = [];
        for ($i = 0; $i < max(0, $count); $i++) {
            $paths[] = dywix_at($offset + $i);
        }

        return $paths;
    }
}

if (! function_exists('dywix_page')) {
    /**
     * Unique image set for a named page (from config dywix.pages).
     *
     * @return list<string>
     */
    function dywix_page(string $page): array
    {
        $def = config('dywix.pages.'.$page);

        if (! is_array($def) || $def === []) {
            return [];
        }

        if (isset($def['offset'], $def['count'])) {
            return dywix_slice((int) $def['offset'], (int) $def['count']);
        }

        return array_map(static fn ($index) => dywix_at((int) $index), array_values($def));
    }
}

if (! function_exists('dywix_gallery')) {
    /**
     * @param  list<string>|null  $exclude  Paths/filenames already used on the page
     * @return list<string> Relative paths (storage/dywix/…)
     */
    function dywix_gallery(?int $limit = null, ?array $exclude = null): array
    {
        $dir = rtrim((string) config('dywix.images_dir', 'storage/dywix'), '/');
        $files = config('dywix.images', []);

        $excludeBasenames = [];
        foreach ($exclude ?? [] as $item) {
            $excludeBasenames[basename((string) $item)] = true;
        }

        $paths = [];
        foreach ($files as $file) {
            if (isset($excludeBasenames[$file])) {
                continue;
            }
            $paths[] = $dir.'/'.$file;
        }

        if ($limit !== null) {
            return array_slice($paths, 0, max(0, $limit));
        }

        return $paths;
    }
}

if (! function_exists('blog_default_cover')) {
    function blog_default_cover(): string
    {
        return 'banner/blog.avif';
    }
}
if (! function_exists('blog_category_cover')) {
    function blog_category_cover(?string $category): string
    {
        return match ($category) {
            'photography' => 'banner/photography.avif',
            'location' => 'banner/location.avif',
            'marketing' => 'banner/categories.avif',
            'equipment' => 'brand/9.png',
            'pricing' => 'brand/10.png',
            'creator' => 'brand/10.png',
            'video' => 'banner/photography.avif',
            default => blog_default_cover(),
        };
    }
}

if (! function_exists('youtube_video_id_from_url')) {
    function youtube_video_id_from_url(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }
}

if (! function_exists('youtube_thumbnail_url')) {
    function youtube_thumbnail_url(?string $videoUrl, string $quality = 'hqdefault'): ?string
    {
        $videoId = youtube_video_id_from_url($videoUrl);

        if (! $videoId) {
            return null;
        }

        return "https://img.youtube.com/vi/{$videoId}/{$quality}.jpg";
    }
}

if (! function_exists('youtube_embed_url')) {
    function youtube_embed_url(?string $videoUrl): ?string
    {
        $videoId = youtube_video_id_from_url($videoUrl);

        if (! $videoId) {
            return null;
        }

        return 'https://www.youtube.com/embed/'.$videoId;
    }
}

if (! function_exists('our_work_image_url')) {
    function our_work_image_url(?string $imagePath): ?string
    {
        $imagePath = ltrim((string) $imagePath, '/');

        if ($imagePath === '') {
            return null;
        }

        if (preg_match('/^https?:\/\//i', $imagePath) === 1) {
            return $imagePath;
        }

        if (str_starts_with($imagePath, 'storage/')) {
            $imagePath = substr($imagePath, strlen('storage/'));
        }

        if (! \Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath)) {
            return null;
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->url($imagePath);
    }
}

if (! function_exists('blog_cover_url')) {
    function blog_cover_url(?string $cover): string
    {
        if (! $cover) {
            return asset(blog_default_cover());
        }

        if (str_starts_with($cover, 'http://') || str_starts_with($cover, 'https://')) {
            return $cover;
        }

        if (str_starts_with($cover, 'banner/') || str_starts_with($cover, 'images/') || str_starts_with($cover, 'brand/')) {
            return asset($cover);
        }

        return asset('storage/'.$cover);
    }
}

if (! function_exists('blog_youtube_cover_url')) {
    function blog_youtube_cover_url(array $blog): ?string
    {
        $slug = $blog['slug'] ?? '';
        $videoId = config('blog_covers.'.$slug)
            ?? youtube_video_id_from_url($blog['video_url'] ?? null);

        if (! $videoId) {
            return null;
        }

        return youtube_thumbnail_url('https://www.youtube.com/watch?v='.$videoId);
    }
}

if (! function_exists('blog_post_cover_url')) {
    function blog_post_cover_url(object $post): string
    {
        if (! empty($post->cover_image)) {
            $cover = $post->cover_image;

            if (str_starts_with($cover, 'http://') || str_starts_with($cover, 'https://')) {
                return $cover;
            }

            if (! str_starts_with($cover, 'banner/') && ! str_starts_with($cover, 'brand/')) {
                return blog_cover_url($cover);
            }
        }

        $fromVideo = youtube_thumbnail_url($post->video_url ?? null);

        if ($fromVideo) {
            return $fromVideo;
        }

        $category = $post->category->slug ?? null;

        return blog_cover_url(blog_category_cover($category));
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
