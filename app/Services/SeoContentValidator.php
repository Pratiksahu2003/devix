<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SeoContentValidator
{
    public function __construct(protected SeoPageRepository $repository) {}

    /**
     * Audit generated pages and save a JSON report.
     *
     * @return array The audit results summary
     */
    public function validate(): array
    {
        $pages = $this->repository->getAllPages();
        $reportPath = 'seo/reports/validation-report.json';

        $totalCount = count($pages);
        $errors = [];
        $warnings = [];
        $slugsSeen = [];
        $introsSeen = [];

        // Compile list of valid slugs for checking broken internal links
        $validSlugs = array_map(fn($p) => '/' . $p['slug'], $pages);
        $validSlugs[] = '/contact';
        $validSlugs[] = '/';

        foreach ($pages as $page) {
            $slug = $page['slug'] ?? 'missing-slug';
            $h1 = $page['h1'] ?? '';
            $title = $page['seo_title'] ?? '';
            $metaDesc = $page['meta_description'] ?? '';
            $intro = $page['intro'] ?? '';
            $priority = $page['priority'] ?? 0;
            $indexable = $page['indexable'] ?? false;
            $canonical = $page['canonical_url'] ?? '';
            $internalLinks = $page['internal_links'] ?? [];
            $faqs = $page['faqs'] ?? [];

            $pageErrors = [];
            $pageWarnings = [];

            // 1. Duplicate slug check
            if (in_array($slug, $slugsSeen)) {
                $pageErrors[] = 'Duplicate slug detected.';
            } else {
                $slugsSeen[] = $slug;
            }

            // 2. Missing tags
            if (empty($h1)) {
                $pageErrors[] = 'Missing H1 tag.';
            }
            if (empty($title)) {
                $pageErrors[] = 'Missing SEO title.';
            }
            if (empty($metaDesc)) {
                $pageErrors[] = 'Missing meta description.';
            }
            if (empty($canonical)) {
                $pageErrors[] = 'Missing canonical URL.';
            }

            // 3. Thin content check
            $wordCount = str_word_count($intro);
            if ($wordCount < 80) {
                $pageWarnings[] = "Thin intro content ({$wordCount} words, under 80 words recommendation).";
            }

            // 4. Duplicate intro check
            if (!empty($intro)) {
                $introHash = md5($intro);
                if (in_array($introHash, $introsSeen)) {
                    $pageWarnings[] = 'Duplicate intro paragraph content found on other page(s).';
                } else {
                    $introsSeen[] = $introHash;
                }
            }

            // 5. Length validations
            if (strlen($title) > 60) {
                $pageWarnings[] = "SEO title is too long (" . strlen($title) . " characters, recommended <= 60).";
            }
            if (strlen($metaDesc) > 160) {
                $pageWarnings[] = "Meta description is too long (" . strlen($metaDesc) . " characters, recommended <= 160).";
            }

            // 6. Quality Checks
            if ($indexable && $priority < 7) {
                $pageErrors[] = "Page is set to indexable but has low priority score ({$priority}).";
            }

            if (empty($internalLinks)) {
                $pageWarnings[] = 'Missing internal links.';
            } else {
                foreach ($internalLinks as $link) {
                    if (!in_array($link, $validSlugs)) {
                        $pageWarnings[] = "Broken internal link path: {$link}.";
                    }
                }
            }

            if (empty($faqs)) {
                $pageWarnings[] = 'Missing FAQs.';
            } else {
                // Check duplicate FAQ questions within the page
                $questions = [];
                foreach ($faqs as $faq) {
                    $q = $faq['question'] ?? '';
                    if (in_array($q, $questions)) {
                        $pageErrors[] = "Duplicate FAQ question found: '{$q}'.";
                    }
                    $questions[] = $q;
                }
            }

            // Keyword stuffing check (simple check for keyword density)
            $targetKeyword = $page['target_keyword'] ?? '';
            if (!empty($targetKeyword) && !empty($intro)) {
                $count = substr_count(strtolower($intro), strtolower($targetKeyword));
                if ($count > 3) {
                    $pageWarnings[] = "Keyword stuffing risk: target keyword '{$targetKeyword}' appears {$count} times in the introduction.";
                }
            }

            // Accumulate page-level logs
            if (!empty($pageErrors)) {
                $errors[$slug] = $pageErrors;
            }
            if (!empty($pageWarnings)) {
                $warnings[$slug] = $pageWarnings;
            }
        }

        $report = [
            'audit_date' => date('Y-m-d H:i:s'),
            'summary' => [
                'total_pages_audited' => $totalCount,
                'total_errors' => count($errors),
                'total_warnings' => count($warnings),
                'status' => count($errors) === 0 ? 'passed' : 'failed'
            ],
            'errors' => $errors,
            'warnings' => $warnings
        ];

        // Ensure directories exist
        Storage::makeDirectory('seo/reports');
        Storage::put($reportPath, json_encode($report, JSON_PRETTY_PRINT));

        return $report;
    }
}
