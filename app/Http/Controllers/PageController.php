<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        // Serve the dynamically structured page, ensuring it is officially published.
        $page = Page::with('category')->where('slug', $slug)
                    ->where('is_published', true)
                    ->firstOrFail();

        $latestPosts = \App\Models\Post::with('category', 'author')
                    ->where('is_published', true)
                    ->latest('published_at')
                    ->take(4)
                    ->get();
                    
        $categories = \App\Models\Category::has('pages')->orHas('posts')->get();

        return view('pages.show', compact('page', 'latestPosts', 'categories'));
    }
}
