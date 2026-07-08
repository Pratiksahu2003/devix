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

        // Clean up previous sub-sitemaps
        foreach (glob(public_path('sitemap-part-*.xml')) as $oldFile) {
            if (is_file($oldFile)) {
                @unlink($oldFile);
            }
        }

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

        $totalUrls = count($entries);
        $chunkLimit = 40000;

        if ($totalUrls <= $chunkLimit) {
            // Write a single sitemap file
            $xmlContent = $this->buildSitemapXml($entries);
            file_put_contents(public_path('sitemap.xml'), $xmlContent);
        } else {
            // Split into multiple sitemap files
            $chunks = array_chunk($entries, $chunkLimit);
            $sitemaps = [];

            foreach ($chunks as $index => $chunk) {
                $partNum = $index + 1;
                $filename = "sitemap-part-{$partNum}.xml";
                $xmlContent = $this->buildSitemapXml($chunk);
                file_put_contents(public_path($filename), $xmlContent);
                $sitemaps[] = [
                    'loc' => $baseUrl . '/' . $filename,
                    'lastmod' => date('Y-m-d')
                ];
            }

            // Write index sitemap file pointing to parts
            $indexContent = $this->buildSitemapIndexXml($sitemaps);
            file_put_contents(public_path('sitemap.xml'), $indexContent);
        }

        return $totalUrls;
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

    /**
     * Build Sitemap Index XML structure.
     */
    protected function buildSitemapIndexXml(array $sitemaps): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($sitemaps as $sitemap) {
            $loc = htmlspecialchars($sitemap['loc'], ENT_XML1, 'UTF-8');
            $xml .= "  <sitemap>\n";
            $xml .= "    <loc>{$loc}</loc>\n";
            $xml .= "    <lastmod>{$sitemap['lastmod']}</lastmod>\n";
            $xml .= "  </sitemap>\n";
        }

        $xml .= '</sitemapindex>';
        return $xml;
    }
}
