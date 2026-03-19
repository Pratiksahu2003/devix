<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'author'])->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts',
            'category_id' => 'nullable|exists:categories,id',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['slug'] ?? $validated['title']);
        $validated['admin_id'] = auth('admin')->id();
        $validated['is_published'] = $request->has('is_published');
        
        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('blog', 'public');
            $validated['cover_image'] = $path;
        }

        Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug,' . $post->id,
            'category_id' => 'nullable|exists:categories,id',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['slug'] ?? $validated['title']);
        $validated['is_published'] = $request->has('is_published');

        if ($validated['is_published'] && !$post->published_at) {
            $validated['published_at'] = now();
        } elseif (!$validated['is_published']) {
            $validated['published_at'] = null;
        }

        if ($request->hasFile('cover_image')) {
            if ($post->cover_image) {
                Storage::disk('public')->delete($post->cover_image);
            }
            $path = $request->file('cover_image')->store('blog', 'public');
            $validated['cover_image'] = $path;
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
        }
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }
}
