@extends('seo.layout')

@section('content')
<article class="bg-surface text-text-main py-10 px-4 md:px-8">
    <div class="max-w-6xl mx-auto space-y-12">
        @include('seo.components.breadcrumbs', ['page' => $page, 'service' => null, 'location' => $location])

        @include('seo.components.hero', ['page' => $page, 'service' => null, 'location' => $location])

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
