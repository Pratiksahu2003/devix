@extends('layouts.admin')

@section('title', 'Write Article')
@section('page_title', 'Write Article')
@section('page_subtitle', 'Draft a new blog post and optimize it for search engines')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Articles
    </a>
</div>

<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start" x-data="{ 
    title: '{{ old('title') }}', 
    slug: '{{ old('slug') }}', 
    autoSync: {{ old('slug') ? 'false' : 'true' }},
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

    <!-- Main Content Area -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Post Core Details -->
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
                    <textarea name="content" id="content" rows="12" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors" placeholder="Write your article here in raw HTML or plain text... (Rich Text integration typically happens here)" required>{{ old('content') }}</textarea>
                    @error('content') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="excerpt" class="block text-sm font-semibold text-slate-700 mb-1.5">Excerpt Overview</label>
                    <textarea name="excerpt" id="excerpt" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors" placeholder="A brief summary for previews...">{{ old('excerpt') }}</textarea>
                    @error('excerpt') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- SEO Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden p-6 sm:p-8">
            <h3 class="text-lg font-bold text-slate-800 mb-1">Search Engine Optimization</h3>
            <p class="text-sm text-slate-500 mb-6">These fields help your article rank better in search results.</p>
            
            <div class="space-y-5">
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
                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors">
                </div>

                <div>
                    <label for="meta_description" class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors">{{ old('meta_description') }}</textarea>
                </div>

                <div>
                    <label for="meta_keywords" class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Keywords</label>
                    <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors" placeholder="keyword1, keyword2, keyword3">
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Sticky Controls -->
    <div class="lg:col-span-1 space-y-6 lg:sticky lg:top-8">
        
        <!-- Publishing -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Publish</h3>
            
            <div class="space-y-4">
                <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors">
                    <input type="checkbox" name="is_published" class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500" value="1" {{ old('is_published') ? 'checked' : '' }}>
                    <div>
                        <div class="font-semibold text-slate-800 text-sm">Publish Article</div>
                        <div class="text-xs text-slate-500 mt-0.5">Make it instantly visible publicly</div>
                    </div>
                </label>
            </div>

            <button type="submit" class="w-full mt-6 bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-bold transition-all shadow-sm shadow-indigo-500/30 hover:shadow-md focus:ring-2 focus:ring-indigo-500/50">
                Save Article
            </button>
        </div>

        <!-- Organization -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Organization</h3>
            
            <div>
                <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-1.5">Category</label>
                <select name="category_id" id="category_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors bg-white">
                    <option value="">-- No Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Cover Image -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Cover Image</h3>
            
            <div>
                <label for="cover_image" class="block w-full border-2 border-dashed border-slate-300 rounded-xl p-8 text-center cursor-pointer hover:border-indigo-500 hover:bg-indigo-50/50 transition-colors group">
                    <svg class="mx-auto h-8 w-8 text-slate-400 group-hover:text-indigo-500 transition-colors mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="block text-sm font-semibold text-slate-700">Click to upload image</span>
                    <span class="block text-xs text-slate-500 mt-1">PNG, JPG, WEBP up to 2MB</span>
                    <input type="file" id="cover_image" name="cover_image" accept="image/*" class="hidden">
                </label>
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
