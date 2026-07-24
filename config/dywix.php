<?php

$dywixImages = [
    'IMG_4008.jpg', 'IMG_4009.jpg', 'IMG_4010.jpg', 'IMG_4011.jpg', 'IMG_4012.jpg',
    'IMG_4013.jpg', 'IMG_4014.jpg', 'IMG_4015.jpg', 'IMG_4016.jpg', 'IMG_4017.jpg',
    'IMG_4018.jpg', 'IMG_4019.jpg', 'IMG_4020.jpg', 'IMG_4021.jpg', 'IMG_4022.jpg',
    'IMG_4023.jpg', 'IMG_4024.jpg', 'IMG_4025.jpg', 'IMG_4026.jpg', 'IMG_4027.jpg',
    'IMG_4028.jpg', 'IMG_4029.jpg', 'IMG_4030.jpg', 'IMG_4031.jpg', 'IMG_4036.jpg',
    'IMG_4037.jpg', 'IMG_4038.jpg', 'IMG_4039.jpg', 'IMG_4040.jpg', 'IMG_4041.jpg',
    'IMG_4042.jpg', 'IMG_4043.jpg', 'IMG_4044.jpg', 'IMG_4045.jpg', 'IMG_4046.jpg',
    'IMG_4047.jpg', 'IMG_4048.jpg', 'IMG_4050.jpg', 'IMG_4051.jpg', 'IMG_4052.jpg',
    'IMG_4053.jpg', 'IMG_4054.jpg', 'IMG_4055.jpg', 'IMG_4056.jpg', 'IMG_4057.jpg',
    'IMG_4058.jpg', 'IMG_4059.jpg', 'IMG_4060.jpg', 'IMG_4061.jpg', 'IMG_4062.jpg',
    'IMG_4063.jpg', 'IMG_4064.jpg', 'IMG_4065.jpg', 'IMG_4066.jpg', 'IMG_4067.jpg',
    'IMG_4068.jpg', 'IMG_4069.jpg', 'IMG_4070.jpg', 'IMG_4071.jpg', 'IMG_4072.jpg',
    'IMG_4073.jpg', 'IMG_4074.jpg', 'IMG_4075.jpg', 'IMG_4076.jpg', 'IMG_4077.jpg',
    'IMG_4078.jpg', 'IMG_4079.jpg', 'IMG_4081.jpg', 'IMG_4082.jpg', 'IMG_4083.jpg',
    'IMG_4084.jpg', 'IMG_4085.jpg', 'IMG_4087.jpg', 'IMG_4088.jpg',
];

return [
    'brand_name' => env('DYWIX_BRAND_NAME', 'DyWix Studio'),
    'phone' => env('DYWIX_PHONE', '+91-9540467000'),
    'email' => env('DYWIX_EMAIL', 'studio@dywix.com'),
    'address' => env('DYWIX_ADDRESS', '4th Floor, 96A, Block-B, Pocket-10, Dwarka Sector-13, New Delhi 110078'),
    'whatsapp_number' => env('DYWIX_WHATSAPP', '+91-9540467000'),
    'whatsapp_link' => env('DYWIX_WHATSAPP_LINK', 'https://wa.me/919540467000'),
    'google_maps_link' => env('DYWIX_MAPS_LINK', 'https://maps.app.goo.gl/bBpbjbDbTEfxShzL7'),
    'logo_path' => env('DYWIX_LOGO_PATH', '/logo/logo.webp'),
    'default_image' => env('DYWIX_DEFAULT_IMAGE', 'storage/dywix/IMG_4008.jpg'),
    'base_url' => env('DYWIX_BASE_URL', 'https://www.dywix.com'),
    'social_links' => [
        'facebook' => 'https://www.facebook.com/dywix1',
        'instagram' => 'https://www.instagram.com/dywixstudio/',
        'youtube' => 'https://youtube.com/@dywixstudio',
        'linkedin' => 'https://www.linkedin.com/company/dywix-studio/',
        'twitter' => 'https://twitter.com/dywixstudio',
    ],

    /*
    |--------------------------------------------------------------------------
    | Studio gallery images (storage/app/public/dywix)
    |--------------------------------------------------------------------------
    */
    'images_dir' => 'storage/dywix',
    'images' => $dywixImages,

    /*
    |--------------------------------------------------------------------------
    | Unique per-page image ranges (index into images[], no within-page dupes)
    |--------------------------------------------------------------------------
    */
    'pages' => [
        'podcast' => ['offset' => 0, 'count' => 7],
        'videography' => ['offset' => 7, 'count' => 7],
        'corporate_films' => ['offset' => 14, 'count' => 7],
        'tvc' => ['offset' => 21, 'count' => 7],
        'reels' => ['offset' => 28, 'count' => 7],
        'edit_room' => ['offset' => 35, 'count' => 7],
        'about' => ['offset' => 42, 'count' => 13],
        'booking' => ['offset' => 55, 'count' => 5],
        'pricing' => ['offset' => 60, 'count' => 4],
        'photography' => ['offset' => 64, 'count' => 1],
        'services' => ['offset' => 65, 'count' => 1],
        'location' => ['offset' => 66, 'count' => 2],
        'home_cta' => ['offset' => 68, 'count' => 1],
        'home_showcase' => ['offset' => 69, 'count' => 1],
        'seo_hero' => ['offset' => 70, 'count' => 1],
        'home_slider' => ['offset' => 14, 'count' => 6],
        'home_pricing' => ['offset' => 8, 'count' => 6],
        'home_podcast' => ['offset' => 0, 'count' => 8],
        'collaborations' => ['offset' => 48, 'count' => 9],
        'use_cases' => ['offset' => 30, 'count' => 7],
        'studio_specs' => ['offset' => 20, 'count' => 4],
        'studio_specs_gallery' => ['offset' => 40, 'count' => 18],
    ],

    'roles' => [
        'hero' => 'IMG_4008.jpg',
        'podcast' => 'IMG_4008.jpg',
        'video' => 'IMG_4015.jpg',
        'photography' => 'IMG_4076.jpg',
        'creator' => 'IMG_4036.jpg',
        'cta' => 'IMG_4081.jpg',
        'booking' => 'IMG_4067.jpg',
        'about' => 'IMG_4054.jpg',
        'services' => 'IMG_4077.jpg',
        'pricing' => 'IMG_4072.jpg',
        'studio' => 'IMG_4029.jpg',
        'slider' => [
            'IMG_4022.jpg', 'IMG_4023.jpg', 'IMG_4024.jpg',
            'IMG_4025.jpg', 'IMG_4026.jpg', 'IMG_4027.jpg',
        ],
    ],
];
