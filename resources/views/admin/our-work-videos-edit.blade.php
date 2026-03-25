@extends('layouts.admin')

@section('title', 'Edit Video')
@section('page_title', 'Edit Video')
@section('page_subtitle', 'Update YouTube URL and sort order')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

    <div class="p-8 border-b border-slate-100 relative z-10 text-left">
        <h3 class="text-xl font-bold text-slate-800">Edit YouTube Video</h3>
        <p class="text-sm text-slate-500 mt-1.5 max-w-2xl">Changes apply to this video only.</p>
    </div>

    <div class="p-8 relative z-10 space-y-6">
        <form method="POST" action="{{ route('admin.dashboard.our-work.videos.update', $video->id) }}" class="space-y-4">
            @csrf
            @method('put')

            <div class="space-y-2">
                <label for="youtube_url" class="block text-sm font-semibold text-slate-700">YouTube URL</label>
                <input
                    type="url"
                    name="youtube_url"
                    id="youtube_url"
                    value="{{ old('youtube_url', $video->youtube_url) }}"
                    class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors text-sm"
                />
                @error('youtube_url')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="sort_order" class="block text-sm font-semibold text-slate-700">Sort Order</label>
                <input
                    type="number"
                    name="sort_order"
                    id="sort_order"
                    min="0"
                    value="{{ old('sort_order', $video->sort_order) }}"
                    class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors text-sm"
                />
                @error('sort_order')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-wrap gap-3 items-center">
                <button type="submit" class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Update Video
                </button>

                <a href="{{ route('admin.dashboard.our-work.videos.show') }}"
                   class="inline-flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-900 font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm border border-slate-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

