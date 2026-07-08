<?php

namespace App\Services;

class SeoSchemaGenerator
{
    /**
     * Generate the complete schema graph for an SEO page.
     *
     * @param array $page
     * @param array|null $service
     * @param array|null $location
     * @return array
     */
    public function generate(array $page, ?array $service = null, ?array $location = null): array
    {
        $graph = [];

        // 1. Organization Schema
        $graph[] = $this->generateOrganizationSchema();

        // 2. WebPage Schema
        $graph[] = $this->generateWebPageSchema($page);

        // 3. BreadcrumbList Schema
        $graph[] = $this->generateBreadcrumbSchema($page, $service, $location);

        // 4. LocalBusiness Schema
        $graph[] = $this->generateLocalBusinessSchema($page, $location);

        // 5. Service Schema (if service exists)
        if ($service) {
            $graph[] = $this->generateServiceSchema($page, $service);
        }

        // 6. FAQPage Schema (if FAQs exist)
        if (!empty($page['faqs'])) {
            $graph[] = $this->generateFaqSchema($page);
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph
        ];
    }

    /**
     * Generate Organization Schema.
     */
    protected function generateOrganizationSchema(): array
    {
        return [
            '@type' => 'Organization',
            '@id' => config('dywix.base_url') . '/#organization',
            'name' => config('dywix.brand_name'),
            'url' => config('dywix.base_url'),
            'logo' => config('dywix.base_url') . config('dywix.logo_path'),
            'email' => config('dywix.email'),
            'telephone' => config('dywix.phone'),
            'sameAs' => array_values(config('dywix.social_links', []))
        ];
    }

    /**
     * Generate WebPage Schema.
     */
    protected function generateWebPageSchema(array $page): array
    {
        $url = $page['canonical_url'] ?? (config('dywix.base_url') . '/' . $page['slug']);
        return [
            '@type' => 'WebPage',
            '@id' => $url . '/#webpage',
            'url' => $url,
            'name' => $page['seo_title'],
            'description' => $page['meta_description'],
            'isPartOf' => [
                '@id' => config('dywix.base_url') . '/#website'
            ]
        ];
    }

    /**
     * Generate BreadcrumbList Schema.
     */
    protected function generateBreadcrumbSchema(array $page, ?array $service, ?array $location): array
    {
        $items = [];

        // Home
        $items[] = [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => config('dywix.base_url')
        ];

        // Service or Location category if available
        $position = 2;
        if ($service) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $service['name'],
                'item' => config('dywix.base_url') . '/services/' . $service['slug']
            ];
        }

        // Current page
        $url = $page['canonical_url'] ?? (config('dywix.base_url') . '/' . $page['slug']);
        $items[] = [
            '@type' => 'ListItem',
            'position' => $position,
            'name' => $page['h1'],
            'item' => $url
        ];

        return [
            '@type' => 'BreadcrumbList',
            '@id' => $url . '/#breadcrumb',
            'itemListElement' => $items
        ];
    }

    /**
     * Generate LocalBusiness Schema.
     */
    protected function generateLocalBusinessSchema(array $page, ?array $location): array
    {
        $url = $page['canonical_url'] ?? (config('dywix.base_url') . '/' . $page['slug']);
        
        $schema = [
            '@type' => 'LocalBusiness',
            '@id' => $url . '/#localbusiness',
            'name' => config('dywix.brand_name'),
            'image' => config('dywix.base_url') . config('dywix.default_image'),
            'url' => config('dywix.base_url'),
            'telephone' => config('dywix.phone'),
            'email' => config('dywix.email'),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => '4th Floor, 96A, Block-B, Pocket-10, Dwarka Sector-13',
                'addressLocality' => 'New Delhi',
                'addressRegion' => 'Delhi',
                'postalCode' => '110078',
                'addressCountry' => 'IN'
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => 28.5921,
                'longitude' => 77.0460
            ],
            'priceRange' => '$$',
            'areaServed' => [
                'Delhi NCR', 'Delhi', 'New Delhi', 'Dwarka', 'Gurugram', 'Noida', 'Faridabad', 'Ghaziabad'
            ]
        ];

        if ($location) {
            $schema['address']['addressLocality'] = $location['city'] ?? 'New Delhi';
            $schema['address']['addressRegion'] = $location['region'] ?? 'Delhi NCR';
        }

        return $schema;
    }

    /**
     * Generate Service Schema.
     */
    protected function generateServiceSchema(array $page, array $service): array
    {
        $url = $page['canonical_url'] ?? (config('dywix.base_url') . '/' . $page['slug']);
        
        return [
            '@type' => 'Service',
            '@id' => $url . '/#service',
            'name' => $service['name'],
            'description' => $service['short_description'],
            'provider' => [
                '@id' => config('dywix.base_url') . '/#organization'
            ],
            'offers' => [
                '@type' => 'Offer',
                'priceCurrency' => 'INR',
                'price' => '1000', // Starting price placeholder
                'priceSpecification' => [
                    '@type' => 'UnitPriceSpecification',
                    'price' => '1000',
                    'priceCurrency' => 'INR',
                    'unitText' => 'HOUR'
                ]
            ]
        ];
    }

    /**
     * Generate FAQ Schema.
     */
    protected function generateFaqSchema(array $page): array
    {
        $elements = [];
        foreach ($page['faqs'] as $faq) {
            $elements[] = [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer']
                ]
            ];
        }

        return [
            '@type' => 'FAQPage',
            'mainEntity' => $elements
        ];
    }
}
