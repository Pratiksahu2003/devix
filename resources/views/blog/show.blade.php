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
<div class="bg-[#FAFAFA] min-h-screen pb-20 font-sans">
    
    <!-- Hero Section (Gradient with Cover Image background) -->
    <section class="bg-[#3a155c] pt-20 pb-10 relative overflow-hidden">
        <!-- Background Image & Gradient Overlay -->
        @if($post->cover_image)
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover filter saturate-50 opacity-30 mix-blend-screen">
        </div>
        <div class="absolute inset-0 bg-gradient-to-br from-[#59267c]/95 to-[#3a155c]/95 z-0 mix-blend-multiply"></div>
        @else
        <div class="absolute inset-0 bg-gradient-to-br from-[#59267c] to-[#3a155c] z-0"></div>
        @endif

        <!-- Abstract Decorations -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-white/10 rounded-full filter blur-3xl transform translate-x-1/3 -translate-y-1/3 pointer-events-none z-0"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-purple-500/20 rounded-full filter blur-3xl transform -translate-x-1/2 translate-y-1/2 pointer-events-none z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumbs -->
            <nav class="flex items-center text-sm font-semibold text-purple-200 mb-4 tracking-wide">
                <a href="/" class="hover:text-white flex items-center gap-1.5 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg> 
                    Home
                </a>
                <span class="mx-2 opacity-50">&rsaquo;</span>
                <a href="{{ route('blog.index') }}" class="hover:text-white transition-colors">Blog</a>
                <span class="mx-2 opacity-50">&rsaquo;</span>
                <span class="text-white truncate max-w-[200px] sm:max-w-none">{{ $post->title }}</span>
            </nav>

            <!-- Metadata -->
            <div class="flex flex-wrap items-center gap-6 text-purple-100/90 font-medium text-sm mb-4">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                    {{ optional($post->author)->name ?? 'Admin' }}
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                    {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                    {{ max(1, ceil(str_word_count(strip_tags($post->content)) / 200)) }} min read
                </div>
            </div>

            <!-- Title -->
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-[1.15] mb-4 max-w-5xl tracking-tight drop-shadow-sm">
                {{ $post->title }}
            </h1>

            <!-- Excerpt / Quote Block -->
            @if($post->excerpt)
            <div class="flex items-start gap-3 max-w-4xl mt-3">
                <svg class="w-6 h-6 text-pink-400 shrink-0 mt-1 opacity-80" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h4v10h-10z"/></svg>
                <p class="text-base sm:text-lg text-purple-50/90 font-medium leading-relaxed">
                    {{ $post->excerpt }}
                </p>
            </div>
            @endif
        </div>
    </section>

    <!-- Main Display Grid layout -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-[1fr_380px] gap-10 items-start">
            
            <!-- Left Column: Media & Content -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden">
                
                <!-- Media Display at Top -->
                @if($post->video_url)
                    <div class="w-full aspect-video bg-black relative">
                        @php
                            $embedUrl = $post->video_url;
                            if (Str::contains($embedUrl, 'youtube.com/watch?v=')) {
                                $embedUrl = Str::replace('watch?v=', 'embed/', $embedUrl);
                            }
                        @endphp
                        <iframe class="w-full h-full absolute inset-0" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                @elseif($post->cover_image)
                    <div class="w-full aspect-video sm:aspect-[21/9] bg-slate-100">
                        <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <!-- Fallback if no media -->
                    <div class="h-8 bg-white"></div>
                @endif
                
                <!-- Content Body -->
                <div class="p-6 sm:p-10 lg:p-12">
                    <article class="prose prose-lg sm:prose-xl prose-slate max-w-none 
                        prose-headings:font-bold prose-headings:text-slate-900 
                        prose-a:text-indigo-600 hover:prose-a:text-indigo-500 
                        prose-img:rounded-2xl prose-img:shadow-md">
                        {!! $post->content !!}
                    </article>

                    <!-- Tags Footer -->
                    @if(is_array($post->tags) || json_decode($post->tags))
                    @php $tags = is_array($post->tags) ? $post->tags : json_decode($post->tags, true); @endphp
                    @if(!empty($tags))
                    <div class="mt-12 flex flex-wrap gap-2 items-center">
                        <span class="text-sm font-bold text-slate-400 uppercase tracking-widest mr-2">Tags:</span>
                        @foreach($tags as $tag)
                            <span class="px-4 py-1.5 bg-slate-100 text-slate-600 rounded-lg text-sm font-semibold hover:bg-slate-200 transition-colors border border-slate-200/60 cursor-default">#{{ $tag }}</span>
                        @endforeach
                    </div>
                    @endif
                    @endif
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <aside class="space-y-8 sticky top-8">
                
                <!-- Post Details Card -->
                <div class="bg-white rounded-3xl p-7 border border-slate-200/60 shadow-sm">
                    <h3 class="font-extrabold text-slate-900 text-lg mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
                        </div>
                        Post Details
                    </h3>
                    <div class="space-y-4 text-sm font-bold">
                        <div class="flex items-center justify-between py-3 border-b border-slate-100">
                            <span class="text-slate-500">Status</span>
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-black border border-emerald-100 uppercase tracking-wider">Published</span>
                        </div>
                        <div class="flex items-center justify-between py-3 border-b border-slate-100">
                            <span class="text-slate-500">Category</span>
                            @if($post->category)
                            <a href="{{ route('category.show', $post->category->slug) }}" class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-xs font-black border border-indigo-100 uppercase tracking-wider hover:bg-indigo-100 transition-colors">{{ $post->category->name }}</a>
                            @else
                            <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-xs font-black border border-indigo-100 uppercase tracking-wider">General</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between py-3">
                            <span class="text-slate-500">Comments</span>
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-black border border-emerald-100 uppercase tracking-wider">Enabled</span>
                        </div>
                    </div>
                </div>

                <!-- Categories Card -->
                @if(isset($categories) && $categories->count() > 0)
                <div class="bg-white rounded-3xl p-7 border border-slate-200/60 shadow-sm">
                    <h3 class="font-extrabold text-slate-900 text-lg mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </div>
                        Categories
                    </h3>
                    <div class="space-y-2">
                        @foreach($categories as $cat)
                        <a href="{{ route('category.show', $cat->slug) }}"
                           class="flex items-center justify-between px-4 py-3 rounded-2xl border {{ optional($post->category)->id === $cat->id ? 'bg-violet-50 border-violet-200 text-violet-700' : 'bg-slate-50 border-slate-100 text-slate-700 hover:bg-violet-50 hover:border-violet-200 hover:text-violet-700' }} group transition-all duration-200">
                            <span class="font-bold text-sm flex items-center gap-2.5">
                                <span class="w-2 h-2 rounded-full {{ optional($post->category)->id === $cat->id ? 'bg-violet-500' : 'bg-slate-300 group-hover:bg-violet-400' }} transition-colors flex-shrink-0"></span>
                                {{ $cat->name }}
                            </span>
                            <span class="text-xs font-black {{ optional($post->category)->id === $cat->id ? 'bg-violet-200 text-violet-700' : 'bg-slate-200 text-slate-500 group-hover:bg-violet-200 group-hover:text-violet-700' }} px-2.5 py-1 rounded-full transition-colors">
                                {{ $cat->posts_count }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Latest Posts Card -->
                @if(isset($latestPosts) && $latestPosts->count() > 0)
                <div class="bg-white rounded-3xl p-7 border border-slate-200/60 shadow-sm">
                    <h3 class="font-extrabold text-slate-900 text-lg mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        Latest Posts
                    </h3>
                    <div class="space-y-5">
                        @foreach($latestPosts as $lPost)
                        <a href="{{ route('blog.show', $lPost->slug) }}" class="flex gap-4 group items-center">
                            <div class="w-16 h-16 rounded-2xl overflow-hidden flex-shrink-0 bg-slate-100 relative border border-slate-200 group-hover:border-amber-400 transition-colors">
                                @if($lPost->cover_image)
                                    <img src="{{ asset('storage/' . $lPost->cover_image) }}" alt="{{ $lPost->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-amber-100 to-orange-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex flex-col flex-1">
                                <h4 class="font-extrabold text-slate-900 text-sm leading-tight line-clamp-2 group-hover:text-amber-600 transition-colors mb-1">
                                    {{ $lPost->title }}
                                </h4>
                                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                    {{ $lPost->published_at ? $lPost->published_at->format('M d, Y') : 'Draft' }}
                                    @if($lPost->category)
                                    <span class="mx-1">&bull;</span><span class="text-amber-500">{{ $lPost->category->name }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                        <div class="pt-2">
                            <a href="{{ route('blog.index') }}" class="flex items-center justify-center gap-2 w-full py-3 rounded-2xl bg-slate-50 border border-slate-200 text-slate-600 font-bold text-sm hover:bg-amber-50 hover:border-amber-300 hover:text-amber-700 transition-all group">
                                View All Posts
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Related Articles Card -->
                @if(isset($relatedPosts) && $relatedPosts->count() > 0)
                <div class="bg-white rounded-3xl p-7 border border-slate-200/60 shadow-sm">
                    <h3 class="font-extrabold text-slate-900 text-lg mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1-1.1"></path></svg>
                        </div>
                        Related Articles
                    </h3>
                    <div class="space-y-6">
                        @foreach($relatedPosts as $relPost)
                        <a href="{{ route('blog.show', $relPost->slug) }}" class="flex gap-4 group items-center">
                            <div class="w-20 h-20 rounded-2xl overflow-hidden flex-shrink-0 bg-slate-100 relative border border-slate-200 group-hover:border-indigo-400 transition-colors">
                                @if($relPost->cover_image)
                                    <img src="{{ asset('storage/' . $relPost->cover_image) }}" alt="{{ $relPost->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                @elseif($relPost->video_url)
                                    <div class="absolute inset-0 bg-slate-900 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white/50" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-100 to-purple-100"></div>
                                @endif
                            </div>
                            <div class="flex flex-col flex-1 pl-1">
                                <h4 class="font-extrabold text-slate-900 text-sm leading-tight line-clamp-2 group-hover:text-indigo-600 transition-colors mb-1.5">
                                    {{ $relPost->title }}
                                </h4>
                                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                    {{ $relPost->published_at ? $relPost->published_at->format('M d') : 'Draft' }} 
                                    @if($relPost->category)
                                    <span class="mx-1">&bull;</span> <span class="text-indigo-500">{{ $relPost->category->name }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                
            </aside>
        </div>

        <!-- Next / Previous Article — Premium Editorial Navigation -->
        @if(isset($previous) || isset($next))
        <div class="mt-16 pt-12 border-t border-slate-200/60">
            <p class="text-center text-xs font-black text-slate-400 uppercase tracking-widest mb-8">Continue Reading</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @if(isset($previous))
                <a href="{{ route('blog.show', $previous->slug) }}" class="group relative flex flex-col bg-white rounded-3xl border border-slate-200/60 hover:border-indigo-300 hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="h-40 relative overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200 flex-shrink-0">
                        @if($previous->cover_image)
                            <img src="{{ asset('storage/' . $previous->cover_image) }}" alt="{{ $previous->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-purple-500/10 flex items-center justify-center">
                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4 flex items-center gap-2 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-sm border border-white/50 text-xs font-black text-slate-500 uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                            Previous
                        </div>
                    </div>
                    <div class="p-6">
                        @if($previous->category)
                        <span class="inline-block text-[11px] font-black text-indigo-500 uppercase tracking-widest mb-2">{{ $previous->category->name }}</span>
                        @endif
                        <h4 class="text-base font-extrabold text-slate-900 group-hover:text-indigo-600 transition-colors line-clamp-2 leading-tight mb-2">{{ $previous->title }}</h4>
                        <div class="flex items-center gap-2 text-xs text-slate-400 font-semibold">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                            {{ $previous->published_at ? $previous->published_at->format('M d, Y') : 'Draft' }}
                        </div>
                    </div>
                </a>
                @else
                <div></div>
                @endif

                @if(isset($next))
                <a href="{{ route('blog.show', $next->slug) }}" class="group relative flex flex-col bg-white rounded-3xl border border-slate-200/60 hover:border-indigo-300 hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="h-40 relative overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200 flex-shrink-0">
                        @if($next->cover_image)
                            <img src="{{ asset('storage/' . $next->cover_image) }}" alt="{{ $next->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-purple-500/10 flex items-center justify-center">
                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 flex items-center gap-2 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-sm border border-white/50 text-xs font-black text-slate-500 uppercase tracking-widest">
                            Next
                            <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </div>
                    <div class="p-6 text-right">
                        @if($next->category)
                        <span class="inline-block text-[11px] font-black text-indigo-500 uppercase tracking-widest mb-2">{{ $next->category->name }}</span>
                        @endif
                        <h4 class="text-base font-extrabold text-slate-900 group-hover:text-indigo-600 transition-colors line-clamp-2 leading-tight mb-2">{{ $next->title }}</h4>
                        <div class="flex items-center justify-end gap-2 text-xs text-slate-400 font-semibold">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                            {{ $next->published_at ? $next->published_at->format('M d, Y') : 'Draft' }}
                        </div>
                    </div>
                </a>
                @else
                <div></div>
                @endif

            </div>
        </div>
        @endif
        
    </div>
</div>
@endsection
