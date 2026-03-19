<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = Admin::create([
            'name' => 'SEO Admin',
            'email' => 'seo@example.com',
            'password' => bcrypt('password'),
        ]);
    }

    public function test_public_can_view_published_seo_page()
    {
        $page = Page::create([
            'admin_id' => $this->admin->id,
            'title' => 'Podcast Rental Atlanta',
            'slug' => 'podcast-rental-atlanta',
            'content' => 'Premium studio space available.',
            'meta_title' => 'Best Podcast Studio in Atlanta',
            'meta_robots' => true,
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get('/' . $page->slug);
        
        $response->assertStatus(200);
        $response->assertSee('Podcast Rental Atlanta');
        $response->assertSee('Best Podcast Studio in Atlanta');
    }

    public function test_public_cannot_view_draft_seo_page()
    {
        $page = Page::create([
            'admin_id' => $this->admin->id,
            'title' => 'Secret Launch Page',
            'slug' => 'secret-launch-page',
            'content' => 'Top secret content',
            'is_published' => false,
        ]);

        $response = $this->get('/' . $page->slug);
        
        $response->assertStatus(404);
    }
    
    public function test_seo_page_injects_noindex_tag()
    {
        $page = Page::create([
            'admin_id' => $this->admin->id,
            'title' => 'Hidden Promo',
            'slug' => 'hidden-promo',
            'content' => 'Hidden promo content',
            'meta_robots' => false,
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get('/' . $page->slug);
        
        $response->assertStatus(200);
        $response->assertSee('noindex, nofollow');
    }
}
