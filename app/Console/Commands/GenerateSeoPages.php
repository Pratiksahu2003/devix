<?php

namespace App\Console\Commands;

use App\Services\SeoPageGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateSeoPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:generate-pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate combinations of programmatic SEO landing pages from services and locations JSON data';

    /**
     * Execute the console command.
     */
    public function handle(SeoPageGenerator $generator): int
    {
        $this->info('Starting programmatic SEO page generation...');

        try {
            $pages = $generator->generate();
            $count = count($pages);

            // Write back to pages.json
            file_put_contents(storage_path('app/seo/pages.json'), json_encode($pages, JSON_PRETTY_PRINT));

            $this->info("Successfully generated and saved {$count} pages to storage/app/seo/pages.json!");
            
            // Output summary
            $indexableCount = count(array_filter($pages, fn($p) => $p['indexable']));
            $noindexCount = $count - $indexableCount;
            
            $this->line("- Indexable Pages: {$indexableCount}");
            $this->line("- Noindex Pages: {$noindexCount}");

            return Command::SUCCESS;
        } catch (\Throwable $th) {
            $this->error('Error generating SEO pages: ' . $th->getMessage());
            $this->error($th->getTraceAsString());
            return Command::FAILURE;
        }
    }
}
