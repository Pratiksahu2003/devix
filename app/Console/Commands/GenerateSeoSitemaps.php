<?php

namespace App\Console\Commands;

use App\Services\Seo\SeoSitemapService;
use Illuminate\Console\Command;

class GenerateSeoSitemaps extends Command
{
    protected $signature = 'seo:sitemaps {--fresh : Regenerate all sitemap files}';

    protected $description = 'Generate SEO hub sitemap XML files from JSON data sources';

    public function handle(SeoSitemapService $sitemaps): int
    {
        $this->info('Generating SEO sitemaps...');

        $sitemaps->writeAll();

        $count = collect(config('seo.sitemaps'))->count();
        $this->info("Generated {$count} sitemap files in public/");

        return self::SUCCESS;
    }
}
