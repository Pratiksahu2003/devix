<?php

namespace App\Console\Commands;

use App\Services\SeoSitemapGenerator;
use Illuminate\Console\Command;

class GenerateSeoSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate public sitemap XML files including static and indexable programmatic SEO URLs';

    /**
     * Execute the console command.
     */
    public function handle(SeoSitemapGenerator $generator): int
    {
        $this->info('Starting XML sitemap compilation...');

        try {
            $count = $generator->generate();
            $this->info("Successfully generated public/sitemap.xml with {$count} indexable URLs!");
            return Command::SUCCESS;
        } catch (\Throwable $th) {
            $this->error('Failed to generate sitemap: ' . $th->getMessage());
            return Command::FAILURE;
        }
    }
}
