@extends('layouts.app')

@section('title', $pageTitle)

@section('seo_head')
    <x-seo.head :meta="$seo['meta']" :schema="$seo['schema_graph']" />
@endsection

@section('content')
<x-seo.master-shell
    title="Studio Guides"
    description="Location-specific guides, equipment tips, and production workflows for every studio service. Written by our in-house team based on 500+ production days."
    :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'Guides', 'url' => route('seo.guides')]]"
    badge="Guide Hub"
>
    <p class="text-xs text-text-muted leading-relaxed mb-4 max-w-3xl">
        Guides cover what to expect at our studio, how to prepare for your shoot, equipment recommendations, and location-specific travel tips.
        Each guide is reviewed quarterly by our production lead.
    </p>

    <section class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm mb-4">
        <h2 class="text-sm font-bold text-text-main mb-3">Location Guides</h2>
        @foreach($services->take(5) as $service)
            <h3 class="text-[10px] font-bold uppercase tracking-wider text-brand-lens-blue mb-2 mt-3 first:mt-0">{{ $service['name'] }}</h3>
            <div class="flex flex-wrap gap-1.5 mb-2">
                @foreach($cities as $city)
                    <a href="{{ seo_url('guide', $service['slug'], $city['slug']) }}" class="rounded-md bg-surface-muted px-2 py-1 text-[10px] text-text-muted hover:text-brand-lens-blue transition">{{ $city['name'] }}</a>
                @endforeach
            </div>
        @endforeach
    </section>

    <section class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm">
        <h2 class="text-sm font-bold text-text-main mb-3">Articles &amp; Tutorials</h2>
        <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($blogs as $blog)
                <a href="{{ route('blog.show', $blog['slug']) }}" class="rounded-lg border border-border-subtle p-3 hover:border-brand-lens-blue transition group">
                    <span class="text-[9px] font-bold uppercase tracking-wider text-brand-lens-blue">{{ $blog['category'] }}</span>
                    <h3 class="mt-1 text-xs font-semibold text-text-main group-hover:text-brand-lens-blue">{{ $blog['title'] }}</h3>
                    <p class="mt-1 text-[10px] text-text-muted line-clamp-2">{{ $blog['excerpt'] }}</p>
                </a>
            @endforeach
        </div>
    </section>
</x-seo.master-shell>
@endsection
