@extends('layouts.admin')

@section('title', 'Edit Image')
@section('page_title', 'Edit Image')
@section('page_subtitle', 'Update alt text, sort order, or replace image')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

    <div class="p-8 border-b border-slate-100 relative z-10 text-left">
        <h3 class="text-xl font-bold text-slate-800">Edit Gallery Image</h3>
        <p class="text-sm text-slate-500 mt-1.5 max-w-2xl">Update alt text and order, or replace the file.</p>
    </div>

    <div class="p-8 relative z-10 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
            <div class="rounded-2xl overflow-hidden border border-slate-200 bg-black">
                <img
                    src="{{ asset('storage/' . $image->image_path) }}"
                    alt="{{ $image->alt_text ?? 'Our Work' }}"
                    class="w-full aspect-video object-cover"
                />
            </div>

            <form method="POST" action="{{ route('admin.dashboard.our-work.images.update', $image->id) }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('put')

                <div class="space-y-2">
                    <label for="alt_text" class="block text-sm font-semibold text-slate-700">Alt Text</label>
                    <input
                        type="text"
                        name="alt_text"
                        id="alt_text"
                        value="{{ old('alt_text', $image->alt_text ?? '') }}"
                        class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors text-sm"
                        placeholder="Optional description for accessibility"
                    />
                </div>

                <div class="space-y-2">
                    <label for="sort_order" class="block text-sm font-semibold text-slate-700">Sort Order</label>
                    <input
                        type="number"
                        name="sort_order"
                        id="sort_order"
                        min="0"
                        value="{{ old('sort_order', $image->sort_order) }}"
                        class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors text-sm"
                    />
                </div>

                <div class="space-y-2">
                    <label for="image" class="block text-sm font-semibold text-slate-700">Replace Image (Optional)</label>
                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/*"
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-colors"
                    />
                </div>

                <div class="flex flex-wrap gap-3 items-center">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Update Image
                    </button>
                    <a href="{{ route('admin.dashboard.our-work.images.show') }}"
                       class="inline-flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-900 font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm border border-slate-200">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

