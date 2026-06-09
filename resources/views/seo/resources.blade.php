@extends('layouts.app')

@section('title', $pageTitle)

@section('seo_head')
    <x-seo.head :meta="$seo['meta']" :schema="$seo['schema_graph']" />
@endsection

@section('content')
<x-seo.master-shell
    title="Studio Resources"
    description="Your central authority hub for every service, location, industry, guide, and pricing page at {{ config('company.brand') }}. All pages are written and maintained by our in-house production team."
    :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'Resources', 'url' => route('seo.resources')]]"
    badge="Authority Hub"
>
    {{-- E-E-A-T intro --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-6">
        @foreach([
            ['Experience', '500+ production days across podcast, video, photography, and commercial shoots in Delhi NCR.'],
            ['Expertise', 'In-house engineers, sound designers, and lighting specialists on every session.'],
            ['Authoritativeness', 'Trusted by agencies, D2C brands, healthcare, legal, and edtech clients.'],
            ['Trustworthiness', 'Transparent pricing, verified address in Dwarka Sector 13, and real client reviews.'],
        ] as [$title, $body])
            <div class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm">
                <h2 class="text-[10px] font-bold uppercase tracking-wider text-brand-lens-blue mb-1">{{ $title }}</h2>
                <p class="text-xs text-text-muted leading-relaxed">{{ $body }}</p>
            </div>
        @endforeach
    </div>

    <div class="flex flex-wrap gap-2 mb-6">
        <a href="{{ route('seo.directory') }}" class="rounded-lg bg-brand-lens-blue px-4 py-2 text-xs font-bold text-white hover:opacity-90 transition">Browse Full Directory</a>
        <a href="{{ route('seo.sitemaps') }}" class="rounded-lg border border-border-subtle px-4 py-2 text-xs font-semibold text-text-main hover:border-brand-lens-blue transition">Sitemaps</a>
        <a href="{{ route('pages.booking') }}" class="rounded-lg border border-border-subtle px-4 py-2 text-xs font-semibold text-text-main hover:border-brand-lens-blue transition">Book Studio</a>
    </div>

    {{-- Services --}}
    <section class="rounded-xl border border-border-subtle bg-white p-4 sm:p-5 shadow-sm mb-4">
        <h2 class="text-sm font-bold text-text-main mb-3">All Studio Services</h2>
        <p class="text-xs text-text-muted mb-3 leading-relaxed">Each service page covers equipment, process, pricing, FAQs, and location-specific variants across Delhi NCR.</p>
        <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($services as $service)
                <a href="{{ seo_url('service', $service['slug']) }}" class="rounded-lg border border-border-subtle p-3 hover:border-brand-lens-blue transition group">
                    <h3 class="text-xs font-semibold text-text-main group-hover:text-brand-lens-blue">{{ $service['name'] }}</h3>
                    <p class="mt-0.5 text-[10px] text-text-muted line-clamp-2">{{ $service['short_description'] }}</p>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Locations + Localities row --}}
    <div class="grid lg:grid-cols-2 gap-4 mb-4">
        <section class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-sm font-bold text-text-main">Cities</h2>
                <a href="{{ route('seo.locations') }}" class="text-[10px] font-semibold text-brand-lens-blue hover:underline">All locations →</a>
            </div>
            <div class="flex flex-wrap gap-1.5">
                @foreach($cities as $city)
                    <a href="{{ seo_url('city', 'podcast-studio', $city['slug']) }}" class="rounded-md bg-surface-muted px-2 py-1 text-[10px] text-text-muted hover:text-brand-lens-blue transition">{{ $city['name'] }}</a>
                @endforeach
            </div>
        </section>
        <section class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm">
            <h2 class="text-sm font-bold text-text-main mb-3">Popular Localities</h2>
            <div class="flex flex-wrap gap-1.5">
                @foreach($localities as $locality)
                    <a href="{{ seo_url('locality', 'podcast-studio', $locality['slug']) }}" class="rounded-md bg-surface-muted px-2 py-1 text-[10px] text-text-muted hover:text-brand-lens-blue transition">{{ $locality['name'] }}</a>
                @endforeach
            </div>
        </section>
    </div>

    {{-- Industries --}}
    <section class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm mb-4">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-bold text-text-main">Industries</h2>
            <a href="{{ route('seo.industries') }}" class="text-[10px] font-semibold text-brand-lens-blue hover:underline">All industries →</a>
        </div>
        <div class="flex flex-wrap gap-1.5">
            @foreach($industries as $industry)
                <a href="{{ seo_url('industry', 'podcast-studio', $industry['slug']) }}" class="rounded-md bg-surface-muted px-2 py-1 text-[10px] text-text-muted hover:text-brand-lens-blue transition">{{ $industry['name'] }}</a>
            @endforeach
        </div>
    </section>

    {{-- Resource sections --}}
    @foreach($sections as $key => $label)
        <section class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm mb-4">
            <h2 class="text-sm font-bold text-text-main mb-3">{{ $label }}</h2>
            <div class="flex flex-wrap gap-1.5">
                @foreach($blogs->filter(fn($b) => $b['category'] === $key || ($key === 'creator' && in_array($b['category'], ['creator', 'marketing']))) as $blog)
                    <a href="{{ route('blog.show', $blog['slug']) }}" class="rounded-md border border-border-subtle px-2 py-1 text-[10px] text-text-muted hover:border-brand-lens-blue hover:text-brand-lens-blue transition">{{ $blog['title'] }}</a>
                @endforeach
                @if($key === 'pricing')
                    @foreach($cities->take(8) as $city)
                        <a href="{{ seo_url('pricing', 'podcast-studio', $city['slug']) }}" class="rounded-md border border-border-subtle px-2 py-1 text-[10px] text-text-muted hover:border-brand-lens-blue transition">Cost — {{ $city['name'] }}</a>
                    @endforeach
                @endif
                @if($key === 'location')
                    @foreach($cities->take(8) as $city)
                        <a href="{{ seo_url('guide', 'podcast-studio', $city['slug']) }}" class="rounded-md border border-border-subtle px-2 py-1 text-[10px] text-text-muted hover:border-brand-lens-blue transition">Guide — {{ $city['name'] }}</a>
                    @endforeach
                @endif
                @if($key === 'industry')
                    @foreach($industries as $industry)
                        <a href="{{ seo_url('industry', 'podcast-studio', $industry['slug']) }}" class="rounded-md border border-border-subtle px-2 py-1 text-[10px] text-text-muted hover:border-brand-lens-blue transition">For {{ $industry['name'] }}</a>
                    @endforeach
                @endif
                @if($key === 'podcast')
                    <a href="{{ seo_url('service', 'podcast-studio') }}" class="rounded-md border border-border-subtle px-2 py-1 text-[10px] text-text-muted hover:border-brand-lens-blue transition">Podcast Studio Hub</a>
                @endif
                @if($key === 'photography')
                    @foreach($services->filter(fn($s) => ($s['category'] ?? '') === 'photography') as $service)
                        <a href="{{ seo_url('service', $service['slug']) }}" class="rounded-md border border-border-subtle px-2 py-1 text-[10px] text-text-muted hover:border-brand-lens-blue transition">{{ $service['name'] }}</a>
                    @endforeach
                @endif
                @if($key === 'video')
                    @foreach($services->filter(fn($s) => ($s['category'] ?? '') === 'video') as $service)
                        <a href="{{ seo_url('service', $service['slug']) }}" class="rounded-md border border-border-subtle px-2 py-1 text-[10px] text-text-muted hover:border-brand-lens-blue transition">{{ $service['name'] }}</a>
                    @endforeach
                @endif
            </div>
        </section>
    @endforeach

    {{-- Popular --}}
    <section class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm">
        <h2 class="text-sm font-bold text-text-main mb-3">Most Popular Pages</h2>
        <div class="grid gap-1.5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($popularPages as $page)
                <a href="{{ $page['url'] }}" class="text-[11px] text-text-muted hover:text-brand-lens-blue line-clamp-1 transition">{{ $page['title'] }}</a>
            @endforeach
        </div>
    </section>
</x-seo.master-shell>
@endsection
