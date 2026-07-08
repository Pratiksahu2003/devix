<?php

use Illuminate\Contracts\Console\Kernel;

// Bootstrap the Laravel Application
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

// Resolve the Programmatic SEO services
$generator = app(\App\Services\SeoPageGenerator::class);
$sitemapGenerator = app(\App\Services\SeoSitemapGenerator::class);
$repository = app(\App\Services\SeoPageRepository::class);

echo "--------------------------------------------------\n";
echo "Starting Programmatic SEO Generation...\n";
echo "--------------------------------------------------\n";

try {
    $pages = $generator->generate();
    file_put_contents(storage_path('app/seo/pages.json'), json_encode($pages, JSON_PRETTY_PRINT));
    
    // 2. Clear cache to force repository to read fresh records
    $repository->clearCache();
    echo "✓ Successfully generated and saved " . count($pages) . " page combinations to storage/app/seo/pages.json!\n";

    // 3. Compile the sitemaps (including static, blog, database and programmatic pages)
    $sitemapCount = $sitemapGenerator->generate();
    echo "✓ Successfully compiled sitemaps containing {$sitemapCount} URLs!\n";
    
    echo "--------------------------------------------------\n";
    echo "Programmatic SEO Rebuild Complete!\n";
    echo "--------------------------------------------------\n";
} catch (\Throwable $e) {
    echo "❌ Error during generation: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
