@extends('layouts.app')

@section('title', $page->meta_title ?: $page->title . ' - ' . config('app.name'))

@section('meta')
<meta name="description" content="{{ $page->meta_description ?: Str::limit(strip_tags($page->content), 160) }}">
<meta name="author" content="{{ optional($page->author)->name ?? 'System' }}">
@if($page->meta_keywords)
<meta name="keywords" content="{{ $page->meta_keywords }}">
@endif
@if($page->meta_robots === false)
<meta name="robots" content="noindex, nofollow">
@endif
@endsection

@if($page->cover_image)
@section('og_image', asset('storage/' . $page->cover_image))
@endif

@section('content')
<article class="bg-white min-h-screen">
    
    @if($page->video_url)
    <!-- Cinematic Video Header -->
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
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="bg-indigo-600 text-white text-xs font-bold uppercase tracking-widest py-1 px-3 rounded-full">
                    {{ optional($page->category)->name ?? 'Page' }}
                </span>
                <span class="text-slate-300 text-sm font-medium">
                    &bull; Published {{ $page->published_at ? $page->published_at->format('M Y') : 'Draft' }}
                </span>
            </div>
            <h1 class="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-black tracking-tight mb-8 drop-shadow-2xl text-white leading-[1.1]">
                {{ $page->title }}
            </h1>
        </div>
    </header>
    @elseif($page->cover_image)
    <!-- Standard Hero Image Banner -->
    <header class="relative bg-slate-900 text-white overflow-hidden py-32 sm:py-48 text-center">
        <div class="absolute inset-0">
            <img src="{{ asset('storage/' . $page->cover_image) }}" alt="{{ $page->title }}" class="w-full h-full object-cover opacity-60 mix-blend-overlay">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="bg-indigo-600 text-white text-xs font-bold uppercase tracking-widest py-1 px-3 rounded-full">
                    {{ optional($page->category)->name ?? 'Page' }}
                </span>
                <span class="text-slate-300 text-sm font-medium">
                    &bull; Published {{ $page->published_at ? $page->published_at->format('M Y') : 'Draft' }}
                </span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold tracking-tight mb-8 drop-shadow-2xl leading-[1.15]">
                {{ $page->title }}
            </h1>
        </div>
    </header>
    @else
    <!-- Minimalist Typography Header for Pages -->
    <header class="bg-slate-50 pt-40 pb-20 text-center border-b border-slate-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="bg-indigo-100 text-indigo-700 text-xs font-bold uppercase tracking-widest py-1 px-3 rounded-full border border-indigo-200">
                    {{ optional($page->category)->name ?? 'Page' }}
                </span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-[1.15]">
                {{ $page->title }}
            </h1>
        </div>
    </header>
    @endif

    <!-- Main Rich Text Content Area -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24">
        <!-- Content Body -->
        <div class="prose prose-lg sm:prose-xl prose-indigo mx-auto text-slate-700 font-medium">
            {!! $page->content !!}
        </div>

        <!-- Tags Module -->
        @if(!empty($page->tags) && count($page->tags) > 0)
        <div class="mt-16 pt-10 border-t border-slate-200">
            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-4">Related Tags</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($page->tags as $tag)
                <span class="inline-flex items-center px-4 py-2 bg-slate-50 text-slate-600 font-semibold border border-slate-200 rounded-xl text-sm hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-100 transition-colors cursor-default shadow-sm">
                    #{{ $tag }}
                </span>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Back Home / Actions Navigation -->
        <div class="mt-16 pt-8 text-center flex justify-center gap-4">
            <a href="/" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border border-slate-300 hover:border-indigo-500 text-slate-600 hover:text-indigo-600 font-semibold rounded-xl shadow-sm transition-all focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                &larr; Return to Home
            </a>
            <a href="{{ route('blog.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-indigo-600 border border-transparent hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-sm shadow-indigo-500/30 transition-all focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Read our Blog &rarr;
            </a>
        </div>
    </div>
    
</article>
@endsection
