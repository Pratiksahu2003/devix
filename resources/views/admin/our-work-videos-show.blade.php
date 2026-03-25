@extends('layouts.admin')

@section('title', 'Our Work Videos')
@section('page_title', 'Our Work Videos')
@section('page_subtitle', 'View uploaded YouTube videos')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

    <div class="p-8 border-b border-slate-100 relative z-10 text-left">
        <div class="flex items-start justify-between gap-4 flex-wrap">
            <div>
                <h3 class="text-xl font-bold text-slate-800">Our Work Videos</h3>
                <p class="text-sm text-slate-500 mt-1.5 max-w-2xl">Uploaded videos (YouTube embeds).</p>
            </div>

            <a href="{{ route('admin.dashboard.our-work.videos.create') }}"
               class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Video
            </a>
        </div>
    </div>

    <div class="p-8 relative z-10 space-y-6">
        @php
            $orderedVideos = $ourWorkVideos?->sortBy('sort_order')->values() ?? collect();

            $parseYoutubeEmbedUrl = function (string $rawUrl): string {
                $videoId = null;
                if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([A-Za-z0-9_-]{6,})/', $rawUrl, $m)) {
                    $videoId = $m[1] ?? null;
                }

                return $videoId ? ('https://www.youtube.com/embed/' . $videoId) : $rawUrl;
            };
        @endphp

        @if($orderedVideos->count() > 0)
            @php
                $featuredVideo = $orderedVideos->first();
                $restVideos = $orderedVideos->slice(1)->values();
            @endphp

            <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50">
                <div class="p-4 border-b border-slate-200 flex items-center justify-between gap-4">
                    <p class="text-sm font-semibold text-slate-700">Current Featured Video</p>
                    <div class="flex items-center gap-2">
                        <a href="{{ $featuredVideo->youtube_url }}" target="_blank" rel="noreferrer" class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">
                        Open on YouTube
                        </a>
                        <a href="{{ route('admin.dashboard.our-work.videos.edit', $featuredVideo->id) }}"
                           class="text-xs font-semibold text-slate-700 hover:text-indigo-700 underline">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('admin.dashboard.our-work.videos.destroy', $featuredVideo->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-xs font-semibold text-red-600 hover:text-red-700 underline"
                                    onclick="return confirm('Delete this video?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                <div class="aspect-video bg-black">
                    <iframe
                        src="{{ $parseYoutubeEmbedUrl($featuredVideo->youtube_url) }}"
                        class="w-full h-full"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin"
                    ></iframe>
                </div>
            </div>

            @if($restVideos->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($restVideos as $video)
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50">
                            <div class="p-3 border-b border-slate-200 flex items-center justify-between gap-4">
                                <p class="text-sm font-semibold text-slate-700">Extra Video</p>
                                <div class="flex items-center gap-3">
                                    <a href="{{ $video->youtube_url }}" target="_blank" rel="noreferrer" class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">
                                        Open
                                    </a>
                                    <a href="{{ route('admin.dashboard.our-work.videos.edit', $video->id) }}"
                                       class="text-xs font-semibold text-slate-700 hover:text-indigo-700 underline">
                                        Edit
                                    </a>
                                </div>
                            </div>
                            <div class="aspect-video bg-black">
                                <iframe
                                    src="{{ $parseYoutubeEmbedUrl($video->youtube_url) }}"
                                    class="w-full h-full"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                    loading="lazy"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                ></iframe>
                            </div>
                            <div class="p-3 border-t border-slate-200">
                                <form method="POST" action="{{ route('admin.dashboard.our-work.videos.destroy', $video->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-xs font-semibold text-red-600 hover:text-red-700 underline"
                                            onclick="return confirm('Delete this video?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @else
            @if(!empty($ourWork?->youtube_url))
                <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50">
                    <div class="p-4 border-b border-slate-200 flex items-center justify-between gap-4">
                        <p class="text-sm font-semibold text-slate-700">Featured Video</p>
                        <a href="{{ $ourWork->youtube_url }}" target="_blank" rel="noreferrer" class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">
                            Open on YouTube
                        </a>
                    </div>
                    <div class="aspect-video bg-black">
                        <iframe
                            src="{{ $parseYoutubeEmbedUrl($ourWork->youtube_url) }}"
                            class="w-full h-full"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="strict-origin-when-cross-origin"
                        ></iframe>
                    </div>
                </div>
            @else
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 text-sm text-slate-600">
                    No YouTube videos uploaded yet.
                </div>
            @endif
        @endif
    </div>
</div>
@endsection

