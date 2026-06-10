<?php

namespace App\Services\Seo;

use App\Models\Category;

class SeoSchemaService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('app.url'), '/');
    }

    public function buildHubGraph(array $page, array $resolved): array
    {
        $url = url('/'.$page['slug']);
        $graph = [];

        $graph[] = $this->organization();
        $graph[] = $this->website();
        $graph[] = $this->webPage($page, $url, $resolved);
        $graph[] = $this->breadcrumbList($page['breadcrumbs'] ?? [], $url);
        $graph[] = $this->localBusiness($page, $page['testimonials'] ?? []);
        $graph[] = $this->service($page, $resolved, $url);

        if (! empty($page['faqs'])) {
            $graph[] = $this->faqPage($page['faqs'], $url);
        }


        if ($resolved['type'] === 'pricing' && ! empty($page['pricing_context'])) {
            $graph[] = $this->offer($page, $url);
        }

        if ($resolved['type'] === 'guide') {
            $graph[] = $this->article($page, $url);
        }

        if (! empty($page['local_info'])) {
            $graph[] = $this->place($page['local_info']);
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];
    }

    public function buildMasterGraph(string $title, string $description, string $url, array $breadcrumbs = []): array
    {
        $graph = [
            $this->organization(),
            $this->website(),
            [
                '@type' => 'CollectionPage',
                '@id' => $url.'/#webpage',
                'url' => $url,
                'name' => $title,
                'description' => $description,
                'isPartOf' => ['@id' => $this->baseUrl.'/#website'],
                'publisher' => ['@id' => $this->baseUrl.'/#organization'],
                'inLanguage' => 'en-IN',
            ],
        ];

        if ($breadcrumbs) {
            $graph[] = $this->breadcrumbList($breadcrumbs, $url);
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];
    }

    public function buildBlogIndexGraph(?string $categoryName = null): array
    {
        $title = $categoryName
            ? "{$categoryName} Articles | Blog — ".config('company.brand')
            : 'Blog | '.config('company.brand');
        $description = $categoryName
            ? "Browse {$categoryName} articles from ".config('company.brand').'.'
            : config('seo.defaults.site_description');
        $url = $categoryName && request()->has('category')
            ? route('blog.index', ['category' => request('category')])
            : route('blog.index');

        return $this->buildMasterGraph($title, $description, $url, [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Blog', 'url' => route('blog.index')],
        ]);
    }

    public function buildBlogPostGraph(object $post): array
    {
        $url = route('blog.show', $post->slug);
        $description = seo_post_description($post);
        $image = blog_cover_url($post->cover_image);
        $published = $post->published_at?->toIso8601String() ?? config('seo.defaults.date_published');
        $modified = ($post->updated_at ?? $post->published_at)?->toIso8601String() ?? $published;
        $authorName = optional($post->author)->name ?? config('company.brand');

        $graph = [
            $this->organization(),
            $this->website(),
            [
                '@type' => 'BlogPosting',
                '@id' => $url.'/#article',
                'headline' => $post->title,
                'description' => $description,
                'image' => $image,
                'url' => $url,
                'datePublished' => $published,
                'dateModified' => $modified,
                'author' => [
                    '@type' => 'Person',
                    'name' => $authorName,
                ],
                'publisher' => ['@id' => $this->baseUrl.'/#organization'],
                'mainEntityOfPage' => ['@id' => $url.'/#webpage'],
                'inLanguage' => 'en-IN',
                'articleSection' => optional($post->category)->name ?? 'Blog',
            ],
            [
                '@type' => 'WebPage',
                '@id' => $url.'/#webpage',
                'url' => $url,
                'name' => $post->title,
                'description' => $description,
                'isPartOf' => ['@id' => $this->baseUrl.'/#website'],
                'publisher' => ['@id' => $this->baseUrl.'/#organization'],
                'inLanguage' => 'en-IN',
            ],
            $this->breadcrumbList([
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Blog', 'url' => route('blog.index')],
                ['label' => $post->title, 'url' => $url],
            ], $url),
        ];

        if (! empty($post->faqs)) {
            $graph[] = $this->faqPage($post->faqs, $url);
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];
    }

    public function buildCategoryGraph(Category $category): array
    {
        $url = route('category.show', $category->slug);
        $title = "{$category->name} | ".config('company.brand');
        $description = $category->description
            ?: "Explore {$category->name} articles and studio resources from ".config('company.brand').'.';

        return $this->buildMasterGraph($title, $description, $url, [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => $category->name, 'url' => $url],
        ]);
    }

    protected function organization(): array
    {
        return [
            '@type' => 'Organization',
            '@id' => $this->baseUrl.'/#organization',
            'name' => config('company.brand'),
            'legalName' => config('company.name'),
            'url' => $this->baseUrl,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset(config('company.logo')),
            ],
            'email' => config('company.email'),
            'telephone' => config('company.phone.intl'),
            'sameAs' => array_values(array_filter(config('company.social'))),
            'address' => $this->postalAddress(),
        ];
    }

    protected function website(): array
    {
        return [
            '@type' => 'WebSite',
            '@id' => $this->baseUrl.'/#website',
            'url' => $this->baseUrl,
            'name' => config('company.brand'),
            'description' => config('seo.defaults.site_description'),
            'publisher' => ['@id' => $this->baseUrl.'/#organization'],
            'inLanguage' => 'en-IN',
        ];
    }

    protected function webPage(array $page, string $url, array $resolved): array
    {
        $type = match ($resolved['type']) {
            'guide' => 'Article',
            'pricing' => 'WebPage',
            default => 'WebPage',
        };

        $data = [
            '@type' => $type,
            '@id' => $url.'/#webpage',
            'url' => $url,
            'name' => $page['title'],
            'headline' => $page['h1'],
            'description' => $page['meta_description'],
            'isPartOf' => ['@id' => $this->baseUrl.'/#website'],
            'about' => ['@id' => $url.'/#service'],
            'primaryImageOfPage' => [
                '@type' => 'ImageObject',
                'url' => asset($page['hero_image']),
            ],
            'publisher' => ['@id' => $this->baseUrl.'/#organization'],
            'inLanguage' => 'en-IN',
            'dateModified' => now()->toIso8601String(),
            'datePublished' => config('seo.defaults.date_published'),
        ];

        if ($type === 'Article') {
            $data['author'] = [
                '@type' => 'Organization',
                'name' => config('company.brand'),
            ];
            $data['articleSection'] = $page['service']['category'] ?? 'Studio Guides';
        }

        return $data;
    }

    protected function breadcrumbList(array $crumbs, string $pageUrl): array
    {
        $items = collect($crumbs)->values()->map(fn ($crumb, $i) => [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'name' => $crumb['label'],
            'item' => $crumb['url'],
        ])->all();

        return [
            '@type' => 'BreadcrumbList',
            '@id' => $pageUrl.'/#breadcrumb',
            'itemListElement' => $items,
        ];
    }

    protected function localBusiness(array $page, array $testimonials = []): array
    {
        $geo = config('seo.geo');

        $business = [
            '@type' => ['LocalBusiness', 'ProfessionalService'],
            '@id' => $this->baseUrl.'/#localbusiness',
            'name' => config('company.brand'),
            'description' => $page['service']['short_description'] ?? config('seo.defaults.site_description'),
            'url' => $this->baseUrl,
            'telephone' => config('company.phone.intl'),
            'email' => config('company.email'),
            'image' => asset($page['hero_image']),
            'logo' => asset(config('company.logo')),
            'priceRange' => '₹₹-₹₹₹',
            'currenciesAccepted' => 'INR',
            'paymentAccepted' => 'Cash, Credit Card, UPI, Bank Transfer',
            'address' => $this->postalAddress(),
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => $geo['latitude'],
                'longitude' => $geo['longitude'],
            ],
            'hasMap' => config('company.map.view_url'),
            'openingHoursSpecification' => [
                [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                    'opens' => '00:00',
                    'closes' => '23:59',
                ],
            ],
            'areaServed' => $this->areaServed($page),
            'parentOrganization' => ['@id' => $this->baseUrl.'/#organization'],
            'sameAs' => array_values(array_filter(config('company.social'))),
            'knowsAbout' => config('seo.defaults.knows_about'),
        ];

        if ($testimonials) {
            $business['aggregateRating'] = [
                '@type' => 'AggregateRating',
                'ratingValue' => 4.9,
                'reviewCount' => count($testimonials),
                'bestRating' => 5,
                'worstRating' => 4,
            ];
            $business['review'] = collect($testimonials)->map(fn ($t) => [
                '@type' => 'Review',
                'author' => ['@type' => 'Person', 'name' => $t['name']],
                'reviewRating' => [
                    '@type' => 'Rating',
                    'ratingValue' => $t['rating'] ?? 5,
                    'bestRating' => 5,
                ],
                'reviewBody' => $t['text'],
            ])->all();
        }

        return $business;
    }

    protected function service(array $page, array $resolved, string $url): array
    {
        $entity = $page['entity'] ?? null;
        $areaName = $entity['name'] ?? 'Delhi NCR';

        return [
            '@type' => 'Service',
            '@id' => $url.'/#service',
            'name' => $page['h1'],
            'description' => $page['meta_description'],
            'url' => $url,
            'serviceType' => $page['service']['name'],
            'category' => ucfirst($page['service']['category'] ?? 'Studio'),
            'provider' => ['@id' => $this->baseUrl.'/#localbusiness'],
            'areaServed' => [
                '@type' => 'City',
                'name' => $areaName,
                'containedInPlace' => [
                    '@type' => 'State',
                    'name' => $entity['state'] ?? 'Delhi NCR',
                ],
            ],
            'availableChannel' => [
                '@type' => 'ServiceChannel',
                'serviceUrl' => route('pages.booking'),
                'servicePhone' => config('company.phone.intl'),
            ],
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => $page['service']['name'].' Packages',
                'itemListElement' => [
                    $this->offerItem('Hourly Studio Rental', $page['pricing_context']['hourly_from'] ?? '₹2,999'),
                    $this->offerItem('Half-Day Package', $page['pricing_context']['half_day_from'] ?? '₹9,999'),
                    $this->offerItem('Full-Day Package', $page['pricing_context']['full_day_from'] ?? '₹17,999'),
                ],
            ],
        ];
    }

    protected function offerItem(string $name, string $price): array
    {
        $numeric = (int) preg_replace('/[^\d]/', '', $price);

        return [
            '@type' => 'Offer',
            'name' => $name,
            'price' => $numeric ?: 2999,
            'priceCurrency' => 'INR',
            'availability' => 'https://schema.org/InStock',
            'url' => route('pages.booking'),
        ];
    }

    protected function offer(array $page, string $url): array
    {
        $ctx = $page['pricing_context'];

        return [
            '@type' => 'Offer',
            '@id' => $url.'/#offer',
            'name' => $page['service']['name'].' — '.$ctx['location'],
            'description' => $ctx['note'] ?? '',
            'url' => route('pages.booking'),
            'priceCurrency' => 'INR',
            'price' => 2999,
            'lowPrice' => 2999,
            'highPrice' => 17999,
            'availability' => 'https://schema.org/InStock',
            'validFrom' => now()->toIso8601String(),
            'seller' => ['@id' => $this->baseUrl.'/#localbusiness'],
            'itemOffered' => ['@id' => $url.'/#service'],
        ];
    }

    protected function faqPage(array $faqs, string $url): array
    {
        return [
            '@type' => 'FAQPage',
            '@id' => $url.'/#faq',
            'mainEntity' => collect($faqs)->map(fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq['q'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['a'],
                ],
            ])->values()->all(),
        ];
    }

    protected function article(array $page, string $url): array
    {
        return [
            '@type' => 'Article',
            '@id' => $url.'/#article',
            'headline' => $page['h1'],
            'description' => $page['meta_description'],
            'image' => asset($page['hero_image']),
            'author' => [
                '@type' => 'Organization',
                'name' => config('company.brand'),
                'url' => $this->baseUrl,
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('company.brand'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset(config('company.logo')),
                ],
            ],
            'datePublished' => config('seo.defaults.date_published'),
            'dateModified' => now()->toIso8601String(),
            'mainEntityOfPage' => ['@id' => $url.'/#webpage'],
            'inLanguage' => 'en-IN',
            'about' => [
                '@type' => 'Thing',
                'name' => $page['service']['name'],
            ],
        ];
    }

    protected function place(array $localInfo): array
    {
        return [
            '@type' => 'Place',
            '@id' => $this->baseUrl.'/#place',
            'name' => config('company.brand').' Studio',
            'description' => 'Professional content studio near '.$localInfo['name'],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => config('seo.geo.latitude'),
                'longitude' => config('seo.geo.longitude'),
            ],
            'hasMap' => $localInfo['map_url'],
        ];
    }

    protected function postalAddress(): array
    {
        return [
            '@type' => 'PostalAddress',
            'streetAddress' => implode(', ', config('company.address.lines')),
            'addressLocality' => config('company.address.locality'),
            'addressRegion' => config('company.address.region'),
            'postalCode' => config('company.address.postal_code'),
            'addressCountry' => config('company.address.country'),
        ];
    }

    protected function areaServed(array $page): array
    {
        $areas = collect(config('seo.defaults.area_served', ['Delhi NCR']));

        if ($entity = $page['entity'] ?? null) {
            $areas->prepend($entity['name']);
        }

        return $areas->unique()->map(fn ($name) => [
            '@type' => 'City',
            'name' => $name,
        ])->values()->all();
    }
}
