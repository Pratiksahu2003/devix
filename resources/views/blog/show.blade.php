@extends('layouts.app')

@section('title', seo_post_page_title($post))

@section('seo_head')
    @isset($seo)
        <x-seo.head :meta="$seo['meta']" :schema="$seo['schema_graph']" />
    @endisset
@endsection

@section('content')
@php
    $coverUrl = blog_cover_url($post->cover_image);
    $fallbackCover = asset(blog_default_cover());
@endphp
<article class="bg-surface-muted min-h-screen pb-20 font-sans">

    {{-- Hero --}}
    <section class="bg-brand-lens-blue pt-20 pb-10 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ $coverUrl }}" alt="" aria-hidden="true" class="w-full h-full object-cover filter saturate-50 opacity-30 mix-blend-screen" onerror="this.onerror=null;this.src='{{ $fallbackCover }}'">
        </div>
        <div class="absolute inset-0 bg-linear-to-br from-brand-lens-blue/95 to-slate-900/90 z-0"></div>
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-white/5 rounded-full filter blur-3xl transform translate-x-1/3 -translate-y-1/3 pointer-events-none z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <nav aria-label="Breadcrumb" class="flex items-center text-sm font-medium text-brand-lens-blue-soft/80 mb-5 tracking-wide">
                <a href="/" class="hover:text-white flex items-center gap-1.5 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                    Home
                </a>
                <span class="mx-2 opacity-50">&rsaquo;</span>
                <a href="{{ route('blog.index') }}" class="hover:text-white transition-colors">Blog</a>
                <span class="mx-2 opacity-50">&rsaquo;</span>
                <span class="text-white truncate max-w-[200px] sm:max-w-md">{{ $post->title }}</span>
            </nav>

            <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-brand-lens-blue-soft/90 text-sm mb-5">
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                    {{ optional($post->author)->name ?? 'Admin' }}
                </span>
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                    {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}
                </span>
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                    {{ max(1, ceil(str_word_count(strip_tags($post->content)) / 200)) }} min read
                </span>
                @if($post->category)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-white/10 text-white border border-white/20">
                    {{ $post->category->name }}
                </span>
                @endif
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-[2.75rem] font-bold text-white leading-tight mb-4 max-w-4xl tracking-tight">
                {{ $post->title }}
            </h1>

            @if($post->excerpt)
            <p class="text-base sm:text-lg text-brand-lens-blue-soft/90 max-w-3xl leading-relaxed">
                {{ $post->excerpt }}
            </p>
            @endif
        </div>
    </section>

    {{-- Main layout --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">

            {{-- Article --}}
            <div class="lg:col-span-8">
                <div class="bg-white rounded-2xl shadow-sm border border-border-subtle overflow-hidden">

                    @if($post->video_url)
                        <div class="w-full aspect-video bg-black relative">
                            @php
                                $embedUrl = $post->video_url;
                                if (Str::contains($embedUrl, 'youtube.com/watch?v=')) {
                                    $embedUrl = Str::replace('watch?v=', 'embed/', $embedUrl);
                                }
                            @endphp
                            <iframe class="w-full h-full absolute inset-0" src="{{ $embedUrl }}" frameborder="0" allowfullscreen title="{{ $post->title }} video"></iframe>
                        </div>
                    @else
                        <div class="w-full aspect-video sm:aspect-21/9 bg-surface-muted">
                            <img src="{{ $coverUrl }}" alt="{{ $post->title }}" class="w-full h-full object-cover" fetchpriority="high" decoding="async" onerror="this.onerror=null;this.src='{{ $fallbackCover }}'">
                        </div>
                    @endif

                    <div class="p-6 sm:p-8 lg:p-10">
                        <div class="blog-content max-w-none">
                            <div class="w-full max-w-full overflow-x-auto overscroll-x-contain [-webkit-overflow-scrolling:touch]">
                                {!! $post->content !!}
                            </div>
                        </div>

                        @if(is_array($post->tags) || json_decode($post->tags))
                        @php $tags = is_array($post->tags) ? $post->tags : json_decode($post->tags, true); @endphp
                        @if(!empty($tags))
                        <div class="mt-10 pt-8 border-t border-border-subtle flex flex-wrap gap-2 items-center">
                            <span class="text-xs font-semibold text-text-muted uppercase tracking-wider mr-1">Tags</span>
                            @foreach($tags as $tag)
                                <span class="px-3 py-1 bg-surface-muted text-text-muted rounded-lg text-sm font-medium border border-border-subtle">#{{ $tag }}</span>
                            @endforeach
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">

                @if(isset($categories) && $categories->count() > 0)
                <div class="bg-white rounded-2xl p-5 sm:p-6 border border-border-subtle shadow-sm">
                    <h2 class="font-bold text-text-main text-base mb-4">Categories</h2>
                    <div class="space-y-1.5">
                        @foreach($categories as $cat)
                        <a href="{{ route('category.show', $cat->slug) }}"
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl text-sm {{ optional($post->category)->id === $cat->id ? 'bg-brand-lens-blue-soft text-brand-lens-blue font-semibold' : 'text-text-muted hover:bg-surface-muted hover:text-text-main' }} transition-colors">
                            <span>{{ $cat->name }}</span>
                            <span class="text-xs font-semibold tabular-nums opacity-70">{{ $cat->posts_count }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                @if(isset($latestPosts) && $latestPosts->count() > 0)
                <div class="bg-white rounded-2xl p-5 sm:p-6 border border-border-subtle shadow-sm">
                    <h2 class="font-bold text-text-main text-base mb-4">Latest Posts</h2>
                    <div class="space-y-4">
                        @foreach($latestPosts as $lPost)
                        <a href="{{ route('blog.show', $lPost->slug) }}" class="flex gap-3 group items-start">
                            <div class="w-14 h-14 rounded-xl overflow-hidden shrink-0 bg-surface-muted border border-border-subtle">
                                <img src="{{ blog_cover_url($lPost->cover_image) }}" alt="{{ $lPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='{{ $fallbackCover }}'">
                            </div>
                            <div class="flex-1 min-w-0 pt-0.5">
                                <h3 class="font-semibold text-text-main text-sm leading-snug line-clamp-2 group-hover:text-brand-lens-blue transition-colors">
                                    {{ $lPost->title }}
                                </h3>
                                <p class="text-xs text-text-muted mt-1">
                                    {{ $lPost->published_at ? $lPost->published_at->format('M d, Y') : 'Draft' }}
                                </p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <a href="{{ route('blog.index') }}" class="mt-4 flex items-center justify-center gap-1.5 w-full py-2.5 rounded-xl border border-border-subtle text-sm font-semibold text-brand-lens-blue hover:bg-brand-lens-blue-soft transition-colors">
                        View all posts
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
                @endif

                @if(isset($relatedPosts) && $relatedPosts->count() > 0)
                <div class="bg-white rounded-2xl p-5 sm:p-6 border border-border-subtle shadow-sm">
                    <h2 class="font-bold text-text-main text-base mb-4">Related Articles</h2>
                    <div class="space-y-4">
                        @foreach($relatedPosts as $relPost)
                        <a href="{{ route('blog.show', $relPost->slug) }}" class="flex gap-3 group items-start">
                            <div class="w-14 h-14 rounded-xl overflow-hidden shrink-0 bg-surface-muted border border-border-subtle">
                                @if($relPost->video_url && ! $relPost->cover_image)
                                    <div class="w-full h-full bg-slate-800 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white/60" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                @else
                                    <img src="{{ blog_cover_url($relPost->cover_image) }}" alt="{{ $relPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='{{ $fallbackCover }}'">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0 pt-0.5">
                                <h3 class="font-semibold text-text-main text-sm leading-snug line-clamp-2 group-hover:text-brand-lens-blue transition-colors">
                                    {{ $relPost->title }}
                                </h3>
                                <p class="text-xs text-text-muted mt-1">
                                    {{ $relPost->published_at ? $relPost->published_at->format('M d, Y') : 'Draft' }}
                                </p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </aside>
        </div>

        {{-- Prev / Next --}}
        @if(isset($previous) || isset($next))
        <div class="mt-12 pt-10 border-t border-border-subtle">
            <p class="text-center text-xs font-semibold text-text-muted uppercase tracking-widest mb-6">Continue Reading</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                @if(isset($previous))
                <a href="{{ route('blog.show', $previous->slug) }}" class="group flex flex-col bg-white rounded-2xl border border-border-subtle hover:border-brand-lens-blue/40 hover:shadow-md transition-all overflow-hidden">
                    <div class="h-36 relative overflow-hidden bg-surface-muted shrink-0">
                        <img src="{{ blog_cover_url($previous->cover_image) }}" alt="{{ $previous->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='{{ $fallbackCover }}'">
                        <div class="absolute inset-0 bg-linear-to-t from-slate-900/50 to-transparent"></div>
                        <span class="absolute top-3 left-3 flex items-center gap-1.5 bg-white/95 backdrop-blur-sm px-2.5 py-1 rounded-full text-xs font-semibold text-text-muted">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            Previous
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="text-sm font-bold text-text-main group-hover:text-brand-lens-blue transition-colors line-clamp-2 leading-snug">{{ $previous->title }}</h3>
                        <p class="text-xs text-text-muted mt-2">{{ $previous->published_at ? $previous->published_at->format('M d, Y') : 'Draft' }}</p>
                    </div>
                </a>
                @else
                <div></div>
                @endif

                @if(isset($next))
                <a href="{{ route('blog.show', $next->slug) }}" class="group flex flex-col bg-white rounded-2xl border border-border-subtle hover:border-brand-lens-blue/40 hover:shadow-md transition-all overflow-hidden">
                    <div class="h-36 relative overflow-hidden bg-surface-muted shrink-0">
                        <img src="{{ blog_cover_url($next->cover_image) }}" alt="{{ $next->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='{{ $fallbackCover }}'">
                        <div class="absolute inset-0 bg-linear-to-t from-slate-900/50 to-transparent"></div>
                        <span class="absolute top-3 right-3 flex items-center gap-1.5 bg-white/95 backdrop-blur-sm px-2.5 py-1 rounded-full text-xs font-semibold text-text-muted">
                            Next
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </span>
                    </div>
                    <div class="p-5 text-right">
                        <h3 class="text-sm font-bold text-text-main group-hover:text-brand-lens-blue transition-colors line-clamp-2 leading-snug">{{ $next->title }}</h3>
                        <p class="text-xs text-text-muted mt-2">{{ $next->published_at ? $next->published_at->format('M d, Y') : 'Draft' }}</p>
                    </div>
                </a>
                @else
                <div></div>
                @endif

            </div>
        </div>
        @endif

    </div>
</article>
@endsection
