@extends('layouts.admin')

@section('title', 'Blog Categories')
@section('page_title', 'Blog Categories')
@section('page_subtitle', 'Manage categories for your blog posts')

@section('content')
<div class="mb-6 flex justify-end">
    <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-semibold transition-colors shadow-sm focus:ring-2 focus:ring-indigo-500/50">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Add Category
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 font-medium">
                <tr>
                    <th scope="col" class="px-6 py-4">Name</th>
                    <th scope="col" class="px-6 py-4">Slug</th>
                    <th scope="col" class="px-6 py-4">Posts Count</th>
                    <th scope="col" class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($categories as $category)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $category->name }}</td>
                    <td class="px-6 py-4"><code>{{ $category->slug }}</code></td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold">{{ $category->posts_count ?? 0 }} posts</span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                        No categories found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($categories->hasPages())
    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
        {{ $categories->links() }}
    </div>
    @endif
</div>
@endsection
