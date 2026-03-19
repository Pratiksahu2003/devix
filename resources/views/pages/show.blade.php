@extends('layouts.app')

@section('title', $page->meta_title ?: $page->title)

@section('meta')
<meta name="description" content="{{ $page->meta_description ?: Str::limit(strip_tags($page->content), 160) }}">
@if($page->meta_keywords)
<meta name="keywords" content="{{ $page->meta_keywords }}">
@endif
@if($page->canonical_url)
<link rel="canonical" href="{{ $page->canonical_url }}">
@endif
@if(!$page->meta_robots)
<meta name="robots" content="noindex, nofollow">
@endif
@endsection

@if($page->cover_image)
@section('og_image', asset('storage/' . $page->cover_image))
@endif

@section('content')
<article class="bg-white min-h-screen">
    
    @if($page->video_url)
    <!-- Hero Header with Full Bleed Cinematic Video Overlay -->
    <header class="relative bg-black h-screen overflow-hidden flex flex-col items-center justify-center">
        <div class="absolute inset-0 z-0">
            @php
                $embedUrl = $page->video_url;
                if (Str::contains($embedUrl, 'youtube.com/watch?v=')) {
                    $embedUrl = Str::replace('watch?v=', 'embed/', $embedUrl) . '?autoplay=1&mute=1&loop=1&controls=0&showinfo=0';
                }
            @endphp
            <iframe class="w-full h-[150%] sm:h-full object-cover pointer-events-none opacity-40 scale-150 sm:scale-125 md:scale-100" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent z-10"></div>
        <div class="relative z-20 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20">
            <h1 class="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-black tracking-tight mb-8 drop-shadow-2xl text-white leading-[1.1]">
                {{ $page->title }}
            </h1>
        </div>
    </header>
    @elseif($page->cover_image)
    <!-- Standard Hero Image Banner -->
    <header class="relative bg-slate-900 text-white overflow-hidden py-32 sm:py-48 text-center">
        <div class="absolute inset-0">
            <img src="{{ asset('storage/' . $page->cover_image) }}" alt="{{ $page->title }}" class="w-full h-full object-cover opacity-40 mix-blend-overlay">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold tracking-tight mb-8 drop-shadow-2xl leading-[1.15]">
                {{ $page->title }}
            </h1>
        </div>
    </header>
    @else
    <!-- Minimalist Typography Header -->
    <header class="bg-slate-50 pt-40 pb-20 text-center border-b border-slate-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-[1.15]">
                {{ $page->title }}
            </h1>
        </div>
    </header>
    @endif

    <!-- Main Rich Text Content Area -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24">
        <div class="prose prose-lg sm:prose-xl prose-indigo mx-auto text-slate-700 font-medium">
            {!! $page->content !!}
        </div>
    </div>
    
</article>
@endsection
