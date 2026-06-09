<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Services\Blog\JsonBlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(
        protected JsonBlogService $jsonBlog,
    ) {}

    public function index(Request $request)
    {
        if ($this->hasDatabasePosts()) {
            return $this->indexFromDatabase($request);
        }

        $posts = $this->jsonBlog->paginated($request->get('category'));
        $categories = $this->jsonBlog->categories();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        if ($this->hasDatabasePosts()) {
            return $this->showFromDatabase($slug);
        }

        $post = $this->jsonBlog->find($slug);

        abort_if(! $post, 404);

        $adjacent = $this->jsonBlog->adjacent($post);
        $previous = $adjacent['previous'];
        $next = $adjacent['next'];
        $relatedPosts = $this->jsonBlog->related($post);
        $categories = $this->jsonBlog->categoriesWithCounts();
        $latestPosts = $this->jsonBlog->latest($post);

        return view('blog.show', compact('post', 'previous', 'next', 'relatedPosts', 'categories', 'latestPosts'));
    }

    protected function hasDatabasePosts(): bool
    {
        return Post::where('is_published', true)->whereNotNull('published_at')->exists();
    }

    protected function indexFromDatabase(Request $request)
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

        return view('blog.index', compact('posts', 'categories'));
    }

    protected function showFromDatabase($slug)
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

        return view('blog.show', compact('post', 'previous', 'next', 'relatedPosts', 'categories', 'latestPosts'));
    }
}
