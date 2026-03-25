@extends('layouts.admin')

@section('title', 'Our Work Images')
@section('page_title', 'Our Work Images')
@section('page_subtitle', 'View uploaded gallery images')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

    <div class="p-8 border-b border-slate-100 relative z-10 text-left">
        <div class="flex items-start justify-between gap-4 flex-wrap">
            <div>
                <h3 class="text-xl font-bold text-slate-800">Our Work Images</h3>
                <p class="text-sm text-slate-500 mt-1.5 max-w-2xl">Uploaded gallery images.</p>
            </div>

            <a href="{{ route('admin.dashboard.our-work.images.create') }}"
               class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Upload Image
            </a>
        </div>
    </div>

    <div class="p-8 relative z-10 space-y-6">
        @if(isset($ourWorkImages) && $ourWorkImages->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach($ourWorkImages as $img)
                    <div class="relative rounded-xl overflow-hidden border border-slate-200 bg-white">
                        <img
                            src="{{ asset('storage/' . $img->image_path) }}"
                            alt="{{ $img->alt_text ?? 'Our Work' }}"
                            class="w-full h-24 object-cover"
                            loading="lazy"
                        />

                        <form method="POST" action="{{ route('admin.dashboard.our-work.images.destroy', $img->id) }}" class="absolute top-2 right-2">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="rounded-full bg-red-600 hover:bg-red-700 text-white w-8 h-8 flex items-center justify-center text-sm shadow-md"
                                onclick="return confirm('Delete this image?')"
                                title="Delete image"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </form>

                        <a href="{{ route('admin.dashboard.our-work.images.edit', $img->id) }}"
                           class="absolute top-2 left-2 rounded-full bg-slate-900/70 hover:bg-slate-900 text-white w-8 h-8 flex items-center justify-center shadow-md"
                           title="Edit image">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 3.5a2.121 2.121 0 013 3L7 18l-4 1 1-4 12.5-12.5z"/></svg>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-slate-500">No images uploaded yet.</p>
        @endif
    </div>
</div>
@endsection

