<?php
$directories = [
    'public/pooja' => 'Fashion',
    'public/vidhu' => 'Portraits',
    'public/studio' => 'Studio'
];

$items = [];
$colors = ['#f5f5f7', '#e5e7eb', '#dbeafe', '#fef3c7', '#ede9fe', '#fde68a'];

foreach ($directories as $dir => $cat) {
    $files = glob(__DIR__ . '/' . $dir . '/*.{jpg,jpeg,png,JPG,JPEG,PNG}', GLOB_BRACE);
    foreach ($files as $file) {
        $filename = basename($file);
        $items[] = [
            'alt' => "$cat session - $filename",
            'cat' => $cat,
            'color' => $colors[array_rand($colors)],
            'src' => '/' . basename($dir) . '/' . $filename
        ];
    }
}

echo "        \$items = [\n";
foreach ($items as $item) {
    echo "            ['alt' => '{$item['alt']}', 'cat' => '{$item['cat']}', 'color' => '{$item['color']}', 'src' => '{$item['src']}'],\n";
}
echo "        ];\n";
