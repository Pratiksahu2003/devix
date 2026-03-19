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
<article class="bg-slate-50 min-h-screen pb-24">
    
    @if($post->video_url)
    <!-- Cinematic Video Header -->
    <header class="relative bg-black h-[60vh] min-h-[400px] overflow-hidden flex flex-col items-center justify-center rounded-b-[3rem] shadow-2xl z-10">
        <div class="absolute inset-0 z-0">
            @php
                $embedUrl = $post->video_url;
                if (Str::contains($embedUrl, 'youtube.com/watch?v=')) {
                    $embedUrl = Str::replace('watch?v=', 'embed/', $embedUrl) . '?autoplay=1&mute=1&loop=1&controls=0&showinfo=0';
                }
            @endphp
            <iframe class="w-full h-[150%] sm:h-full object-cover pointer-events-none opacity-50 scale-150 sm:scale-125 md:scale-110 filter saturate-50 blur-[2px]" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/30 to-purple-900/30 z-10 mix-blend-multiply"></div>
        
        <div class="relative z-20 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20 mt-4">
            <div class="flex items-center justify-center gap-4 mb-6">
                <span class="bg-white/10 backdrop-blur-md text-white border border-white/20 text-xs font-bold uppercase tracking-widest py-1.5 px-4 rounded-full shadow-lg">
                    {{ optional($post->category)->name ?? 'Uncategorized' }}
                </span>
                <span class="text-indigo-200 text-sm font-semibold tracking-wide flex items-center gap-1.5 drop-shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ $post->published_at ? $post->published_at->format('M j, Y') : 'Draft' }}
                </span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-black tracking-tight mb-8 text-transparent bg-clip-text bg-gradient-to-b from-white to-slate-300 drop-shadow-2xl leading-[1.1]">
                {{ $post->title }}
            </h1>
            <div class="flex items-center justify-center gap-4 bg-black/20 backdrop-blur-sm inline-flex mx-auto p-2 pr-6 rounded-full border border-white/10 shadow-xl">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 border border-white/20 flex items-center justify-center text-white font-black text-lg shadow-inner">
                    {{ substr(optional($post->author)->name ?? 'S', 0, 1) }}
                </div>
                <div class="text-left">
                    <p class="text-sm font-bold text-white drop-shadow-md tracking-wide">{{ optional($post->author)->name ?? 'System' }}</p>
                    <p class="text-xs text-indigo-300 font-medium tracking-wider uppercase mt-px">Author</p>
                </div>
            </div>
        </div>
    </header>
    @elseif($post->cover_image)
    <!-- Standard Hero Image Banner -->
    <header class="relative bg-slate-900 h-[50vh] min-h-[400px] overflow-hidden flex flex-col items-center justify-center rounded-b-[3rem] shadow-2xl z-10">
        <div class="absolute inset-0">
            <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover opacity-50 filter saturate-100 transform scale-105">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-slate-900/10"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/40 to-black/20 mix-blend-multiply"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-16 mt-4">
            <div class="flex items-center justify-center gap-4 mb-6">
                <span class="bg-indigo-600/80 backdrop-blur-md text-white border border-indigo-400/30 text-xs font-bold uppercase tracking-widest py-1.5 px-4 rounded-full shadow-lg">
                    {{ optional($post->category)->name ?? 'Uncategorized' }}
                </span>
                <span class="text-indigo-100 text-sm font-semibold tracking-wide flex items-center gap-1.5 drop-shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ $post->published_at ? $post->published_at->format('M j, Y') : 'Draft' }}
                </span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight mb-8 text-white drop-shadow-2xl leading-[1.15]">
                {{ $post->title }}
            </h1>
            <div class="flex items-center justify-center gap-4 bg-white/10 backdrop-blur-md inline-flex mx-auto p-2 pr-6 rounded-full border border-white/20 shadow-xl">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 border border-white/20 flex items-center justify-center text-white font-black text-lg shadow-inner">
                    {{ substr(optional($post->author)->name ?? 'S', 0, 1) }}
                </div>
                <div class="text-left">
                    <p class="text-sm font-bold text-white drop-shadow-md tracking-wide">{{ optional($post->author)->name ?? 'System' }}</p>
                    <p class="text-xs text-indigo-200 font-medium tracking-wider uppercase mt-px">Author</p>
                </div>
            </div>
        </div>
    </header>
    @else
    <!-- Minimalist Typography Header -->
    <header class="bg-white pt-32 pb-24 text-center rounded-b-[3rem] shadow-sm border-b border-slate-100 z-10 relative overflow-hidden">
        <!-- Abstract Decoration -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 transform translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
        <div class="absolute top-20 left-0 w-72 h-72 bg-purple-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 transform -translate-x-1/2 pointer-events-none"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
            <div class="flex items-center justify-center gap-4 mb-6">
                <span class="bg-indigo-50 text-indigo-700 border border-indigo-100 text-xs font-bold uppercase tracking-widest py-1.5 px-4 rounded-full shadow-sm">
                    {{ optional($post->category)->name ?? 'Uncategorized' }}
                </span>
                <span class="text-slate-500 text-sm font-semibold tracking-wide flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ $post->published_at ? $post->published_at->format('M j, Y') : 'Draft' }}
                </span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-slate-900 mb-8 leading-[1.15] drop-shadow-sm">
                {{ $post->title }}
            </h1>
            <div class="flex items-center justify-center gap-4 inline-flex mx-auto p-2 pr-6 rounded-full border border-slate-100 bg-white shadow-sm hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-100 to-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-700 font-black text-lg">
                    {{ substr(optional($post->author)->name ?? 'S', 0, 1) }}
                </div>
                <div class="text-left">
                    <p class="text-sm font-bold text-slate-800 tracking-wide">{{ optional($post->author)->name ?? 'System' }}</p>
                    <p class="text-xs text-slate-500 font-medium tracking-wider uppercase mt-px">Author</p>
                </div>
            </div>
        </div>
    </header>
    @endif

    <!-- Main Rich Text Content Area -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24 -mt-10 relative z-20">
        <!-- Content Body inside a Glass Card -->
        <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-xl border border-slate-100 p-8 sm:p-12 md:p-16">
            <div class="prose prose-lg sm:prose-xl prose-indigo mx-auto text-slate-700 font-medium leading-relaxed
                prose-headings:font-black prose-headings:tracking-tight prose-headings:text-slate-900
                prose-p:text-slate-600 prose-p:leading-loose
                prose-a:text-indigo-600 prose-a:no-underline hover:prose-a:text-indigo-700 hover:prose-a:underline
                prose-img:rounded-2xl prose-img:shadow-lg
                prose-blockquote:border-l-4 prose-blockquote:border-indigo-500 prose-blockquote:bg-indigo-50/50 prose-blockquote:py-2 prose-blockquote:px-6 prose-blockquote:-ml-6 prose-blockquote:rounded-r-xl prose-blockquote:not-italic prose-blockquote:text-slate-800 prose-blockquote:font-semibold">
                {!! $post->content !!}
            </div>

            <!-- Tags Module -->
            @if(!empty($post->tags) && count($post->tags) > 0)
            <div class="mt-20 pt-10 border-t border-slate-100">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    Filed Under
                </h3>
                <div class="flex flex-wrap gap-2.5">
                    @foreach($post->tags as $tag)
                    <span class="inline-flex items-center px-4 py-2 bg-slate-50 text-slate-700 font-bold border border-slate-200 rounded-xl text-sm hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 hover:text-white hover:border-transparent hover:shadow-md transition-all duration-300 cursor-pointer">
                        #{{ $tag }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Next / Previous Post Navigation -->
        @if(isset($previous) || isset($next))
        <div class="mt-16 pt-10 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-2 gap-6">
            @if(isset($previous))
            <a href="{{ route('blog.show', $previous->slug) }}" class="group block p-6 bg-white/70 backdrop-blur-md rounded-2xl border border-slate-200 hover:border-indigo-300 hover:bg-white hover:shadow-lg transition-all duration-300 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10 flex flex-col h-full justify-center">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 flex items-center gap-1.5"><svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg> Previous Post</span>
                    <h4 class="text-lg font-bold text-slate-800 group-hover:text-indigo-600 transition-colors line-clamp-2 leading-snug">{{ $previous->title }}</h4>
                </div>
            </a>
            @else
            <div></div> <!-- Spacer -->
            @endif

            @if(isset($next))
            <a href="{{ route('blog.show', $next->slug) }}" class="group block p-6 bg-white/70 backdrop-blur-md rounded-2xl border border-slate-200 hover:border-indigo-300 hover:bg-white hover:shadow-lg transition-all duration-300 relative overflow-hidden text-right">
                <div class="absolute inset-0 bg-gradient-to-l from-indigo-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10 flex flex-col h-full justify-center text-right">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 flex items-center justify-end gap-1.5">Next Post <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></span>
                    <h4 class="text-lg font-bold text-slate-800 group-hover:text-indigo-600 transition-colors line-clamp-2 leading-snug">{{ $next->title }}</h4>
                </div>
            </a>
            @else
            <div></div> <!-- Spacer -->
            @endif
        </div>
        @endif
        
        <!-- Back to Blog Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-white border border-slate-200 hover:border-indigo-200 text-slate-700 hover:text-indigo-600 font-bold rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 focus:ring-4 focus:ring-indigo-100 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to All Articles
            </a>
        </div>
    </div>
    
</article>
@endsection
