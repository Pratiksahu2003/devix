@extends('layouts.admin')

@section('title', 'Articles')
@section('page_title', 'Articles')
@section('page_subtitle', 'Manage your blog posts and articles')

@section('content')
<div class="mb-6 flex justify-end">
    <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-semibold transition-colors shadow-sm focus:ring-2 focus:ring-indigo-500/50">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Write Article
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 font-medium">
                <tr>
                    <th scope="col" class="px-6 py-4">Title & SEO</th>
                    <th scope="col" class="px-6 py-4">Category</th>
                    <th scope="col" class="px-6 py-4">Status</th>
                    <th scope="col" class="px-6 py-4">Date</th>
                    <th scope="col" class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($posts as $post)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4 text-slate-800">
                            @if($post->cover_image)
                                <img src="{{ asset('storage/' . $post->cover_image) }}" class="w-12 h-12 rounded-lg object-cover shrink-0 border border-slate-200" alt="Cover">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center shrink-0 border border-slate-200">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="flex flex-col min-w-0">
                                <span class="font-semibold text-slate-800 truncate" title="{{ $post->title }}">{{ Str::limit($post->title, 40) }}</span>
                                <span class="text-xs text-slate-500 truncate">{{ $post->meta_title ? 'SEO Title Set' : 'No SEO Title' }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($post->category)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                {{ $post->category->name }}
                            </span>
                        @else
                            <span class="text-slate-400 italic">Uncategorized</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($post->is_published)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                Published
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                Draft
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-slate-500 whitespace-nowrap">
                        {{ $post->published_at ? $post->published_at->format('M j, Y') : '—' }}
                    </td>
                    <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </a>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this article?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                        No articles found. Ready to write your first post?
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($posts->hasPages())
    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
        {{ $posts->links() }}
    </div>
    @endif
</div>
@endsection
