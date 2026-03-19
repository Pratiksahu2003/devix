<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\Page;
use Illuminate\Support\Carbon;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a dynamic sitemap.xml for all public blog posts and SEO pages.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting sitemap generation...');

        $posts = Post::where('is_published', true)->get();
        
        // We only want pages that DO NOT have meta_robots set to false (noindex)
        $pages = Page::where('is_published', true)
            ->where('meta_robots', true)
            ->get();

        $baseUrl = config('app.url');
        if (str_ends_with($baseUrl, '/')) {
            $baseUrl = substr($baseUrl, 0, -1);
        }

        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        // Add Home Page
        $homeUrl = $xml->addChild('url');
        $homeUrl->addChild('loc', $baseUrl);
        $homeUrl->addChild('lastmod', Carbon::now()->toAtomString());
        $homeUrl->addChild('changefreq', 'daily');
        $homeUrl->addChild('priority', '1.0');
        
        // Add Blog Index
        $blogUrl = $xml->addChild('url');
        $blogUrl->addChild('loc', $baseUrl . '/blog');
        $blogUrl->addChild('lastmod', Carbon::now()->toAtomString());
        $blogUrl->addChild('changefreq', 'daily');
        $blogUrl->addChild('priority', '0.9');

        // Add Posts
        foreach ($posts as $post) {
            $url = $xml->addChild('url');
            $url->addChild('loc', $baseUrl . '/blog/' . $post->slug);
            $url->addChild('lastmod', $post->updated_at->toAtomString());
            $url->addChild('changefreq', 'weekly');
            $url->addChild('priority', '0.8');
        }

        // Add SEO Pages
        foreach ($pages as $page) {
            $url = $xml->addChild('url');
            $url->addChild('loc', $baseUrl . '/' . $page->slug);
            $url->addChild('lastmod', $page->updated_at->toAtomString());
            $url->addChild('changefreq', 'weekly');
            $url->addChild('priority', '0.8');
        }

        // Output to public/sitemap.xml
        $xml->asXML(public_path('sitemap.xml'));

        $this->info('Sitemap successfully generated at ' . public_path('sitemap.xml'));
        return self::SUCCESS;
    }
}
