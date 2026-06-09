<?php

return [

    /*
    |--------------------------------------------------------------------------
    | SEO Data Paths (database-free JSON sources)
    |--------------------------------------------------------------------------
    */
    'data_path' => base_path('data'),

    'files' => [
        'services' => 'services.json',
        'cities' => 'cities.json',
        'localities' => 'localities.json',
        'landmarks' => 'landmarks.json',
        'industries' => 'industries.json',
        'blogs' => 'blogs.json',
    ],

    /*
    |--------------------------------------------------------------------------
    | URL Connectors (natural search-phrase slugs)
    |--------------------------------------------------------------------------
    | Examples:
    |   podcast-studio-in-delhi
    |   podcast-studio-near-dwarka-sector-13
    |   podcast-studio-for-healthcare
    |   podcast-studio-cost-in-delhi
    |   podcast-studio-guide-in-delhi
    */
    'url_connectors' => [
        'city' => 'in',
        'locality' => 'near',
        'landmark' => 'near',
        'industry' => 'for',
        'pricing' => 'cost-in',
        'guide' => 'guide-in',
    ],

    /*
    |--------------------------------------------------------------------------
    | URL Patterns (slug templates — mirrors url_connectors)
    |--------------------------------------------------------------------------
    */
    'patterns' => [
        'service' => '{service}',
        'city' => '{service}-in-{city}',
        'locality' => '{service}-near-{locality}',
        'landmark' => '{service}-near-{landmark}',
        'industry' => '{service}-for-{industry}',
        'pricing' => '{service}-cost-in-{location}',
        'guide' => '{service}-guide-in-{location}',
        'blog' => 'blog/{slug}',
    ],

    /*
    |--------------------------------------------------------------------------
    | Top-Level Hub Routes
    |--------------------------------------------------------------------------
    */
    'hubs' => [
        'locations' => '/studio-locations-delhi-ncr',
        'industries' => '/studio-services-by-industry',
        'guides' => '/studio-production-guides',
        'resources' => '/studio-resources',
        'directory' => '/studio-page-directory',
        'sitemaps' => '/sitemaps',
        'pricing' => '/pricing',
        'blog' => '/blog',
    ],

    /*
    |--------------------------------------------------------------------------
    | Legacy master hub paths → 301 to canonical hubs.* paths
    |--------------------------------------------------------------------------
    */
    'hub_legacy_redirects' => [
        'locations' => 'studio-locations-delhi-ncr',
        'industries' => 'studio-services-by-industry',
        'guides' => 'studio-production-guides',
        'resources' => 'studio-resources',
        'seo-directory' => 'studio-page-directory',
    ],

    /*
    |--------------------------------------------------------------------------
    | Internal Link Targets per Hub Level
    |--------------------------------------------------------------------------
    */
    'link_limits' => [
        'homepage' => ['min' => 50, 'max' => 100],
        'service' => ['min' => 50, 'max' => 150],
        'city' => ['min' => 40, 'max' => 100],
        'locality' => ['min' => 30, 'max' => 75],
        'landmark' => ['min' => 30, 'max' => 75],
        'industry' => ['min' => 30, 'max' => 75],
        'pricing' => ['min' => 20, 'max' => 50],
        'guide' => ['min' => 30, 'max' => 75],
        'blog' => ['min' => 15, 'max' => 40],
    ],

    /*
    |--------------------------------------------------------------------------
    | Sitemap Configuration
    |--------------------------------------------------------------------------
    */
    'sitemaps' => [
        'index' => 'sitemap.xml',
        'services' => 'sitemap-services.xml',
        'cities' => 'sitemap-cities.xml',
        'localities' => 'sitemap-localities.xml',
        'landmarks' => 'sitemap-landmarks.xml',
        'industries' => 'sitemap-industries.xml',
        'pricing' => 'sitemap-pricing.xml',
        'guides' => 'sitemap-guides.xml',
        'blog' => 'sitemap-blog.xml',
        'static' => 'sitemap-static.xml',
    ],

    'sitemap_priorities' => [
        'homepage' => 1.0,
        'service' => 0.9,
        'city' => 0.85,
        'locality' => 0.8,
        'landmark' => 0.75,
        'industry' => 0.8,
        'pricing' => 0.85,
        'guide' => 0.7,
        'blog' => 0.65,
        'hub' => 0.9,
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache (Redis-ready)
    |--------------------------------------------------------------------------
    */
    'cache' => [
        'enabled' => env('SEO_CACHE_ENABLED', true),
        'store' => env('SEO_CACHE_STORE', null),
        'ttl' => (int) env('SEO_CACHE_TTL', 86400),
        'prefix' => 'seo_hub:',
    ],

    /*
    |--------------------------------------------------------------------------
    | SEO Directory Pagination
    |--------------------------------------------------------------------------
    */
    'directory' => [
        'per_page' => 48,
    ],

    /*
    |--------------------------------------------------------------------------
    | Resource Center Sections
    |--------------------------------------------------------------------------
    */
    'resource_sections' => [
        'podcast' => 'Podcast Resources',
        'photography' => 'Photography Resources',
        'video' => 'Video Production Resources',
        'creator' => 'Creator Resources',
        'marketing' => 'Marketing Resources',
        'equipment' => 'Equipment Guides',
        'pricing' => 'Pricing Guides',
        'location' => 'Location Guides',
        'industry' => 'Industry Guides',
    ],

    /*
    |--------------------------------------------------------------------------
    | Legacy URL → Canonical SEO Slug (301 redirects)
    |--------------------------------------------------------------------------
    */
    'legacy_redirects' => [
        'photography-studio' => 'product-photography',
        'videography-studio' => 'video-production',
        'tv-commercials' => 'tv-commercial-studio',
        'corporate-films' => 'corporate-photography',
        'instagram-reels' => 'reel-shoot-studio',
    ],

    /*
    |--------------------------------------------------------------------------
    | Service Hub Route Names (named routes → canonical SEO slugs)
    |--------------------------------------------------------------------------
    */
    'service_route_names' => [
        'podcast-studio' => 'pages.podcast',
        'video-production' => 'pages.videography',
        'product-photography' => 'pages.photography',
        'reel-shoot-studio' => 'pages.reels',
        'tv-commercial-studio' => 'pages.tvc',
        'corporate-photography' => 'pages.corporate-films',
    ],

    /*
    |--------------------------------------------------------------------------
    | Geo & Default SEO Values
    |--------------------------------------------------------------------------
    */
    'geo' => [
        'latitude' => 28.5921,
        'longitude' => 77.0460,
    ],

    'defaults' => [
        'site_description' => 'DyWix is a 24×7 professional photography, videography, and podcast studio in Dwarka, Delhi NCR.',
        'date_published' => '2024-01-01',
        'twitter_handle' => 'dywixstudio',
        'keywords' => [
            'podcast studio Delhi',
            'video production NCR',
            'photography studio Dwarka',
            'studio rental Delhi',
            'DyWix studio',
            'content studio Delhi NCR',
        ],
        'area_served' => [
            'Delhi', 'New Delhi', 'Noida', 'Gurugram', 'Faridabad', 'Ghaziabad', 'Dwarka',
        ],
        'knows_about' => [
            'Podcast Production',
            'Video Production',
            'Product Photography',
            'Fashion Photography',
            'Corporate Films',
            'YouTube Content',
            'Instagram Reels',
            'Green Screen Studio',
        ],
    ],

];
