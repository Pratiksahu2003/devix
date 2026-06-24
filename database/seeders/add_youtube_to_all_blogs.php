<?php

/**
 * Assign topic-matched @dywixstudio YouTube URLs to every blog post.
 * Run: php database/seeders/add_youtube_to_all_blogs.php
 */

require __DIR__.'/blog_youtube_videos.php';

$path = __DIR__.'/../../data/blogs.json';
$blogs = json_decode(file_get_contents($path), true);
$updated = 0;

foreach ($blogs as &$blog) {
    $url = dywixYoutubeUrlForBlog($blog);

    if (($blog['video_url'] ?? '') === $url) {
        continue;
    }

    $blog['video_url'] = $url;
    $updated++;
}
unset($blog);

file_put_contents($path, json_encode($blogs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)."\n");

$withVideo = count(array_filter($blogs, fn ($b) => ! empty($b['video_url'])));
echo "Updated video_url on {$updated} blogs. Total with video: {$withVideo}/".count($blogs).PHP_EOL;
