@extends('layouts.app')

@section('title', $title)

@section('seo_head')
    <x-seo.head :meta="$seo['meta']" :schema="$seo['schema_graph']" />
    @if($lastPage > 1 && $page > 1)
        <link rel="prev" href="{{ route('seo.directory', array_filter(['q' => $query, 'type' => $type, 'category' => $category, 'page' => $page - 1])) }}" />
    @endif
    @if($lastPage > 1 && $page < $lastPage)
        <link rel="next" href="{{ route('seo.directory', array_filter(['q' => $query, 'type' => $type, 'category' => $category, 'page' => $page + 1])) }}" />
    @endif
@endsection

@section('content')
<x-seo.master-shell
    title="SEO Directory"
    description="{{ number_format($total) }} indexed studio pages — services, cities, localities, landmarks, industries, pricing, and guides. Search and filter the full URL map."
    :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'SEO Directory', 'url' => route('seo.directory')]]"
    badge="Full Index"
>
    <p class="text-xs text-[var(--color-text-muted)] leading-relaxed mb-4 max-w-3xl">
        This directory is generated from verified JSON datasets maintained by {{ config('company.brand') }}.
        Every URL maps to a real service offering at our Dwarka studio. Use filters to find location-specific pages, industry variants, or pricing guides.
    </p>

    <form method="GET" action="{{ route('seo.directory') }}" class="mb-4 flex flex-wrap gap-2">
        <input type="text" name="q" value="{{ $query }}" placeholder="Search pages..."
            class="h-9 rounded-lg border border-[var(--color-border-subtle)] bg-white px-3 text-xs text-[var(--color-text-main)] placeholder-gray-400 focus:border-[var(--color-brand-lens-blue)] focus:outline-none min-w-[180px] flex-1 max-w-sm">
        <select name="type" class="h-9 rounded-lg border border-[var(--color-border-subtle)] bg-white px-2 text-xs text-[var(--color-text-main)] focus:outline-none">
            <option value="">All Types</option>
            @foreach($types as $t)
                <option value="{{ $t }}" @selected($type === $t)>{{ ucfirst($t) }}</option>
            @endforeach
        </select>
        <select name="category" class="h-9 rounded-lg border border-[var(--color-border-subtle)] bg-white px-2 text-xs text-[var(--color-text-main)] focus:outline-none">
            <option value="">All Categories</option>
            @foreach($categories as $c)
                <option value="{{ $c }}" @selected($category === $c)>{{ $c }}</option>
            @endforeach
        </select>
        <button type="submit" class="h-9 rounded-lg bg-[var(--color-brand-lens-blue)] px-4 text-xs font-bold text-white hover:opacity-90 transition">Filter</button>
        @if($query || $type || $category)
            <a href="{{ route('seo.directory') }}" class="h-9 inline-flex items-center rounded-lg border border-[var(--color-border-subtle)] px-3 text-xs text-[var(--color-text-muted)] hover:text-[var(--color-text-main)] transition">Clear</a>
        @endif
    </form>

    <div class="rounded-xl border border-[var(--color-border-subtle)] bg-white shadow-sm overflow-hidden">
        @forelse($pages as $p)
            <a href="{{ $p['url'] }}" class="flex items-center justify-between px-4 py-2.5 border-b border-[var(--color-border-subtle)] last:border-0 hover:bg-[var(--color-surface-muted)] transition group">
                <span class="text-xs text-[var(--color-text-main)] group-hover:text-[var(--color-brand-lens-blue)] transition">{{ $p['title'] }}</span>
                <span class="text-[9px] font-semibold uppercase tracking-wider text-[var(--color-text-muted)] shrink-0 ml-3">{{ $p['category'] }}</span>
            </a>
        @empty
            <p class="text-xs text-[var(--color-text-muted)] text-center py-10">No pages match your filters.</p>
        @endforelse
    </div>

    @if($lastPage > 1)
    <nav class="mt-4 flex items-center justify-center gap-2" aria-label="Pagination">
        @if($page > 1)
            <a href="{{ route('seo.directory', array_filter(['q' => $query, 'type' => $type, 'category' => $category, 'page' => $page - 1])) }}" class="rounded-lg border border-[var(--color-border-subtle)] px-3 py-1.5 text-xs text-[var(--color-text-muted)] hover:text-[var(--color-text-main)] transition">Previous</a>
        @endif
        <span class="text-xs text-[var(--color-text-muted)]">Page {{ $page }} of {{ $lastPage }}</span>
        @if($page < $lastPage)
            <a href="{{ route('seo.directory', array_filter(['q' => $query, 'type' => $type, 'category' => $category, 'page' => $page + 1])) }}" class="rounded-lg border border-[var(--color-border-subtle)] px-3 py-1.5 text-xs text-[var(--color-text-muted)] hover:text-[var(--color-text-main)] transition">Next</a>
        @endif
    </nav>
    @endif
</x-seo.master-shell>
@endsection
