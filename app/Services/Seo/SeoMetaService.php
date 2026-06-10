<?php

namespace App\Services\Seo;

use App\Models\Category;

class SeoMetaService
{
    public function buildHubMeta(array $page, array $resolved): array
    {
        $url = url('/'.$page['slug']);
        $title = $page['title'];
        $description = $page['meta_description'];
        $image = asset($page['hero_image']);
        $ogImage = route('og.image', [
            'title' => $page['h1'],
            'subtitle' => config('company.short_name').' · Delhi NCR',
        ]);

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $this->keywords($page, $resolved),
            'canonical' => $url,
            'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'author' => config('company.brand'),
            'publisher' => config('company.name'),
            'og' => [
                'title' => $title,
                'description' => $description,
                'type' => $resolved['type'] === 'guide' ? 'article' : 'website',
                'url' => $url,
                'image' => $image,
                'image_alt' => $page['h1'].' — '.config('company.brand'),
                'site_name' => config('company.brand'),
                'locale' => 'en_IN',
            ],
            'twitter' => [
                'card' => 'summary_large_image',
                'title' => $title,
                'description' => $description,
                'image' => $ogImage,
                'site' => '@'.config('seo.defaults.twitter_handle', 'dywixstudio'),
            ],
            'geo' => $this->geoTags($page, $resolved),
            'alternate' => [
                'hreflang' => 'en-in',
                'url' => $url,
            ],
        ];
    }

    public function buildMasterMeta(string $title, string $description, string $canonical): array
    {
        $ogImage = route('og.image', ['title' => $title, 'subtitle' => 'Studio Resources · Delhi NCR']);

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => implode(', ', config('seo.defaults.keywords', [])),
            'canonical' => $canonical,
            'robots' => 'index, follow',
            'author' => config('company.brand'),
            'publisher' => config('company.name'),
            'og' => [
                'title' => $title,
                'description' => $description,
                'type' => 'website',
                'url' => $canonical,
                'image' => asset(config('company.logo')),
                'image_alt' => $title,
                'site_name' => config('company.brand'),
                'locale' => 'en_IN',
            ],
            'twitter' => [
                'card' => 'summary_large_image',
                'title' => $title,
                'description' => $description,
                'image' => $ogImage,
                'site' => '@'.config('seo.defaults.twitter_handle', 'dywixstudio'),
            ],
            'geo' => [],
            'alternate' => [
                'hreflang' => 'en-in',
                'url' => $canonical,
            ],
        ];
    }

    protected function keywords(array $page, array $resolved): string
    {
        $service = $page['service']['name'];
        $entity = $page['entity']['name'] ?? null;
        $base = config('seo.defaults.keywords', []);

        $contextual = match ($resolved['type']) {
            'city' => ["{$service} {$entity}", "{$service} in {$entity}", "studio rental {$entity}", 'Delhi NCR studio'],
            'locality' => ["{$service} near {$entity}", "{$entity} studio", "studio near {$entity}", 'Dwarka studio'],
            'landmark' => ["{$service} near {$entity}", "studio near {$entity}", 'near me studio Delhi'],
            'industry' => ["{$service} for {$entity}", "{$entity} video production", "{$entity} content studio"],
            'pricing' => ["{$service} cost {$entity}", "{$service} price {$entity}", "studio rental price {$entity}"],
            'guide' => ["{$service} guide", "how to book {$service}", "{$service} tips {$entity}"],
            default => ["{$service} Delhi", "{$service} NCR", 'DyWix studio', 'studio rental Delhi'],
        };

        return implode(', ', array_unique(array_merge($contextual, $base)));
    }

    protected function geoTags(array $page, array $resolved): array
    {
        if (! in_array($resolved['type'], ['city', 'locality', 'landmark', 'service'], true)) {
            return [];
        }

        $geo = config('seo.geo');
        $entity = $page['entity']['name'] ?? 'Dwarka, Delhi';

        return [
            'region' => 'IN-DL',
            'placename' => $entity,
            'position' => $geo['latitude'].';'.$geo['longitude'],
            'icbm' => $geo['latitude'].', '.$geo['longitude'],
        ];
    }

    public function buildBlogIndexMeta(?string $categorySlug = null, ?string $categoryName = null, int $page = 1): array
    {
        $brand = config('company.brand');
        $params = array_filter([
            'category' => $categorySlug,
            'page' => $page > 1 ? $page : null,
        ]);

        if ($categoryName) {
            $title = "{$categoryName} Articles | Blog — {$brand}";
            $description = "Browse {$categoryName} articles from {$brand} — podcast, photo, and video production tips for Delhi NCR creators.";
        } else {
            $title = "Blog | Studio Tips, Guides & Production Insights — {$brand}";
            $description = "Expert tips on podcast recording, photography, videography, and content production from {$brand} studio in Delhi NCR.";
        }

        $url = route('blog.index', $params);
        $meta = $this->buildMasterMeta($title, $description, $url);
        $meta['og']['type'] = 'website';

        return $meta;
    }

    public function buildBlogPostMeta(object $post): array
    {
        $title = seo_post_page_title($post);
        $description = seo_post_description($post);
        $url = route('blog.show', $post->slug);
        $image = blog_cover_url($post->cover_image);
        $ogImage = route('og.image', [
            'title' => $post->title,
            'subtitle' => config('company.short_name').' · Blog',
        ]);

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $post->meta_keywords ?? implode(', ', config('seo.defaults.keywords', [])),
            'canonical' => $url,
            'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'author' => optional($post->author)->name ?? config('company.brand'),
            'publisher' => config('company.name'),
            'og' => [
                'title' => $post->title,
                'description' => $description,
                'type' => 'article',
                'url' => $url,
                'image' => $image,
                'image_alt' => $post->title.' — '.config('company.brand'),
                'site_name' => config('company.brand'),
                'locale' => 'en_IN',
            ],
            'twitter' => [
                'card' => 'summary_large_image',
                'title' => $post->title,
                'description' => $description,
                'image' => $ogImage,
                'site' => '@'.config('seo.defaults.twitter_handle', 'dywixstudio'),
            ],
            'alternate' => [
                'hreflang' => 'en-in',
                'url' => $url,
            ],
        ];
    }

    public function buildCategoryMeta(Category $category): array
    {
        $brand = config('company.brand');
        $title = "{$category->name} | Topics & Articles — {$brand}";
        $description = $category->description
            ?: "Explore {$category->name} articles, studio services, and production resources from {$brand} in Delhi NCR.";
        $url = route('category.show', $category->slug);

        return $this->buildMasterMeta($title, $description, $url);
    }
}
