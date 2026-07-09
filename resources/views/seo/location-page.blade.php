@extends('seo.layout')

@section('content')
<article class="bg-surface text-text-main pb-10">
    <!-- 1. Hero Section (Full Width) -->
    @include('seo.components.hero', ['page' => $page, 'service' => null, 'location' => $location])

    <div class="max-w-6xl mx-auto px-4 md:px-8 mt-12 space-y-12">
        <section class="prose max-w-4xl mx-auto text-lg leading-relaxed text-text-muted bg-surface-muted p-6 rounded-2xl border border-border-subtle reveal-up is-visible">
            <h2 class="text-2xl font-serif text-brand-lens-blue mb-4">Location Overview: {{ $location['name'] ?? 'Delhi NCR' }}</h2>
            <p>{{ $page['intro'] }}</p>
        </section>

        @include('seo.components.location-coverage', ['page' => $page, 'location' => $location])

        @if(!empty($page['faqs']))
            @include('seo.components.faq', ['faqs' => $page['faqs']])
        @endif

        @include('seo.components.internal-links', ['links' => $page['internal_links'] ?? []])

        @include('seo.components.cta', ['page' => $page, 'location' => $location])
    </div>
</article>
@endsection
