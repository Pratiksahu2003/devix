@extends('layouts.admin')

@section('title', 'Edit Page')
@section('page_title', 'Edit SEO Page')
@section('page_subtitle', 'Tweak your foundational landing page.')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Pages
    </a>
    <a href="/{{ $page->slug }}" target="_blank" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
        View Live Page &rarr;
    </a>
</div>

<form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start" x-data="{ 
    title: '{{ old('title', $page->title) }}', 
    slug: '{{ old('slug', $page->slug) }}', 
    autoSync: {{ old('slug', $page->slug) ? 'false' : 'true' }},
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
        
        <!-- Core Details -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
            <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Core Content
            </h3>
            
            <div class="space-y-5">
                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-700 mb-1.5">Page Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" x-model="title" @input="if(autoSync) slug = generateSlug(title)" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors" required>
                    @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="content" class="block text-sm font-semibold text-slate-700 mb-1.5">Full Content <span class="text-red-500">*</span></label>
                    <textarea name="content" id="content" rows="15" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors">{{ old('content', $page->content) }}</textarea>
                    @error('content') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- SEO Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Search Engine Optimization
                </h3>
                <label class="flex items-center gap-1.5 text-xs text-slate-500 cursor-pointer hover:text-red-600 transition-colors" title="Instruct search engines not to index this specific page.">
                    <input type="checkbox" name="meta_robots_noindex" value="1" {{ old('meta_robots_noindex', !$page->meta_robots) ? 'checked' : '' }} class="w-4 h-4 text-red-600 border-slate-300 rounded focus:ring-red-500">
                    No-Index (Hide from Bots)
                </label>
            </div>
            
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
                        <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-slate-300 bg-slate-50 text-slate-500 text-sm">/</span>
                        <input type="text" name="slug" id="slug" x-model="slug" @input="autoSync = false" class="w-full px-4 py-2.5 rounded-r-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors placeholder:text-slate-400" placeholder="e.g. video-production-services">
                    </div>
                    @error('slug') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="meta_title" class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $page->meta_title) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors" placeholder="Overwrites the <title> tag.">
                </div>

                <div>
                    <label for="meta_description" class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors">{{ old('meta_description', $page->meta_description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="meta_keywords" class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors" placeholder="video, production, edit">
                    </div>
                    <div>
                        <label for="canonical_url" class="block text-sm font-semibold text-slate-700 mb-1.5">Canonical URL</label>
                        <input type="url" name="canonical_url" id="canonical_url" value="{{ old('canonical_url', $page->canonical_url) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors" placeholder="https://external-site.com/origin">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Sticky Controls -->
    <div class="lg:col-span-1 space-y-6 lg:sticky lg:top-8">
        
        <!-- Publishing -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Publishing
            </h3>
            
            <label class="flex items-center gap-3 p-4 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-100 transition-colors mb-6">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $page->is_published) ? 'checked' : '' }} class="w-5 h-5 text-emerald-600 rounded bg-white border-slate-300 focus:ring-emerald-500 focus:ring-2">
                <div>
                    <div class="font-semibold text-slate-700 text-sm">Publish Immediately</div>
                    <div class="text-xs text-slate-500">Make this page live instantly.</div>
                </div>
            </label>

            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-indigo-500/30 transition-all active:scale-[0.98]">
                Update SEO Page
            </button>
        </div>

        <!-- Cover Media -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Hero Media
            </h3>
            
            @if($page->cover_image)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $page->cover_image) }}" alt="Current Cover" class="w-full h-32 object-cover rounded-lg border border-slate-200">
                <p class="text-xs text-slate-500 mt-2 text-center">Current Cover Banner</p>
            </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label for="cover_image" class="block text-sm font-semibold text-slate-700 mb-1.5">Replace Cover Banner</label>
                    <input type="file" name="cover_image" id="cover_image" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-colors">
                    @error('cover_image') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="video_url" class="block text-sm font-semibold text-slate-700 mb-1.5">Or Hero Video URL</label>
                    <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $page->video_url) }}" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors text-sm" placeholder="https://youtube.com/...">
                    @error('video_url') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

    </div>
</form>

<style>
/* Style adjustments for CKEditor */
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
