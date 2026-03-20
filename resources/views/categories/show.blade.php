@extends('layouts.app')

@section('title', $category->name . ' - Categories - ' . config('app.name'))

@section('content')
<header class="bg-indigo-900 text-white pt-32 pb-20 text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-indigo-300 font-bold tracking-widest uppercase text-sm mb-4 block">Topic / Category</span>
        <h1 class="text-5xl md:text-6xl font-black tracking-tight mb-6">
            {{ $category->name }}
        </h1>
        @if($category->description)
        <p class="text-xl text-indigo-100 max-w-2xl mx-auto">{{ $category->description }}</p>
        @endif
    </div>
</header>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 space-y-20">
    
    @if($pages->count() > 0)
    <section>
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-slate-900 flex items-center gap-3">
                <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Dedicated Services
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($pages as $page)
            <a href="{{ route('pages.show', $page->slug) }}" class="group flex flex-col bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl ring-1 ring-slate-900/5 transition-all duration-300 hover:-translate-y-1">
                @if($page->cover_image)
                <div class="aspect-[16/9] overflow-hidden bg-slate-100">
                    <img src="{{ asset('storage/' . $page->cover_image) }}" alt="{{ $page->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                @endif
                <div class="p-8 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-indigo-600 transition-colors leading-tight">{{ $page->title }}</h3>
                    <p class="text-slate-500 line-clamp-2 mb-6 text-sm">{{ $page->meta_description ?: strip_tags($page->content) }}</p>
                    <div class="mt-auto flex items-center justify-between text-sm font-semibold text-indigo-600">
                        <span>Read Page</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    @if($posts->count() > 0)
    <section>
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-slate-900 flex items-center gap-3">
                <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                Articles & Insights
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <a href="{{ route('blog.show', $post->slug) }}" class="group flex flex-col bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl ring-1 ring-slate-900/5 transition-all duration-300 hover:-translate-y-1">
                @if($post->cover_image)
                <div class="aspect-[16/9] overflow-hidden bg-slate-100 relative">
                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-slate-800 shadow-sm">
                        {{ $post->published_at->format('M d, Y') }}
                    </div>
                </div>
                @endif
                <div class="p-8 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-indigo-600 transition-colors leading-tight">{{ $post->title }}</h3>
                    <p class="text-slate-500 line-clamp-3 mb-6 text-sm">{{ $post->excerpt ?? strip_tags($post->content) }}</p>
                    <div class="mt-auto flex items-center justify-between text-sm font-semibold text-slate-400">
                        <span class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">
                                {{ substr(optional($post->author)->name ?? 'S', 0, 1) }}
                            </span>
                            {{ optional($post->author)->name ?? 'System' }}
                        </span>
                        <span>{{ $post->reading_time ?? '3' }} min read</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    @if($pages->count() === 0 && $posts->count() === 0)
    <div class="text-center py-24 bg-slate-50 rounded-3xl border border-dashed border-slate-300">
        <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        <h3 class="text-xl font-bold text-slate-800 mb-2">No Content Yet</h3>
        <p class="text-slate-500 max-w-sm mx-auto">We're working on gathering great resources for {{ $category->name }}.</p>
        <a href="{{ route('pages.home') ?? '/' }}" class="inline-block mt-8 px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition-colors shadow-sm">Return Home</a>
    </div>
    @endif

</div>
@endsection
