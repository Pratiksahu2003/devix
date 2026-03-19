<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('author', 'category')->latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages',
            'category_id' => 'nullable|exists:categories,id',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url|max:255',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        if (!empty($validated['tags'])) {
            $validated['tags'] = json_decode($validated['tags'], true);
        } else {
            $validated['tags'] = [];
        }

        $validated['slug'] = Str::slug($validated['slug'] ?? $validated['title']);
        $validated['admin_id'] = auth('admin')->id();
        $validated['is_published'] = $request->has('is_published');
        $validated['meta_robots'] = !$request->has('meta_robots_noindex');
        
        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('pages', 'public');
        }

        Page::create($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        $categories = Category::all();
        return view('admin.pages.edit', compact('page', 'categories'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug,' . $page->id,
            'category_id' => 'nullable|exists:categories,id',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url|max:255',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        if (!empty($validated['tags'])) {
            $validated['tags'] = json_decode($validated['tags'], true);
        } else {
            $validated['tags'] = [];
        }

        $validated['slug'] = Str::slug($validated['slug'] ?? $validated['title']);
        $validated['is_published'] = $request->has('is_published');
        $validated['meta_robots'] = !$request->has('meta_robots_noindex');

        if ($validated['is_published'] && !$page->published_at) {
            $validated['published_at'] = now();
        } elseif (!$validated['is_published']) {
            $validated['published_at'] = null;
        }

        if ($request->hasFile('cover_image')) {
            if ($page->cover_image) {
                Storage::disk('public')->delete($page->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('pages', 'public');
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        if ($page->cover_image) {
            Storage::disk('public')->delete($page->cover_image);
        }
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
