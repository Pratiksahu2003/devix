<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // Fetch related active posts
        $posts = $category->posts()
            ->with('author')
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->get();

        // Fetch related active SEO pages
        $pages = $category->pages()
            ->with('author')
            ->where('is_published', true)
            ->latest('published_at')
            ->get();

        return view('categories.show', compact('category', 'posts', 'pages'));
    }
}
