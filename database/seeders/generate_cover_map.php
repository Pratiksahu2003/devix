<?php

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$ids = [
    'gMUdVVb-u_I', 'kB0tk5E7ukY', 'geWRxFT0juc', '8h6TTCt9soM', 'EtKLA2D3ffc',
    '8gs50hFtnUA', 'TXlNzpdjzIQ', 'Uy3uL91Lp-0', '1uzpEF9BSPI', 'HdCETPWqiaQ',
    'g3cP43RbvLQ', 'C2jieZ076Gs', 'ioa5bO6kT-U', 'fqRJVrPyyco', 'dJDYTGZl_9s',
    '6GsLOaJVo_8', 'hIj0xuA2zJ0', 'BDTrrrmJQwM', 'MHx8RnmVs4M', 'GMTva2whDaQ',
    'rX36COizTY0', 'ZHQvyHhTQsw',
];

$blogs = app(App\Services\Seo\SeoDataService::class)->blogs()->sortByDesc('published_at')->values();

echo "/** @var array<string, string> Unique card cover per blog (newest-first round-robin) */\n";
echo "const DYWIX_COVER_VIDEO_BY_SLUG = [\n";

foreach ($blogs as $i => $blog) {
    echo "    '{$blog['slug']}' => '{$ids[$i % count($ids)]}',\n";
}

echo "];\n";
