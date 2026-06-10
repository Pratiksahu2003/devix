<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\Seo\SeoMetaService;
use App\Services\Seo\SeoSchemaService;

class CategoryController extends Controller
{
    public function show($slug, SeoMetaService $meta, SeoSchemaService $schema)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = $category->posts()
            ->with('author')
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->get();

        $pages = $category->pages()
            ->with('author')
            ->where('is_published', true)
            ->latest('published_at')
            ->get();

        $seo = [
            'meta' => $meta->buildCategoryMeta($category),
            'schema_graph' => $schema->buildCategoryGraph($category),
        ];

        return view('categories.show', compact('category', 'posts', 'pages', 'seo'));
    }
}
