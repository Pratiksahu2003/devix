@extends('layouts.app')

@section('title', $pageTitle)

@section('seo_head')
    <x-seo.head :meta="$seo['meta']" :schema="$seo['schema_graph']" />
@endsection

@section('content')
<x-seo.master-shell
    title="Studio Locations — Delhi NCR"
    description="Browse all city, locality, and landmark pages for {{ config('company.brand') }} studio services across the National Capital Region. Each page includes travel directions, pricing, and service-specific content."
    :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'Locations', 'url' => route('seo.locations')]]"
    badge="Location Hub"
>
    <p class="text-xs text-[var(--color-text-muted)] leading-relaxed mb-4 max-w-3xl">
        Our studio is based in Dwarka Sector 13, Delhi — centrally accessible from Gurgaon, Noida, Faridabad, and all major NCR cities.
        Location pages include metro access, drive times, parking info, and local pricing for every service.
    </p>

    @foreach($services as $service)
        <section class="rounded-xl border border-[var(--color-border-subtle)] bg-white p-4 shadow-sm mb-4">
            <h2 class="text-sm font-bold text-[var(--color-text-main)] mb-3">{{ $service['name'] }}</h2>

            <h3 class="text-[10px] font-bold uppercase tracking-wider text-[var(--color-brand-lens-blue)] mb-2">Cities</h3>
            <div class="flex flex-wrap gap-1.5 mb-4">
                @foreach($cities as $city)
                    <a href="{{ seo_url('city', $service['slug'], $city['slug']) }}" class="rounded-md bg-[var(--color-surface-muted)] px-2 py-1 text-[10px] text-[var(--color-text-muted)] hover:text-[var(--color-brand-lens-blue)] transition">{{ $city['name'] }}</a>
                @endforeach
            </div>

            <h3 class="text-[10px] font-bold uppercase tracking-wider text-[var(--color-brand-lens-blue)] mb-2">Localities</h3>
            <div class="flex flex-wrap gap-1.5 mb-4">
                @foreach($localities->take(30) as $locality)
                    <a href="{{ seo_url('locality', $service['slug'], $locality['slug']) }}" class="rounded-md bg-[var(--color-surface-muted)] px-2 py-1 text-[10px] text-[var(--color-text-muted)] hover:text-[var(--color-brand-lens-blue)] transition">{{ $locality['name'] }}</a>
                @endforeach
            </div>

            <h3 class="text-[10px] font-bold uppercase tracking-wider text-[var(--color-brand-lens-blue)] mb-2">Landmarks</h3>
            <div class="flex flex-wrap gap-1.5">
                @foreach($landmarks->take(20) as $landmark)
                    <a href="{{ seo_url('landmark', $service['slug'], $landmark['slug']) }}" class="rounded-md bg-[var(--color-surface-muted)] px-2 py-1 text-[10px] text-[var(--color-text-muted)] hover:text-[var(--color-brand-lens-blue)] transition">Near {{ $landmark['name'] }}</a>
                @endforeach
            </div>
        </section>
    @endforeach
</x-seo.master-shell>
@endsection
