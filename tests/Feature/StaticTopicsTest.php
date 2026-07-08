<?php

namespace Tests\Feature;

use App\Services\Seo\SeoSitemapService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StaticTopicsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that all static topics/pages can be resolved successfully.
     */
    public function test_static_topics_can_be_resolved(): void
    {
        $routes = [
            'home',
            'seo.locations',
            'seo.industries',
            'seo.guides',
            'seo.resources',
            'seo.directory',
            'seo.sitemaps',
            'pages.pricing',
            'pages.services',
            'pages.about',
            'pages.gallery',
            'pages.help',
            'pages.booking',
            'pages.contact',
            'pages.location',
            'pages.studio-specs',
            'pages.use-cases',
            'pages.collaborations',
            'pages.edit-room',
            'blog.index',
        ];

        foreach ($routes as $route) {
            $response = $this->get(route($route));
            $response->assertStatus(200);
        }
    }

    /**
     * Test that all static topics are included in the static sitemap.
     */
    public function test_static_topics_are_included_in_sitemap(): void
    {
        $sitemapService = app(SeoSitemapService::class);
        $xml = $sitemapService->typeXml('static');

        $routes = [
            'home',
            'seo.locations',
            'seo.industries',
            'seo.guides',
            'seo.resources',
            'seo.directory',
            'seo.sitemaps',
            'pages.pricing',
            'pages.services',
            'pages.about',
            'pages.gallery',
            'pages.help',
            'pages.booking',
            'pages.contact',
            'pages.location',
            'pages.studio-specs',
            'pages.use-cases',
            'pages.collaborations',
            'pages.edit-room',
            'blog.index',
        ];

        foreach ($routes as $route) {
            $url = route($route);
            $this->assertStringContainsString(e($url), $xml);
        }
    }
}
