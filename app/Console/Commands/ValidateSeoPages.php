<?php

namespace App\Console\Commands;

use App\Services\SeoContentValidator;
use Illuminate\Console\Command;

class ValidateSeoPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:validate-pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Validate compiled programmatic SEO page contents for duplicates, length, and links';

    /**
     * Execute the console command.
     */
    public function handle(SeoContentValidator $validator): int
    {
        $this->info('Starting content audits and validator checks...');

        try {
            $report = $validator->validate();
            $summary = $report['summary'];

            $this->info("Validation completed. Audited {$summary['total_pages_audited']} pages.");
            
            if ($summary['total_errors'] > 0) {
                $this->error("Found {$summary['total_errors']} errors in pages. Please check reports!");
            } else {
                $this->info("Zero errors found! Quality check passed.");
            }

            if ($summary['total_warnings'] > 0) {
                $this->warn("Found {$summary['total_warnings']} warnings. Review suggested improvements.");
            }

            $this->line("Report saved at: storage/app/seo/reports/validation-report.json");

            return $summary['total_errors'] > 0 ? Command::FAILURE : Command::SUCCESS;
        } catch (\Throwable $th) {
            $this->error('Failed to run SEO page validation: ' . $th->getMessage());
            return Command::FAILURE;
        }
    }
}
