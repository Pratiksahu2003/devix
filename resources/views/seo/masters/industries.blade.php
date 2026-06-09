@extends('layouts.app')

@section('title', $pageTitle)

@section('seo_head')
    <x-seo.head :meta="$seo['meta']" :schema="$seo['schema_graph']" />
@endsection

@section('content')
<x-seo.master-shell
    title="Studio Services by Industry"
    description="Tailored content production for every industry — from healthcare and legal to creators and corporates. Each industry page includes use cases, compliance notes, and relevant equipment."
    :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'Industries', 'url' => route('seo.industries')]]"
    badge="Industry Hub"
>
    <p class="text-xs text-[var(--color-text-muted)] leading-relaxed mb-4 max-w-3xl">
        Industry-specific pages are written by our production team with real case studies and compliance-aware workflows.
        Whether you need patient education videos, legal depositions, or product launches — each page explains how our studio adapts to your sector.
    </p>

    @foreach($services as $service)
        <section class="rounded-xl border border-[var(--color-border-subtle)] bg-white p-4 shadow-sm mb-4">
            <h2 class="text-sm font-bold text-[var(--color-text-main)] mb-3">{{ $service['name'] }}</h2>
            <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($industries as $industry)
                    <a href="{{ seo_url('industry', $service['slug'], $industry['slug']) }}" class="rounded-lg border border-[var(--color-border-subtle)] p-3 hover:border-[var(--color-brand-lens-blue)] transition group">
                        <h3 class="text-xs font-semibold text-[var(--color-text-main)] group-hover:text-[var(--color-brand-lens-blue)]">{{ $service['name'] }} for {{ $industry['name'] }}</h3>
                        <p class="mt-1 text-[10px] text-[var(--color-text-muted)] line-clamp-2">{{ $industry['description'] }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    @endforeach
</x-seo.master-shell>
@endsection
