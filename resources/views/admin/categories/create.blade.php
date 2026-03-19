@extends('layouts.admin')

@section('title', 'Add Category')
@section('page_title', 'Add Category')
@section('page_subtitle', 'Create a new blog category')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Categories
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden max-w-2xl">
    <div class="p-6 sm:p-8 border-b border-slate-100">
        <h3 class="text-xl font-bold text-slate-800">Category Details</h3>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="p-6 sm:p-8 space-y-6" x-data="{
        name: '{{ old('name') }}',
        slug: '{{ old('slug') }}',
        autoSync: {{ old('slug') ? 'false' : 'true' }},
        generateSlug(text) {
            return text.toString().trim().toLowerCase()
                .replace(/\s+/g, '-')           
                .replace(/[^\w\-]+/g, '')       
                .replace(/\-\-+/g, '-')         
                .replace(/^-+/, '')             
                .replace(/-+$/, '');            
        }
    }">
        @csrf

        <div class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Name</label>
                <input type="text" name="name" id="name" x-model="name" @input="if(autoSync) slug = generateSlug(name)" class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('name') ? 'border-red-300 focus:ring-red-500' : 'border-slate-300 focus:border-indigo-500 focus:ring-indigo-500/20' }} focus:ring-2 focus:outline-none transition-colors" required>
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="slug" class="block text-sm font-semibold text-slate-700">Slug</label>
                    <label class="flex items-center gap-1.5 text-xs text-slate-500 cursor-pointer hover:text-indigo-600 transition-colors">
                        <input type="checkbox" x-model="autoSync" class="w-3.5 h-3.5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                        Auto-sync with name
                    </label>
                </div>
                <input type="text" name="slug" id="slug" x-model="slug" @input="autoSync = false" class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('slug') ? 'border-red-300 focus:ring-red-500' : 'border-slate-300 focus:border-indigo-500 focus:ring-indigo-500/20' }} focus:ring-2 focus:outline-none transition-colors placeholder:text-slate-400" placeholder="e.g. tech-news">
                @error('slug')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700 mb-1.5">Description <span class="text-slate-400 font-normal">(Optional)</span></label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('description') ? 'border-red-300 focus:ring-red-500' : 'border-slate-300 focus:border-indigo-500 focus:ring-indigo-500/20' }} focus:ring-2 focus:outline-none transition-colors">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="pt-4 flex justify-end">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl font-semibold transition-colors shadow-sm focus:ring-2 focus:ring-indigo-500/50">
                Save Category
            </button>
        </div>
    </form>
</div>
@endsection
