<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SeoPageGenerator;
use App\Services\SeoSitemapGenerator;
use App\Services\SeoPageRepository;
use App\Services\SeoContentValidator;
use Illuminate\Support\Facades\Storage;

class GenerateSeoAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:generate-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Centralized command to run page generation, cache warming, quality validation, and sitemap compilation';

    /**
     * Execute the console command.
     */
    public function handle(
        SeoPageGenerator $generator,
        SeoSitemapGenerator $sitemapGenerator,
        SeoPageRepository $repository,
        SeoContentValidator $validator
    ): int {
        $this->info('==================================================');
        $this->info('Starting Centralized Programmatic SEO Build Chain');
        $this->info('==================================================');

        // Step 0: Clear Cache
        $this->info("[Step 0/4] Clearing Cache...");
        $repository->clearCache();

        // Step 1: Page Generation
        $this->info("\n[Step 1/4] Generating Page Combinations...");
        try {
            $pages = $generator->generate();
            file_put_contents(storage_path('app/seo/pages.json'), json_encode($pages, JSON_PRETTY_PRINT));
            $this->info("✓ Successfully generated and saved " . count($pages) . " pages.");
        } catch (\Throwable $th) {
            $this->error("✗ Page generation failed: " . $th->getMessage());
            return Command::FAILURE;
        }

        // Step 2: Cache Warming
        $this->info("\n[Step 2/4] Warming Cache...");
        try {
            $repository->clearCache();
            $repository->getAllServices();
            $repository->getAllLocations();
            $repository->getAllBlogPages();
            $repository->getAllPages();
            $repository->getPageBySlug('non-existent-test-slug');
            $this->info("✓ Cache successfully cleared and warmed.");
        } catch (\Throwable $th) {
            $this->error("✗ Cache warming failed: " . $th->getMessage());
            return Command::FAILURE;
        }

        // Step 3: Content Quality Validation
        $this->info("\n[Step 3/4] Running Content Quality Audits...");
        try {
            $report = $validator->validate();
            $summary = $report['summary'];
            $this->line("- Audited Pages: {$summary['total_pages_audited']}");
            $this->line("- Errors: {$summary['total_errors']}");
            $this->line("- Warnings: {$summary['total_warnings']}");
            if ($summary['total_errors'] > 0) {
                $this->error("✗ Quality checks failed. Please check storage/app/seo/reports/validation-report.json");
            } else {
                $this->info("✓ Quality validation checks passed.");
            }
        } catch (\Throwable $th) {
            $this->error("✗ Content validation failed: " . $th->getMessage());
            return Command::FAILURE;
        }

        // Step 4: Sitemap Generation
        $this->info("\n[Step 4/4] Generating Sitemap XML...");
        try {
            $sitemapCount = $sitemapGenerator->generate();
            $this->info("✓ Successfully generated public/sitemap.xml with {$sitemapCount} URLs.");
        } catch (\Throwable $th) {
            $this->error("✗ Sitemap generation failed: " . $th->getMessage());
            return Command::FAILURE;
        }

        $this->info("\n==================================================");
        $this->info('✓ Programmatic SEO Rebuild Completed Successfully!');
        $this->info('==================================================');

        return Command::SUCCESS;
    }
}
