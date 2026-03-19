<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Setup an authenticated admin without using Factory
        $this->admin = Admin::create([
            'name' => 'Admin User',
            'email' => 'admin_blog_tests@example.com',
            'password' => bcrypt('password'),
        ]);
    }

    public function test_public_can_view_published_posts()
    {
        Post::create([
            'admin_id' => $this->admin->id,
            'title' => 'Published Post',
            'slug' => 'published-post',
            'content' => 'Content here',
            'is_published' => true,
            'published_at' => now(),
        ]);

        Post::create([
            'admin_id' => $this->admin->id,
            'title' => 'Draft Post',
            'slug' => 'draft-post',
            'content' => 'Draft here',
            'is_published' => false,
        ]);

        $response = $this->get(route('blog.index'));
        
        $response->assertStatus(200);
        $response->assertSee('Published Post');
        $response->assertDontSee('Draft Post');
    }

    public function test_public_can_view_single_published_post()
    {
        $post = Post::create([
            'admin_id' => $this->admin->id,
            'title' => 'My SEO Title',
            'slug' => 'my-seo-title',
            'content' => 'Article Content',
            'meta_description' => 'A unique meta description for SEO bots',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get(route('blog.show', $post->slug));
        
        $response->assertStatus(200);
        $response->assertSee('My SEO Title');
        $response->assertSee('A unique meta description for SEO bots');
    }

    public function test_public_cannot_view_draft_post()
    {
        $post = Post::create([
            'admin_id' => $this->admin->id,
            'title' => 'Secret Draft',
            'slug' => 'secret-draft',
            'content' => 'Article Content',
            'is_published' => false,
        ]);

        $response = $this->get(route('blog.show', $post->slug));
        
        $response->assertStatus(404);
    }

    public function test_admin_can_create_category()
    {
        $response = $this->actingAs($this->admin, 'admin')->post(route('admin.categories.store'), [
            'name' => 'Technology',
            'slug' => 'tech',
            'description' => 'Tech news tracking',
        ]);

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', ['slug' => 'tech']);
    }

    public function test_admin_can_create_post_with_image()
    {
        Storage::fake('public');
        
        $category = Category::create([
            'name' => 'News Updates', 
            'slug' => 'news'
        ]);

        $file = UploadedFile::fake()->image('cover.jpg');

        $response = $this->actingAs($this->admin, 'admin')->post(route('admin.posts.store'), [
            'title' => 'New Awesome Article',
            'category_id' => $category->id,
            'content' => 'Full article body',
            'cover_image' => $file,
            'is_published' => 1,
        ]);

        $response->assertRedirect(route('admin.posts.index'));
        $this->assertDatabaseHas('posts', [
            'title' => 'New Awesome Article',
            'slug' => 'new-awesome-article',
            'is_published' => 1,
        ]);

        $post = Post::where('slug', 'new-awesome-article')->first();
        $this->assertNotNull($post->cover_image);
        Storage::disk('public')->assertExists($post->cover_image);
    }
}
