<?php

namespace App\Console\Commands;

use App\Services\SeoPageRepository;
use Illuminate\Console\Command;

class WarmSeoCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:warm-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Warm up the filesystem cache for all programmatic SEO pages and configuration';

    /**
     * Execute the console command.
     */
    public function handle(SeoPageRepository $repository): int
    {
        $this->info('Clearing current SEO cache structures...');
        $repository->clearCache();

        $this->info('Loading and caching database-free SEO assets...');

        try {
            $services = $repository->getAllServices();
            $this->line("- Caching " . count($services) . " services.");

            $locations = $repository->getAllLocations();
            $this->line("- Caching " . count($locations) . " locations.");

            $blogs = $repository->getAllBlogPages();
            $this->line("- Caching " . count($blogs) . " blogs.");

            $pages = $repository->getAllPages();
            $this->line("- Caching " . count($pages) . " compiled landing pages.");

            // Touch individual slug lookups to build mapping
            $repository->getPageBySlug('non-existent-test-slug');
            $this->line("- Building slug resolution maps.");

            $this->info('Programmatic SEO cache successfully warmed!');
            return Command::SUCCESS;
        } catch (\Throwable $th) {
            $this->error('Failed to warm SEO cache: ' . $th->getMessage());
            return Command::FAILURE;
        }
    }
}
