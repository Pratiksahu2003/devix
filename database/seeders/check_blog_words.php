<?php

require __DIR__.'/../../vendor/autoload.php';
$app = require_once __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$data = app(App\Services\Seo\SeoDataService::class);
$builder = app(App\Services\Blog\BlogContentBuilder::class);

$blogs = $data->blogs();
echo 'Total blogs: '.$blogs->count().PHP_EOL;

$counts = $blogs->map(fn ($b) => $builder->wordCount($builder->build($b)));
echo 'Min words: '.$counts->min().PHP_EOL;
echo 'Max words: '.$counts->max().PHP_EOL;
echo 'Avg words: '.round($counts->avg()).PHP_EOL;
