@extends('layouts.app')

@section('title', $post->meta_title ?: $post->title)

@section('meta')
<meta name="description" content="{{ $post->meta_description ?: ($post->excerpt ?: Str::limit(strip_tags($post->content), 160)) }}">
@if($post->meta_keywords)
<meta name="keywords" content="{{ $post->meta_keywords }}">
@endif
@if($post->author)
<meta name="author" content="{{ $post->author->name }}">
@endif
@endsection

@if($post->cover_image)
@section('og_image', asset('storage/' . $post->cover_image))
@endif

@section('content')
<article class="bg-white min-h-screen">
    
    <!-- Header/Hero Section -->
    <header class="relative bg-slate-900 text-white overflow-hidden py-24 sm:py-32">
        @if($post->cover_image)
        <div class="absolute inset-0">
            <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover opacity-30">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/60 to-slate-900/10"></div>
        @endif
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            
            @if($post->category)
            <div class="mb-6">
                <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}" class="inline-block bg-indigo-600/90 backdrop-blur-sm text-white px-4 py-1.5 rounded-full text-sm font-bold tracking-wide uppercase hover:bg-indigo-500 transition-colors">
                    {{ $post->category->name }}
                </a>
            </div>
            @endif
            
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-8 drop-shadow-lg leading-tight">
                {{ $post->title }}
            </h1>
            
            <div class="flex flex-wrap items-center justify-center gap-6 text-sm sm:text-base text-slate-200 font-medium">
                @if($post->author)
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center border border-slate-600 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <span>{{ $post->author->name }}</span>
                </div>
                @endif
                
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <time datetime="{{ $post->published_at->format('Y-m-d') }}">{{ $post->published_at->format('M j, Y') }}</time>
                </div>
            </div>
            
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        @if($post->excerpt)
        <div class="prose prose-lg mx-auto mb-10 text-slate-500 font-medium text-xl leading-relaxed italic border-l-4 border-indigo-500 pl-6">
            {{ $post->excerpt }}
        </div>
        @endif
        
        <div class="prose prose-lg prose-indigo mx-auto text-slate-700">
            {!! $post->content !!}
        </div>
        
    </div>
    
</article>
@endsection
