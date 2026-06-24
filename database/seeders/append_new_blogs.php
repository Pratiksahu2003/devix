<?php

/**
 * Append 5 new blog entries with DyWix YouTube video links.
 * Run: php database/seeders/append_new_blogs.php
 */

$path = __DIR__.'/../../data/blogs.json';
$blogs = json_decode(file_get_contents($path), true);

function faqsFor(array $blog, int $index): array
{
    $s = $blog['service'];
    $t = $blog['title'];
    $slug = $blog['slug'];

    $sets = [
        [
            'q' => "How much does {$t} cost in Delhi NCR?",
            'a' => "Pricing depends on session length, crew, and deliverables. Hourly, half-day, and full-day packages are available at our Dwarka studio with equipment included. See <a href=\"/{$s}-cost-in-delhi\">Delhi pricing</a> or <a href=\"/pricing\">full rate card</a> for current ranges.",
        ],
        [
            'q' => 'What is included in a studio booking?',
            'a' => 'Standard bookings include the studio space, professional lighting, core microphones or cameras, climate control, Wi-Fi, and on-site engineer support. Makeup room and teleprompter access are included where applicable.',
        ],
        [
            'q' => 'Where is the studio located?',
            'a' => 'DyWix is in Dwarka Sector 13, Delhi — near Blue Line metro stations and parking at Radisson Blu Dwarka. See our <a href="/location">location page</a> and <a href="/studio-locations-delhi-ncr">NCR location hub</a>.',
        ],
        [
            'q' => 'Can I book for teams travelling from Noida or Gurugram?',
            'a' => 'Yes. Many clients travel from Noida, Gurugram, and Faridabad. Half-day minimum is popular for out-of-city teams. See <a href="/'.$s.'-in-noida">Noida</a> and <a href="/'.$s.'-in-gurugram">Gurugram</a> hub pages for drive times.',
        ],
        [
            'q' => 'Do you help with pre-production planning?',
            'a' => 'Our team reviews your brief before the session — shot lists, scripts, wardrobe, and export specs. Share materials 48 hours ahead for best results.',
        ],
        [
            'q' => 'What file formats do you deliver?',
            'a' => 'We export platform-ready files and RAW masters on request: WAV for audio, high-res JPEG/TIFF for photo, and standard video codecs. Cloud transfer is included.',
        ],
        [
            'q' => 'Is the studio available on weekends and nights?',
            'a' => 'Yes — 24×7 booking with engineer on call. Weekend slots fill fast; book early for batch production days.',
        ],
        [
            'q' => 'How do I book a session?',
            'a' => 'Use our <a href="/booking">online booking form</a>, call the studio line, or WhatsApp us. Confirm your slot with a brief description of your project.',
        ],
        [
            'q' => "Is this guide relevant for {$slug}?",
            'a' => "This article is part of our verified studio knowledge base. Explore <a href=\"/{$s}\">{$s}</a> service pages and related posts on our <a href=\"/blog\">blog</a>.",
        ],
        [
            'q' => 'Can agencies and brands get recurring package rates?',
            'a' => 'Yes. Production houses and D2C brands with monthly content needs qualify for package pricing. Contact us with your volume estimate.',
        ],
    ];

    return array_slice(array_merge(array_slice($sets, $index % 3), $sets), 0, 10);
}

$new = [
    [
        'slug' => 'women-podcast-recording-delhi-ncr',
        'title' => "Women's Podcast Recording in Delhi NCR — Real Stories, Studio Quality",
        'category' => 'podcast',
        'service' => 'podcast-studio',
        'excerpt' => 'Record authentic women-led podcasts with professional audio, video, and a supportive studio environment in Dwarka.',
        'video_url' => 'https://www.youtube.com/watch?v=gMUdVVb-u_I',
        'published_at' => '2026-01-08',
    ],
    [
        'slug' => 'bollywood-dance-reel-shoot-studio',
        'title' => 'Bollywood Dance Reel Shoot in a Professional Studio — 4K Production Guide',
        'category' => 'creator',
        'service' => 'reel-shoot-studio',
        'excerpt' => 'Shoot high-energy Bollywood dance Reels with studio lighting, multi-camera coverage, and 4K export in one session.',
        'video_url' => 'https://www.youtube.com/watch?v=kB0tk5E7ukY',
        'published_at' => '2026-01-18',
    ],
    [
        'slug' => 'model-portfolio-photography-delhi',
        'title' => 'Model Portfolio Photography in Delhi — Audition-Ready Session Guide',
        'category' => 'photography',
        'service' => 'fashion-photography',
        'excerpt' => 'Build an audition-ready modelling portfolio with professional lighting, styling support, and fast delivery in Delhi NCR.',
        'video_url' => 'https://www.youtube.com/watch?v=geWRxFT0juc',
        'published_at' => '2026-01-28',
    ],
    [
        'slug' => 'youtube-dance-tutorial-filming-guide',
        'title' => 'How to Film YouTube Dance Tutorials in a Studio — Lighting and Multi-Cam',
        'category' => 'creator',
        'service' => 'youtube-studio-rental',
        'excerpt' => 'Film step-by-step dance tutorials with clean framing, synced audio, and repeatable studio lighting for YouTube growth.',
        'video_url' => 'https://www.youtube.com/watch?v=8h6TTCt9soM',
        'published_at' => '2026-02-07',
    ],
    [
        'slug' => 'social-storytelling-vertical-video-studio',
        'title' => 'Social Storytelling and Vertical Video Production — Studio Session Guide',
        'category' => 'video',
        'service' => 'video-production',
        'excerpt' => 'Produce emotional vertical stories and short-form narratives with controlled lighting, sound, and export specs for Reels and Shorts.',
        'video_url' => 'https://www.youtube.com/watch?v=EtKLA2D3ffc',
        'published_at' => '2026-02-17',
    ],
];

$existingSlugs = array_column($blogs, 'slug');
$startIndex = count($blogs);
$added = 0;

foreach ($new as $i => $blog) {
    if (in_array($blog['slug'], $existingSlugs, true)) {
        echo 'Skipping existing slug: '.$blog['slug'].PHP_EOL;
        continue;
    }

    $blog['faqs'] = faqsFor($blog, $startIndex + $i);
    $blog['tags'] = [$blog['category'], 'delhi ncr', $blog['service'], 'studio guide', '2026'];
    $blog['author'] = 'DyWix Studio Team';
    $blogs[] = $blog;
    $added++;
}

file_put_contents($path, json_encode($blogs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)."\n");
echo "Added {$added} blogs. Total: ".count($blogs).PHP_EOL;
