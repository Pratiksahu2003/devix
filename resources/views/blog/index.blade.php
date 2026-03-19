@extends('layouts.app')

@section('title', 'Blog | ' . config('company.brand'))
@section('meta', 'Read the latest photography and videography tips, studio news, and updates from ' . config('company.brand'))

@section('content')
<!-- Modern Hero Section -->
<div class="relative overflow-hidden bg-slate-900 pt-24 pb-32 sm:pt-32 sm:pb-40 rounded-b-[3rem] sm:rounded-b-[4rem] shadow-2xl mb-16 sm:mb-24">
    <!-- Deep Mesh Background -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-indigo-900 via-slate-900 to-black opacity-90"></div>
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-[pulse_8s_ease-in-out_infinite]"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-indigo-600 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-[pulse_10s_ease-in-out_infinite] animation-delay-2000"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold text-indigo-200 bg-indigo-900/50 border border-indigo-700/50 backdrop-blur-md mb-6 shadow-lg uppercase tracking-widest text-xs">
            DyWix Studio Insights
        </span>
        <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white via-indigo-100 to-slate-400 tracking-tight mb-6 drop-shadow-sm pb-2">
            Our Blog
        </h1>
        <p class="text-lg md:text-xl text-slate-300 max-w-2xl mx-auto font-medium leading-relaxed">
            Discover cutting-edge tips, inspiring stories, and technical insights from our premier creative studio.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
    @if($categories->count() > 0)
    <!-- Premium Category Filters -->
    <div class="flex flex-wrap justify-center gap-3 mb-16 relative z-10">
        <a href="{{ route('blog.index') }}" class="px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300 {{ !request('category') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md shadow-indigo-500/30 transform scale-105' : 'bg-white text-slate-600 hover:text-indigo-600 hover:bg-slate-50 hover:scale-105 shadow-sm border border-slate-200' }}">
            All Articles
        </a>
        
        @foreach($categories as $category)
        <a href="{{ route('blog.index', ['category' => $category->slug]) }}" class="px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300 {{ request('category') === $category->slug ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md shadow-indigo-500/30 transform scale-105' : 'bg-white text-slate-600 hover:text-indigo-600 hover:bg-slate-50 hover:scale-105 shadow-sm border border-slate-200' }}">
            {{ $category->name }}
        </a>
        @endforeach
    </div>
    @endif

    @if($posts->count() > 0)
    <!-- Glassmorphic Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @foreach($posts as $post)
        <article class="group relative bg-white/80 backdrop-blur-xl rounded-3xl shadow-sm hover:shadow-2xl border border-slate-100 hover:border-indigo-100 overflow-hidden flex flex-col transition-all duration-500 hover:-translate-y-2">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/5 to-purple-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl pointer-events-none"></div>
            
            <a href="{{ route('blog.show', $post->slug) }}" class="block aspect-[4/3] relative overflow-hidden bg-slate-100/50 m-2 rounded-2xl z-10 hover:shadow-inner">
                @if($post->cover_image)
                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 group-hover:rotate-1 transition-all duration-700 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-500"></div>
                @else
                    <div class="absolute inset-0 flex items-center justify-center text-slate-300 group-hover:scale-110 transition-transform duration-700 bg-gradient-to-br from-slate-100 to-slate-200">
                        <svg class="w-16 h-16 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                @endif
                
                @if($post->category)
                <div class="absolute top-4 left-4">
                    <div class="bg-white/95 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-black text-indigo-600 shadow-lg tracking-wide uppercase">
                        {{ $post->category->name }}
                    </div>
                </div>
                @endif
            </a>
            
            <div class="p-6 md:p-8 flex flex-col flex-1 relative z-10">
                <div class="flex items-center gap-3 text-xs font-semibold tracking-wider text-slate-400 mb-4 uppercase">
                    <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <time datetime="{{ $post->published_at->format('Y-m-d') }}">{{ $post->published_at->format('M j, Y') }}</time>
                </div>
                
                <a href="{{ route('blog.show', $post->slug) }}" class="block mb-4">
                    <h2 class="text-2xl font-extrabold text-slate-900 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-indigo-600 group-hover:to-purple-600 transition-all duration-300 line-clamp-2 leading-tight">
                        {{ $post->title }}
                    </h2>
                </a>
                
                <p class="text-slate-500 mb-8 line-clamp-3 flex-1 font-medium leading-relaxed">
                    {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 120) }}
                </p>
                
                <div class="mt-auto flex items-center pt-6 border-t border-slate-100/80">
                    @if($post->author)
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xs shadow-md">
                            {{ substr($post->author->name, 0, 1) }}
                        </div>
                        <div class="font-bold text-slate-700 text-sm">
                            {{ $post->author->name }}
                        </div>
                    </div>
                    @endif
                    <a href="{{ route('blog.show', $post->slug) }}" class="ml-auto inline-flex items-center justify-center w-10 h-10 rounded-full bg-slate-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                        <svg class="w-5 h-5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </article>
        @endforeach
    </div>
    
    <div class="mt-20">
        {{ $posts->links() }}
    </div>
    
    @else
    <div class="text-center py-32 px-4 bg-white/60 backdrop-blur-xl rounded-[3rem] shadow-sm border border-slate-100 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-transparent to-slate-50/50 pointer-events-none"></div>
        <div class="relative z-10">
            <div class="mx-auto w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mb-6 shadow-inner">
                <svg class="h-10 w-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9a2 2 0 00-2 2v2M4 7h16"></path></svg>
            </div>
            <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">No Articles Yet</h3>
            <p class="mt-4 text-slate-500 max-w-sm mx-auto font-medium">We're working on some exciting content. Check back soon for our latest updates!</p>
        </div>
    </div>
    @endif
</div>
@endsection
