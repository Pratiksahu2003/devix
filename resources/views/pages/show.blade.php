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
    
    @if($page->cover_image)
    <!-- Standard Hero Image Banner -->
    <header class="relative bg-slate-900 text-white overflow-hidden py-20 sm:py-24 text-center">
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
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-6 drop-shadow-2xl leading-[1.15]">
                {{ $page->title }}
            </h1>
        </div>
    </header>
    @else
    <!-- Minimalist Typography Header for Pages -->
    <header class="bg-slate-50 pt-32 pb-16 text-center border-b border-slate-200">
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

    <!-- Main Content & Sidebar Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            
            <!-- Left: Primary Content (8 Columns) -->
            <div class="lg:col-span-8 space-y-12">
                
                @if($page->cover_image)
                <!-- In-content Hero Image Re-display -->
                <div class="rounded-3xl overflow-hidden shadow-2xl ring-1 ring-slate-900/5 mb-10">
                    <img src="{{ asset('storage/' . $page->cover_image) }}" alt="{{ $page->title }} cover" class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-700 ease-in-out">
                </div>
                @endif
                
                <!-- Content Body -->
                <div class="prose prose-lg sm:prose-xl prose-indigo max-w-none text-slate-700 font-medium">
                    {!! $page->content !!}
                </div>
                
                @if(!empty($page->video_url))

                @php
                if (!function_exists('getYoutubeEmbedUrl')) {
                    function getYoutubeEmbedUrl($url) {
                        if (!$url) return null;
                
                        $parsed = parse_url($url);
                
                        // Case 1: youtu.be/VIDEO_ID
                        if (isset($parsed['host']) && str_contains($parsed['host'], 'youtu.be')) {
                            return 'https://www.youtube.com/embed/' . ltrim($parsed['path'], '/');
                        }
                
                        // Case 2: youtube.com/watch?v=VIDEO_ID
                        if (isset($parsed['query'])) {
                            parse_str($parsed['query'], $query);
                            if (isset($query['v'])) {
                                return 'https://www.youtube.com/embed/' . $query['v'];
                            }
                        }
                
                        // Case 3: youtube.com/shorts/VIDEO_ID
                        if (isset($parsed['path']) && str_contains($parsed['path'], '/shorts/')) {
                            return 'https://www.youtube.com/embed/' . basename($parsed['path']);
                        }
                
                        // Case 4: already embed
                        if (str_contains($url, 'youtube.com/embed/')) {
                            return $url;
                        }
                
                        return null;
                    }
                }
                
                $embedUrl = getYoutubeEmbedUrl($page->video_url);
                @endphp
                
                @if($embedUrl)
                    <!-- YouTube Video -->
                    <div class="mt-16 rounded-3xl overflow-hidden shadow-2xl ring-1 ring-slate-900/5 aspect-video w-full bg-slate-900 relative group">
                        <iframe 
                            src="{{ $embedUrl }}" 
                            class="absolute inset-0 w-full h-full border-0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            loading="lazy">
                        </iframe>
                    </div>
                @endif
                
                @endif

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
                <div class="mt-16 pt-8 flex flex-wrap gap-4">
                    <a href="/" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border border-slate-300 hover:border-indigo-500 text-slate-600 hover:text-indigo-600 font-semibold rounded-xl shadow-sm transition-all focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        &larr; Return Header
                    </a>
                </div>
            </div>

            <!-- Right: Sidebar (4 Columns) -->
            <aside class="lg:col-span-4 space-y-12 lg:sticky lg:top-8">
                
                <!-- Latest Blogs Widget -->
                @if(isset($latestPosts) && $latestPosts->count() > 0)
                <div class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-200/40 ring-1 ring-slate-900/5">
                    <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        Latest on the Blog
                    </h3>
                    <div class="space-y-6">
                        @foreach($latestPosts as $post)
                        <a href="{{ route('blog.show', $post->slug) }}" class="group block">
                            <article class="flex gap-4">
                                @if($post->cover_image)
                                <div class="shrink-0 w-20 h-20 rounded-xl overflow-hidden shadow-sm">
                                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                @endif
                                <div class="flex flex-col justify-center">
                                    <h4 class="font-bold text-slate-800 leading-tight group-hover:text-indigo-600 transition-colors line-clamp-2">{{ $post->title }}</h4>
                                    <time class="text-xs font-semibold text-slate-500 mt-1 uppercase tracking-wider">{{ $post->published_at->format('M d, Y') }}</time>
                                </div>
                            </article>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Categories Widget -->
                @if(isset($categories) && $categories->count() > 0)
                <div class="bg-indigo-50 rounded-3xl p-8 ring-1 ring-indigo-100">
                    <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        Explore Topics
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($categories as $cat)
                        <a href="{{ route('category.show', $cat->slug) }}" class="inline-flex items-center px-4 py-2 bg-white text-slate-700 hover:text-indigo-600 font-semibold border border-indigo-100 hover:border-indigo-300 rounded-xl text-sm transition-all shadow-sm hover:shadow-md">
                            {{ $cat->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Call to Action Banner -->
                <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-8 text-center text-white shadow-2xl relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-500/20 rounded-full blur-3xl"></div>
                    <div class="relative z-10 block">
                        <h4 class="text-2xl font-bold mb-3">Ready to Create?</h4>
                        <p class="text-slate-300 mb-6 text-sm font-medium">Book our studio spaces and let your vision come to life with top-tier equipment.</p>
                        <a href="{{ route('pages.booking') }}" class="inline-block w-full text-center px-6 py-3.5 bg-indigo-500 hover:bg-indigo-400 text-white font-bold rounded-xl transition-colors shadow-lg shadow-indigo-500/30">
                            Book Now
                        </a>
                    </div>
                </div>

            </aside>
            
        </div>
    </div>
    
</article>
@endsection
