<?php

namespace App\Services\Seo;

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
}
