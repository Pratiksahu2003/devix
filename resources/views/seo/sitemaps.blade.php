@extends('layouts.app')

@section('title', $pageTitle)

@section('seo_head')
    <x-seo.head :meta="$seo['meta']" :schema="$seo['schema_graph']" />
@endsection

@section('content')
<x-seo.master-shell
    title="Sitemap Hub"
    description="All XML sitemaps for search engine crawlers. Generated dynamically from verified JSON datasets — services, locations, industries, guides, and pricing."
    :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'Sitemaps', 'url' => route('seo.sitemaps')]]"
    badge="Crawler Index"
>
    <p class="text-xs text-[var(--color-text-muted)] leading-relaxed mb-4 max-w-2xl">
        Sitemaps are regenerated via <code class="text-[10px] bg-[var(--color-surface-muted)] px-1 rounded">php artisan seo:sitemaps</code>
        and cover 5,500+ studio URLs. Submit the sitemap index to Google Search Console for full coverage.
    </p>

    <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($sitemaps as $type => $file)
            <a href="{{ url('/'.$file) }}" class="flex items-center justify-between rounded-xl border border-[var(--color-border-subtle)] bg-white px-4 py-3 hover:border-[var(--color-brand-lens-blue)] transition group shadow-sm">
                <div>
                    <h2 class="text-xs font-semibold text-[var(--color-text-main)] group-hover:text-[var(--color-brand-lens-blue)] transition">{{ $file }}</h2>
                    <p class="text-[10px] text-[var(--color-text-muted)] mt-0.5">{{ ucfirst(str_replace(['sitemap-', '.xml'], '', $file)) }} pages</p>
                </div>
                <svg class="h-4 w-4 text-[var(--color-text-muted)] group-hover:text-[var(--color-brand-lens-blue)] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
            </a>
        @endforeach
    </div>
</x-seo.master-shell>
@endsection
