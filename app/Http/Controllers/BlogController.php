<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['category', 'author'])
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->latest('published_at');

        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $posts = $query->paginate(9);
        $categories = Category::has('posts')->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = Post::with(['category', 'author'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $previous = Post::where('is_published', true)->where('id', '<', $post->id)->orderBy('id', 'desc')->first();
        $next = Post::where('is_published', true)->where('id', '>', $post->id)->orderBy('id', 'asc')->first();

        return view('blog.show', compact('post', 'previous', 'next'));
    }
}
