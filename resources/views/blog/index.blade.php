@extends('layouts.app')

@section('title', 'Blog | ' . config('company.brand'))
@section('meta', 'Read the latest photography and videography tips, studio news, and updates from ' . config('company.brand'))

@section('content')
<div class="bg-slate-50 py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-16">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight mb-4">Our Blog</h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">Discover tips, stories, and insights from our creative studio.</p>
        </div>

        @if($categories->count() > 0)
        <!-- Category Filters -->
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <a href="{{ route('blog.index') }}" class="px-5 py-2 rounded-full text-sm font-semibold transition-all {{ !request('category') ? 'bg-indigo-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 shadow-sm border border-slate-200' }}">All Articles</a>
            
            @foreach($categories as $category)
            <a href="{{ route('blog.index', ['category' => $category->slug]) }}" class="px-5 py-2 rounded-full text-sm font-semibold transition-all {{ request('category') === $category->slug ? 'bg-indigo-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 shadow-sm border border-slate-200' }}">
                {{ $category->name }}
            </a>
            @endforeach
        </div>
        @endif

        @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <article class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col group hover:shadow-xl transition-all duration-300">
                <a href="{{ route('blog.show', $post->slug) }}" class="block aspect-video relative overflow-hidden bg-slate-100">
                    @if($post->cover_image)
                        <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center text-slate-300 group-hover:scale-105 transition-transform duration-500">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    @if($post->category)
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-indigo-700 shadow-sm">
                        {{ $post->category->name }}
                    </div>
                    @endif
                </a>
                
                <div class="p-6 flex flex-col flex-1">
                    <div class="flex items-center gap-3 text-sm text-slate-500 mb-4">
                        <time datetime="{{ $post->published_at->format('Y-m-d') }}">{{ $post->published_at->format('M j, Y') }}</time>
                    </div>
                    
                    <a href="{{ route('blog.show', $post->slug) }}" class="block mb-3">
                        <h2 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors line-clamp-2">
                            {{ $post->title }}
                        </h2>
                    </a>
                    
                    <p class="text-slate-600 mb-6 line-clamp-3 flex-1">
                        {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 120) }}
                    </p>
                    
                    <div class="mt-auto flex items-center pt-4 border-t border-slate-100">
                        @if($post->author)
                        <div class="font-medium text-slate-800 text-sm">
                            By {{ $post->author->name }}
                        </div>
                        @endif
                        <a href="{{ route('blog.show', $post->slug) }}" class="ml-auto flex items-center text-sm font-semibold text-indigo-600 group-hover:text-indigo-700">
                            Read more
                            <svg class="ml-1 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        
        <div class="mt-16">
            {{ $posts->links() }}
        </div>
        
        @else
        <div class="text-center py-24 bg-white rounded-3xl shadow-sm border border-slate-100">
            <svg class="mx-auto h-16 w-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9a2 2 0 00-2 2v2M4 7h16"></path></svg>
            <h3 class="mt-4 text-xl font-bold text-slate-800">No Articles Yet</h3>
            <p class="mt-2 text-slate-500">Check back soon for exciting content!</p>
        </div>
        @endif
        
    </div>
</div>
@endsection
