<?php

/**
 * Maps @dywixstudio YouTube videos to blog posts by topic/service.
 */

/** @var array<string, list<string>> */
const DYWIX_YOUTUBE_POOLS = [
    'podcast-studio' => [
        'gMUdVVb-u_I', // Podcast for Girls — Real Stories @dywixstudio
    ],
    'reel-shoot-studio' => [
        'kB0tk5E7ukY', // Namak Ishq Ka — 4K Bollywood dance @ DyWix Studio
        'TXlNzpdjzIQ', // Naino Wale Ne Dance Cover
        'Uy3uL91Lp-0', // Ek Ucha Lamba Kad — Bollywood Dance Cover
        '1uzpEF9BSPI', // Taki Taki x DJ Snake Mashup
        'ioa5bO6kT-U', // Chaand Sifarish — Bollywood Dance Cover
        'fqRJVrPyyco', // Nashe Si Chadh Gayi — Bollywood Dance Cover
        'dJDYTGZl_9s', // Illegal Weapon — High-Energy Bollywood Performance
        'HdCETPWqiaQ', // Azul — Punjabi Dance Cover
        'g3cP43RbvLQ', // Daiya Daiya Re — Bollywood Expressive Performance
        'C2jieZ076Gs', // Taal Se Taal Mila — Classical Fusion Choreography
    ],
    'youtube-studio-rental' => [
        '8h6TTCt9soM', // Tevar Dance Tutorial — step-by-step @dywixstudio
        '8gs50hFtnUA', // Dopamine Dance Tutorial — step-by-step
        'kB0tk5E7ukY', // 4K talking-head / performance reference
    ],
    'fashion-photography' => [
        'geWRxFT0juc', // Become a Model — portfolio / audition content
        'rX36COizTY0', // Ghar More Pardesiya — expressive fashion performance
        '6GsLOaJVo_8', // Bole Chudiyaan — wedding / fashion vibes
        'g3cP43RbvLQ', // Daiya Daiya Re — expressive performance
        'BDTrrrmJQwM', // Sweetheart — contemporary expressive
    ],
    'product-photography' => [
        'geWRxFT0juc', // Model / catalog-adjacent portfolio shoot
        'kB0tk5E7ukY', // 4K studio production reference
        'GMTva2whDaQ', // Romantic performance — lifestyle-adjacent
    ],
    'corporate-photography' => [
        'geWRxFT0juc',
        'kB0tk5E7ukY',
    ],
    'video-production' => [
        'EtKLA2D3ffc', // Social storytelling short
        'ZHQvyHhTQsw', // Behind-the-scenes / vlog-style studio life
        'MHx8RnmVs4M', // Gehra Hua — cinematic contemporary
        'hIj0xuA2zJ0', // Badi Mushkil — expressive narrative performance
        'BDTrrrmJQwM', // Sweetheart — contemporary production
    ],
    'green-screen-studio' => [
        'ioa5bO6kT-U',
        'fqRJVrPyyco',
        'dJDYTGZl_9s',
        '1uzpEF9BSPI',
    ],
    'tv-commercial-studio' => [
        'dJDYTGZl_9s',
        '1uzpEF9BSPI',
        'kB0tk5E7ukY',
        'HdCETPWqiaQ',
    ],
    'influencer-studio' => [
        'kB0tk5E7ukY',
        'TXlNzpdjzIQ',
        'EtKLA2D3ffc',
        'ZHQvyHhTQsw',
        'ioa5bO6kT-U',
    ],
    'default' => [
        'kB0tk5E7ukY',
        'TXlNzpdjzIQ',
        'gMUdVVb-u_I',
        'geWRxFT0juc',
        '8h6TTCt9soM',
    ],
];

/** @var array<string, string> Best single match per blog slug */
const DYWIX_YOUTUBE_SLUG_MAP = [
    'women-podcast-recording-delhi-ncr' => 'gMUdVVb-u_I',
    'bollywood-dance-reel-shoot-studio' => 'kB0tk5E7ukY',
    'model-portfolio-photography-delhi' => 'geWRxFT0juc',
    'youtube-dance-tutorial-filming-guide' => '8h6TTCt9soM',
    'social-storytelling-vertical-video-studio' => 'EtKLA2D3ffc',
    'how-to-start-podcast-delhi-ncr' => 'gMUdVVb-u_I',
    'interview-podcast-recording-tips' => 'gMUdVVb-u_I',
    'legal-firm-podcast-studio-guide' => 'gMUdVVb-u_I',
    'multi-camera-podcast-setup' => 'gMUdVVb-u_I',
    'instagram-reels-studio-workflow' => 'TXlNzpdjzIQ',
    'reel-shoot-studio-gurugram' => 'ioa5bO6kT-U',
    'youtube-studio-setup-budget' => '8gs50hFtnUA',
    'youtube-thumbnail-shoot-tips' => 'kB0tk5E7ukY',
    'fashion-photoshoot-checklist' => 'rX36COizTY0',
    'fashion-lookbook-photography-delhi' => '6GsLOaJVo_8',
    'green-screen-chroma-key-guide' => 'dJDYTGZl_9s',
    'tv-commercial-production-india' => '1uzpEF9BSPI',
    'brand-film-production-delhi' => 'MHx8RnmVs4M',
    'startup-explainer-video-guide' => 'hIj0xuA2zJ0',
    'healthcare-video-production-guide' => 'BDTrrrmJQwM',
    'content-batch-production-ncr' => 'ZHQvyHhTQsw',
    'influencer-content-strategy-2026' => 'EtKLA2D3ffc',
];

function dywixYoutubeVideoIdForBlog(array $blog): string
{
    $slug = $blog['slug'] ?? '';

    if (isset(DYWIX_YOUTUBE_SLUG_MAP[$slug])) {
        return DYWIX_YOUTUBE_SLUG_MAP[$slug];
    }

    $service = $blog['service'] ?? 'default';
    $pool = DYWIX_YOUTUBE_POOLS[$service] ?? DYWIX_YOUTUBE_POOLS['default'];

    $pick = abs(crc32($slug)) % count($pool);

    return $pool[$pick];
}

function dywixYoutubeUrlForBlog(array $blog): string
{
    return 'https://www.youtube.com/watch?v='.dywixYoutubeVideoIdForBlog($blog);
}
