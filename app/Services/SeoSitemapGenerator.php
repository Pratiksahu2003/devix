<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class SeoSitemapGenerator
{
    public function __construct(protected SeoPageRepository $repository) {}

    /**
     * Generate the sitemap files and write them to public directory.
     *
     * @return int The total number of links added to sitemap
     */
    public function generate(): int
    {
        $baseUrl = rtrim(config('dywix.base_url', 'https://www.dywix.com'), '/');

        // 1. Gather all URL entries
        $entries = [];

        // Static routes
        $entries[] = [
            'loc' => $baseUrl . '/',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'daily',
            'priority' => '1.0'
        ];
        $entries[] = [
            'loc' => $baseUrl . '/contact',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'monthly',
            'priority' => '0.8'
        ];
        $entries[] = [
            'loc' => $baseUrl . '/services',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => '0.9'
        ];

        // 2. Fetch all indexable programmatic pages
        $pages = $this->repository->getIndexablePages();
        foreach ($pages as $page) {
            $entries[] = [
                'loc' => $baseUrl . '/' . $page['slug'],
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => number_format(($page['priority'] ?? 8) / 10, 1)
            ];
        }

        // 3. Fetch all blog pages
        $blogs = $this->repository->getAllBlogPages();
        foreach ($blogs as $blog) {
            $entries[] = [
                'loc' => $baseUrl . '/blog/' . $blog['slug'],
                'lastmod' => $blog['published_at'] ?? date('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ];
        }

        // 4. Generate sitemap XML
        $xmlContent = $this->buildSitemapXml($entries);

        // Write to public/sitemap.xml
        $publicPath = public_path('sitemap.xml');
        file_put_contents($publicPath, $xmlContent);

        return count($entries);
    }

    /**
     * Build standard Sitemap XML structure.
     */
    protected function buildSitemapXml(array $entries): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($entries as $entry) {
            $loc = htmlspecialchars($entry['loc'], ENT_XML1, 'UTF-8');
            $xml .= "  <url>\n";
            $xml .= "    <loc>{$loc}</loc>\n";
            $xml .= "    <lastmod>{$entry['lastmod']}</lastmod>\n";
            $xml .= "    <changefreq>{$entry['changefreq']}</changefreq>\n";
            $xml .= "    <priority>{$entry['priority']}</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';
        return $xml;
    }
}
