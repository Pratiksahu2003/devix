<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Podcasting 101',
                'description' => 'Beginner guides, essential tips, and how to start your very first podcast successfully.',
            ],
            [
                'name' => 'Audio & Video Gear',
                'description' => 'Reviews, comparisons, and setup guides for microphones, cameras, mixers, and lighting.',
            ],
            [
                'name' => 'Marketing & Growth',
                'description' => 'Strategies to promote your show, grow your audience, and attract high-value sponsorships.',
            ],
            [
                'name' => 'Creator Spotlights',
                'description' => 'Interviews and deep dives into the workflows of successful podcasters and content creators.',
            ],
            [
                'name' => 'Studio News & Updates',
                'description' => 'Announcements, new equipment additions, and events happening at our creative studio.',
            ],
            [
                'name' => 'Production & Editing',
                'description' => 'Advanced techniques for audio mixing, video editing, and streamlining your post-production workflow.',
            ],
            [
                'name' => 'Monetization Strategy',
                'description' => 'How to turn your content into a business through ads, merchandise, courses, and Patreon.',
            ],
            [
                'name' => 'Live Streaming',
                'description' => 'Best practices for broadcasting live, engaging with chat, and multi-platform simulcasting.',
            ],
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description'],
                ]
            );
        }
    }
}
