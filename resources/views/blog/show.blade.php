@extends('layouts.app')

@section('title', $post->meta_title ?: $post->title . ' - Blog')

@section('meta')
<meta name="description" content="{{ $post->meta_description ?: Str::limit(strip_tags($post->content), 160) }}">
<meta name="author" content="{{ optional($post->author)->name ?? 'System' }}">
@if($post->meta_keywords)
<meta name="keywords" content="{{ $post->meta_keywords }}">
@endif
@endsection

@if($post->cover_image)
@section('og_image', asset('storage/' . $post->cover_image))
@endif

@section('content')
<article class="bg-white min-h-screen">
    
    @if($post->video_url)
    <!-- Cinematic Video Header -->
    <header class="relative bg-black h-screen overflow-hidden flex flex-col items-center justify-center">
        <div class="absolute inset-0 z-0">
            @php
                $embedUrl = $post->video_url;
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
                    {{ optional($post->category)->name ?? 'Uncategorized' }}
                </span>
                <span class="text-slate-300 text-sm font-medium">
                    &bull; {{ $post->published_at ? $post->published_at->format('M j, Y') : 'Draft' }}
                </span>
            </div>
            <h1 class="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-black tracking-tight mb-8 drop-shadow-2xl text-white leading-[1.1]">
                {{ $post->title }}
            </h1>
            <div class="flex items-center justify-center gap-3">
                <div class="w-10 h-10 rounded-full bg-indigo-500 border-2 border-slate-800 flex items-center justify-center text-white font-bold opacity-90 shadow-lg">
                    {{ substr(optional($post->author)->name ?? 'S', 0, 1) }}
                </div>
                <div class="text-left">
                    <p class="text-sm font-semibold text-slate-100 drop-shadow-md">{{ optional($post->author)->name ?? 'System' }}</p>
                    <p class="text-xs text-slate-300 drop-shadow-md">Author</p>
                </div>
            </div>
        </div>
    </header>
    @elseif($post->cover_image)
    <!-- Standard Hero Image Banner -->
    <header class="relative bg-slate-900 text-white overflow-hidden py-32 sm:py-48 text-center">
        <div class="absolute inset-0">
            <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover opacity-40 mix-blend-overlay">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="bg-indigo-600 text-white text-xs font-bold uppercase tracking-widest py-1 px-3 rounded-full">
                    {{ optional($post->category)->name ?? 'Uncategorized' }}
                </span>
                <span class="text-slate-300 text-sm font-medium">
                    &bull; {{ $post->published_at ? $post->published_at->format('M j, Y') : 'Draft' }}
                </span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold tracking-tight mb-8 drop-shadow-2xl leading-[1.15]">
                {{ $post->title }}
            </h1>
            <div class="flex items-center justify-center gap-3">
                <div class="w-10 h-10 rounded-full bg-indigo-500 border-2 border-slate-800 flex items-center justify-center text-white font-bold opacity-90 shadow-lg">
                    {{ substr(optional($post->author)->name ?? 'S', 0, 1) }}
                </div>
                <div class="text-left">
                    <p class="text-sm font-semibold text-slate-100 drop-shadow-md">{{ optional($post->author)->name ?? 'System' }}</p>
                    <p class="text-xs text-slate-300 drop-shadow-md">Author</p>
                </div>
            </div>
        </div>
    </header>
    @else
    <!-- Minimalist Typography Header -->
    <header class="bg-slate-50 pt-40 pb-20 text-center border-b border-slate-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="bg-indigo-100 text-indigo-700 text-xs font-bold uppercase tracking-widest py-1 px-3 rounded-full border border-indigo-200">
                    {{ optional($post->category)->name ?? 'Uncategorized' }}
                </span>
                <span class="text-slate-500 text-sm font-medium">
                    &bull; {{ $post->published_at ? $post->published_at->format('M j, Y') : 'Draft' }}
                </span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 mb-8 leading-[1.15]">
                {{ $post->title }}
            </h1>
            <div class="flex items-center justify-center gap-3">
                <div class="w-10 h-10 rounded-full bg-indigo-100 border border-indigo-200 flex items-center justify-center text-indigo-700 font-bold">
                    {{ substr(optional($post->author)->name ?? 'S', 0, 1) }}
                </div>
                <div class="text-left">
                    <p class="text-sm font-semibold text-slate-800">{{ optional($post->author)->name ?? 'System' }}</p>
                    <p class="text-xs text-slate-500">Author</p>
                </div>
            </div>
        </div>
    </header>
    @endif

    <!-- Main Rich Text Content Area -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24">
        <!-- Content Body -->
        <div class="prose prose-lg sm:prose-xl prose-indigo mx-auto text-slate-700 font-medium">
            {!! $post->content !!}
        </div>

        <!-- Tags Module -->
        @if(!empty($post->tags) && count($post->tags) > 0)
        <div class="mt-16 pt-10 border-t border-slate-200">
            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-4">Filed Under Tags</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($post->tags as $tag)
                <span class="inline-flex items-center px-4 py-2 bg-slate-50 text-slate-600 font-semibold border border-slate-200 rounded-xl text-sm hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-100 transition-colors cursor-default shadow-sm">
                    #{{ $tag }}
                </span>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Back to Blog Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-slate-300 hover:border-indigo-500 text-slate-600 hover:text-indigo-600 font-semibold rounded-xl shadow-sm transition-all focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                &larr; Read more articles
            </a>
        </div>
    </div>
    
</article>
@endsection
