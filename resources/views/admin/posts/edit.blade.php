@extends('layouts.admin')

@section('title', 'Edit Article')
@section('page_title', 'Edit Article')
@section('page_subtitle', 'Update content and SEO parameters for ' . $post->title)

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Articles
    </a>
</div>

<form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start" x-data="{ 
    title: '{{ old('title', $post->title) }}', 
    slug: '{{ old('slug', $post->slug) }}', 
    autoSync: {{ old('slug', $post->slug) ? 'false' : 'true' }},
    generateSlug(text) {
        return text.toString().trim().toLowerCase()
            .replace(/\s+/g, '-')           
            .replace(/[^\w\-]+/g, '')       
            .replace(/\-\-+/g, '-')         
            .replace(/^-+/, '')             
            .replace(/-+$/, '');            
    }
}">
    @csrf
    @method('PUT')

    <!-- Main Content Area -->
    <div class="lg:col-span-2 space-y-6">
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden p-6 sm:p-8">
            <h3 class="text-xl font-bold text-slate-800 mb-6">Article Editor</h3>
            
            <div class="space-y-5">
                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-700 mb-1.5">Article Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" x-model="title" @input="if(autoSync) slug = generateSlug(title)" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors" required>
                    @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="content" class="block text-sm font-semibold text-slate-700 mb-1.5">Full Content <span class="text-red-500">*</span></label>
                    <textarea name="content" id="content" rows="12" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors" required>{{ old('content', $post->content) }}</textarea>
                    @error('content') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="excerpt" class="block text-sm font-semibold text-slate-700 mb-1.5">Excerpt Overview</label>
                    <textarea name="excerpt" id="excerpt" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden p-6 sm:p-8">
            <h3 class="text-lg font-bold text-slate-800 mb-1">Search Engine Optimization</h3>
            
            <div class="space-y-5 mt-6">
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="slug" class="block text-sm font-semibold text-slate-700">URL Slug</label>
                        <label class="flex items-center gap-1.5 text-xs text-slate-500 cursor-pointer hover:text-indigo-600 transition-colors">
                            <input type="checkbox" x-model="autoSync" class="w-3.5 h-3.5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                            Auto-sync with title
                        </label>
                    </div>
                    <div class="flex">
                        <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-slate-300 bg-slate-50 text-slate-500 text-sm">/blog/</span>
                        <input type="text" name="slug" id="slug" x-model="slug" @input="autoSync = false" class="w-full px-4 py-2.5 rounded-r-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors placeholder:text-slate-400" placeholder="e.g. top-10-trends">
                    </div>
                    @error('slug') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="meta_title" class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $post->meta_title) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="meta_description" class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors">{{ old('meta_description', $post->meta_description) }}</textarea>
                </div>

                <div>
                    <label for="meta_keywords" class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Keywords</label>
                    <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $post->meta_keywords) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors" placeholder="keyword1, keyword2, keyword3">
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Controls -->
    <div class="lg:col-span-1 space-y-6 lg:sticky lg:top-8">
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Publish Status</h3>
            
            <div class="space-y-4">
                <label class="flex items-center gap-3 p-3 border {{ $post->is_published ? 'border-emerald-200 bg-emerald-50/50' : 'border-slate-200' }} rounded-xl cursor-pointer hover:bg-slate-50 transition-colors">
                    <input type="checkbox" name="is_published" class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                    <div>
                        <div class="font-semibold text-slate-800 text-sm">Publish Article</div>
                        <div class="text-xs text-slate-500 mt-0.5">{{ $post->published_at ? 'Published: ' . $post->published_at->format('M j, Y') : 'Make it instantly visible publicly' }}</div>
                    </div>
                </label>
            </div>

            <button type="submit" class="w-full mt-6 bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-bold transition-all shadow-sm shadow-indigo-500/30 hover:shadow-md focus:ring-2 focus:ring-indigo-500/50">
                Update Article
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Organization</h3>
            
            <div>
                <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-1.5">Category</label>
                <select name="category_id" id="category_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors bg-white">
                    <option value="">-- No Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Cover Image</h3>
            
            @if($post->cover_image)
            <div class="mb-4 rounded-xl overflow-hidden shadow-sm relative group">
                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="Current Cover" class="w-full h-auto object-cover aspect-video">
                <div class="absolute inset-0 bg-slate-900/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="text-white text-sm font-semibold">Upload new to replace</span>
                </div>
            </div>
            @endif

            <div>
                <input type="file" id="cover_image" name="cover_image" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-colors cursor-pointer border border-slate-200 rounded-full p-1 bg-white">
                @error('cover_image') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

    </div>
</form>

<style>
/* Style adjustments for CKEditor to match Tailwind rounding */
.ck-editor__editable {
    min-height: 400px;
    border-bottom-left-radius: 0.75rem !important;
    border-bottom-right-radius: 0.75rem !important;
}
.ck-toolbar {
    border-top-left-radius: 0.75rem !important;
    border-top-right-radius: 0.75rem !important;
    background: #f8fafc !important;
}
</style>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endsection
