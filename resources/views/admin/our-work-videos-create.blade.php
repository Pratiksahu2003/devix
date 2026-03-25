@extends('layouts.admin')

@section('title', 'Add Video')
@section('page_title', 'Add YouTube Video')
@section('page_subtitle', 'Upload one YouTube URL at a time')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

    <div class="p-8 border-b border-slate-100 relative z-10 text-left">
        <div class="flex items-start justify-between gap-4 flex-wrap">
            <div>
                <h3 class="text-xl font-bold text-slate-800">Add Video</h3>
                <p class="text-sm text-slate-500 mt-1.5 max-w-2xl">Each submit adds a new video row (does not replace existing ones).</p>
            </div>

            <a href="{{ route('admin.dashboard.our-work.videos.show') }}"
               class="inline-flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-900 font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm border border-slate-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h14"/></svg>
                Back
            </a>
        </div>
    </div>

    <div class="p-8 relative z-10 space-y-6">
        <form method="POST" action="{{ route('admin.dashboard.our-work.update') }}" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <label for="youtube_url" class="block text-sm font-semibold text-slate-700">YouTube URL</label>
                <input
                    type="url"
                    name="youtube_url"
                    id="youtube_url"
                    value="{{ old('youtube_url', '') }}"
                    class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors text-sm"
                    placeholder="https://youtube.com/watch?v=..."
                />
                @error('youtube_url')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-wrap gap-3 items-center">
                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Video
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

