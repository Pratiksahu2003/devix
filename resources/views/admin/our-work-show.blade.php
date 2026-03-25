@extends('layouts.admin')

@section('title', 'Our Work')
@section('page_title', 'Our Work')
@section('page_subtitle', 'View uploaded videos and gallery images')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

    <div class="p-8 border-b border-slate-100 relative z-10 text-left">
        <div class="flex items-start justify-between gap-4 flex-wrap">
            <div>
                <h3 class="text-xl font-bold text-slate-800">Our Work</h3>
                <p class="text-sm text-slate-500 mt-1.5 max-w-2xl">Uploaded videos (YouTube) and gallery images.</p>
            </div>

            <a href="{{ route('admin.dashboard.our-work.create') }}"
               class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Upload / Create
            </a>
        </div>
    </div>

    <div class="p-8 relative z-10 space-y-6">
        @php
            $youtubeUrls = $ourWorkVideos?->sortBy('sort_order')->values()->pluck('youtube_url')->all() ?? [];
            if (empty($youtubeUrls) && !empty($ourWork?->youtube_url)) {
                $youtubeUrls = [$ourWork->youtube_url];
            }

            $parseYoutubeEmbedUrl = function (string $rawUrl): string {
                $videoId = null;
                if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([A-Za-z0-9_-]{6,})/', $rawUrl, $m)) {
                    $videoId = $m[1] ?? null;
                }

                return $videoId ? ('https://www.youtube.com/embed/' . $videoId) : $rawUrl;
            };

            $featuredUrl = $youtubeUrls[0] ?? null;
            $restUrls = $featuredUrl ? array_slice($youtubeUrls, 1) : [];
        @endphp

        @if(!empty($featuredUrl))
            <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50">
                <div class="p-4 border-b border-slate-200 flex items-center justify-between gap-4">
                    <p class="text-sm font-semibold text-slate-700">Current Featured Video</p>
                    <a href="{{ $featuredUrl }}" target="_blank" rel="noreferrer" class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">
                        Open on YouTube
                    </a>
                </div>
                <div class="aspect-video bg-black">
                    <iframe
                        src="{{ $parseYoutubeEmbedUrl($featuredUrl) }}"
                        class="w-full h-full"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin"
                    ></iframe>
                </div>
            </div>

            @if(count($restUrls) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($restUrls as $url)
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50">
                            <div class="p-3 border-b border-slate-200 flex items-center justify-between gap-4">
                                <p class="text-sm font-semibold text-slate-700">Extra Video</p>
                                <a href="{{ $url }}" target="_blank" rel="noreferrer" class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">
                                    Open
                                </a>
                            </div>
                            <div class="aspect-video bg-black">
                                <iframe
                                    src="{{ $parseYoutubeEmbedUrl($url) }}"
                                    class="w-full h-full"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                    loading="lazy"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                ></iframe>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @else
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 text-sm text-slate-600">
                No YouTube videos uploaded yet.
            </div>
        @endif

        <div class="space-y-3">
            <div class="flex items-center justify-between gap-4">
                <p class="text-sm font-semibold text-slate-700">Uploaded Images</p>
            </div>

            @if(isset($ourWorkImages) && $ourWorkImages->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                    @foreach($ourWorkImages as $img)
                        <div class="relative rounded-xl overflow-hidden border border-slate-200 bg-white">
                            <img
                                src="{{ asset('storage/' . $img->image_path) }}"
                                alt="{{ $img->alt_text ?? 'Our Work' }}"
                                class="w-full h-24 object-cover"
                                loading="lazy"
                            />
                            <form method="POST" action="{{ route('admin.dashboard.our-work.images.destroy', $img->id) }}" class="absolute top-2 right-2">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="rounded-full bg-red-600 hover:bg-red-700 text-white w-8 h-8 flex items-center justify-center text-sm shadow-md"
                                    onclick="return confirm('Delete this image?')"
                                    title="Delete image"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-slate-500">No images uploaded yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection

