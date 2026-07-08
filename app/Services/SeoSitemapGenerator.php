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
        @ini_set('memory_limit', '512M');
        $baseUrl = rtrim(config('dywix.base_url', 'https://www.dywix.com'), '/');

        // Clean up previous sub-sitemaps
        foreach (glob(public_path('sitemap-part-*.xml')) as $oldFile) {
            if (is_file($oldFile)) {
                @unlink($oldFile);
            }
        }

        $chunkLimit = 40000;
        $currentChunk = 1;
        $currentFile = null;
        $currentFileEntries = 0;
        $totalUrls = 0;
        $sitemaps = [];

        $openChunk = function () use (&$currentChunk, &$currentFile, &$currentFileEntries, $baseUrl, &$sitemaps) {
            $filename = "sitemap-part-{$currentChunk}.xml";
            $path = public_path($filename);
            $currentFile = fopen($path, 'w');
            if ($currentFile) {
                fwrite($currentFile, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n");
                fwrite($currentFile, "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n");
            }
            $currentFileEntries = 0;
            $sitemaps[] = [
                'loc' => $baseUrl . '/' . $filename,
                'lastmod' => date('Y-m-d')
            ];
        };

        $writeEntry = function (array $entry) use (&$currentFile, &$currentFileEntries, &$totalUrls, $chunkLimit, &$currentChunk, $openChunk) {
            if (!$currentFile) {
                $openChunk();
            }

            $loc = htmlspecialchars($entry['loc'], ENT_XML1, 'UTF-8');
            $xml = "  <url>\n";
            $xml .= "    <loc>{$loc}</loc>\n";
            $xml .= "    <lastmod>{$entry['lastmod']}</lastmod>\n";
            $xml .= "    <changefreq>{$entry['changefreq']}</changefreq>\n";
            $xml .= "    <priority>{$entry['priority']}</priority>\n";
            $xml .= "  </url>\n";

            if ($currentFile) {
                fwrite($currentFile, $xml);
            }
            $currentFileEntries++;
            $totalUrls++;

            if ($currentFileEntries >= $chunkLimit) {
                if ($currentFile) {
                    fwrite($currentFile, "</urlset>");
                    fclose($currentFile);
                }
                $currentFile = null;
                $currentChunk++;
            }
        };

        // 1. Write static routes
        $writeEntry([
            'loc' => $baseUrl . '/',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'daily',
            'priority' => '1.0'
        ]);
        $writeEntry([
            'loc' => $baseUrl . '/contact',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'monthly',
            'priority' => '0.8'
        ]);
        $writeEntry([
            'loc' => $baseUrl . '/services',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => '0.9'
        ]);

        // 2. Dynamically compile all indexable programmatic pages combinations
        $services = $this->repository->getAllServices();
        $locations = $this->repository->getAllLocations();
        $variants = $this->repository->getTemplateVariants();

        foreach ($services as $service) {
            $sSlug = $service['slug'] ?? '';
            $sId = $service['id'] ?? '';
            $sPriority = $service['priority'] ?? 9;
            if (empty($sSlug)) continue;

            foreach ($locations as $location) {
                $lSlug = $location['slug'] ?? '';
                $lId = $location['id'] ?? '';
                $lPriority = $location['priority'] ?? 5;
                if (empty($lSlug)) continue;

                // Calculate priority score
                $score = $this->calculatePriorityScore($sId, $sPriority, $lId, $lPriority);
                $indexable = $score >= 7 && !($location['noindex'] ?? false);

                if (!$indexable) {
                    continue;
                }

                foreach ($variants as $variant => $pattern) {
                    $vSlug = str_replace(['{service}', '{location}'], [$sSlug, $lSlug], $pattern);
                    $writeEntry([
                        'loc' => $baseUrl . '/' . $vSlug,
                        'lastmod' => date('Y-m-d'),
                        'changefreq' => 'weekly',
                        'priority' => number_format($score / 10, 1)
                    ]);
                }
            }
        }

        // 3. Fetch all blog pages from JSON
        $blogs = $this->repository->getAllBlogPages();
        foreach ($blogs as $blog) {
            $writeEntry([
                'loc' => $baseUrl . '/blog/' . $blog['slug'],
                'lastmod' => $blog['published_at'] ?? date('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ]);
        }

        // 4. Fetch database CMS pages (if tables exist)
        try {
            if (class_exists(\App\Models\Page::class)) {
                $dbPages = \App\Models\Page::where('is_published', true)
                    ->where('meta_robots', true)
                    ->get();
                foreach ($dbPages as $p) {
                    $writeEntry([
                        'loc' => $baseUrl . '/' . $p->slug,
                        'lastmod' => $p->updated_at?->format('Y-m-d') ?: date('Y-m-d'),
                        'changefreq' => 'weekly',
                        'priority' => '0.8'
                    ]);
                }
            }
        } catch (\Throwable $e) {
            // Ignore database page model issues
        }

        // 5. Fetch database blog posts (if tables exist)
        try {
            if (class_exists(\App\Models\Post::class)) {
                $dbPosts = \App\Models\Post::where('is_published', true)->get();
                foreach ($dbPosts as $post) {
                    $writeEntry([
                        'loc' => $baseUrl . '/blog/' . $post->slug,
                        'lastmod' => $post->updated_at?->format('Y-m-d') ?: date('Y-m-d'),
                        'changefreq' => 'weekly',
                        'priority' => '0.8'
                    ]);
                }
            }
        } catch (\Throwable $e) {
            // Ignore database post model issues
        }

        // Close last chunk file if open
        if ($currentFile) {
            fwrite($currentFile, "</urlset>");
            fclose($currentFile);
            $currentFile = null;
        }

        if ($totalUrls <= $chunkLimit) {
            // Write a single sitemap file by renaming sitemap-part-1.xml
            $partPath = public_path('sitemap-part-1.xml');
            $mainPath = public_path('sitemap.xml');
            if (is_file($partPath)) {
                if (is_file($mainPath)) {
                    @unlink($mainPath);
                }
                rename($partPath, $mainPath);
            }
        } else {
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

    /**
     * Compute priority score for a service-location pair.
     */
    protected function calculatePriorityScore(string $serviceId, int $servicePriority, string $locationId, int $locationPriority): int
    {
        $base = intval(round(($servicePriority + $locationPriority) / 2));
        if (str_contains($locationId, 'dwarka')) {
            $base += 2;
        } elseif (in_array($locationId, ['west-delhi', 'janakpuri', 'uttam-nagar', 'delhi-ncr', 'delhi'])) {
            $base += 1;
        }
        if (in_array($locationId, ['meerut'])) {
            $base -= 2;
        } elseif (in_array($locationId, ['faridabad', 'ghaziabad', 'greater-noida', 'raj-nagar-extension'])) {
            $base -= 1;
        }
        return max(1, min(10, $base));
    }
}
