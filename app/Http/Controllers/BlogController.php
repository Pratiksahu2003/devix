<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Services\Blog\JsonBlogService;
use App\Services\Seo\SeoMetaService;
use App\Services\Seo\SeoSchemaService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(
        protected JsonBlogService $jsonBlog,
    ) {}

    public function index(Request $request, SeoMetaService $meta, SeoSchemaService $schema)
    {
        if ($this->hasDatabasePosts()) {
            return $this->indexFromDatabase($request, $meta, $schema);
        }

        $posts = $this->jsonBlog->paginated($request->get('category'));
        $categories = $this->jsonBlog->categories();
        $seo = $this->buildBlogIndexSeo($request, $categories, $posts, $meta, $schema);

        return view('blog.index', compact('posts', 'categories', 'seo'));
    }

    public function show($slug, SeoMetaService $meta, SeoSchemaService $schema)
    {
        if ($this->hasDatabasePosts()) {
            return $this->showFromDatabase($slug, $meta, $schema);
        }

        $post = $this->jsonBlog->find($slug);

        abort_if(! $post, 404);

        $adjacent = $this->jsonBlog->adjacent($post);
        $previous = $adjacent['previous'];
        $next = $adjacent['next'];
        $relatedPosts = $this->jsonBlog->related($post);
        $categories = $this->jsonBlog->categoriesWithCounts();
        $latestPosts = $this->jsonBlog->latest($post);
        $seo = $this->buildBlogPostSeo($post, $meta, $schema);

        return view('blog.show', compact('post', 'previous', 'next', 'relatedPosts', 'categories', 'latestPosts', 'seo'));
    }

    protected function hasDatabasePosts(): bool
    {
        return Post::where('is_published', true)->whereNotNull('published_at')->exists();
    }

    protected function indexFromDatabase(Request $request, SeoMetaService $meta, SeoSchemaService $schema)
    {
        $query = Post::with(['category', 'author'])
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->latest('published_at');

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $posts = $query->paginate(9);
        $categories = Category::has('posts')->get();
        $seo = $this->buildBlogIndexSeo($request, $categories, $posts, $meta, $schema);

        return view('blog.index', compact('posts', 'categories', 'seo'));
    }

    protected function showFromDatabase($slug, SeoMetaService $meta, SeoSchemaService $schema)
    {
        $post = Post::with(['category', 'author'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $previous = Post::where('is_published', true)->where('id', '<', $post->id)->orderBy('id', 'desc')->first();
        $next = Post::where('is_published', true)->where('id', '>', $post->id)->orderBy('id', 'asc')->first();

        $relatedPosts = Post::with(['category', 'author'])
            ->where('is_published', true)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        $categories = Category::has('posts')->withCount('posts')->get();

        $latestPosts = Post::with(['category'])
            ->where('is_published', true)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        $seo = $this->buildBlogPostSeo($post, $meta, $schema);

        return view('blog.show', compact('post', 'previous', 'next', 'relatedPosts', 'categories', 'latestPosts', 'seo'));
    }

    protected function buildBlogIndexSeo(Request $request, $categories, $paginator, SeoMetaService $meta, SeoSchemaService $schema): array
    {
        $categorySlug = $request->get('category');
        $categoryName = null;

        if ($categorySlug) {
            $category = $categories->firstWhere('slug', $categorySlug);
            $categoryName = $category?->name;
        }

        $page = $paginator->currentPage();
        $lastPage = $paginator->lastPage();

        return [
            'meta' => $meta->buildBlogIndexMeta($categorySlug, $categoryName, $page),
            'schema_graph' => $schema->buildBlogIndexGraph($categoryName),
            'page' => $page,
            'lastPage' => $lastPage,
            'categorySlug' => $categorySlug,
        ];
    }

    protected function buildBlogPostSeo(object $post, SeoMetaService $meta, SeoSchemaService $schema): array
    {
        return [
            'meta' => $meta->buildBlogPostMeta($post),
            'schema_graph' => $schema->buildBlogPostGraph($post),
        ];
    }
}
