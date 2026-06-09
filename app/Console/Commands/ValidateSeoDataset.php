<?php

namespace App\Console\Commands;

use App\Services\Seo\SeoDataService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ValidateSeoDataset extends Command
{
    protected $signature = 'seo:validate-dataset';

    protected $description = 'Validate SEO JSON datasets in data/ and report counts';

    public function handle(SeoDataService $data): int
    {
        $path = config('seo.data_path');
        $files = config('seo.files', []);
        $hasError = false;

        $this->info("SEO dataset path: {$path}");
        $this->newLine();

        $rows = [];

        foreach ($files as $type => $file) {
            $fullPath = "{$path}/{$file}";

            if (! File::exists($fullPath)) {
                $this->error("Missing: {$file}");
                $hasError = true;

                continue;
            }

            $raw = File::get($fullPath);
            $decoded = json_decode($raw, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->error("Invalid JSON in {$file}: ".json_last_error_msg());
                $hasError = true;

                continue;
            }

            if (! is_array($decoded)) {
                $this->error("{$file} must contain a JSON array.");
                $hasError = true;

                continue;
            }

            $rows[] = [$type, $file, count($decoded), $this->formatBytes(strlen($raw))];
        }

        if ($rows !== []) {
            $this->table(['Type', 'File', 'Records', 'Size'], $rows);
        }

        if ($hasError) {
            return self::FAILURE;
        }

        $data->flushCache();
        $this->info('All JSON datasets valid. Cache flushed.');

        return self::SUCCESS;
    }

    protected function formatBytes(int $bytes): string
    {
        if ($bytes < 1024) {
            return "{$bytes} B";
        }

        return round($bytes / 1024, 1).' KB';
    }
}
