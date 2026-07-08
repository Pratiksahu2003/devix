@extends('seo.layout')

@section('content')
<article class="bg-surface text-text-main py-10 px-4 md:px-8">
    <div class="max-w-6xl mx-auto space-y-12">
        @include('seo.components.breadcrumbs', ['page' => $page, 'service' => $service, 'location' => $location])

        @include('seo.components.hero', ['page' => $page, 'service' => $service, 'location' => $location])

        <section class="prose max-w-4xl mx-auto text-lg leading-relaxed text-text-muted bg-surface-muted p-6 rounded-2xl border border-border-subtle reveal-up is-visible">
            <h2 class="text-2xl font-serif text-brand-lens-blue mb-4">DyWix Studio Service Information</h2>
            <p>{{ $page['intro'] }}</p>
        </section>

        @if(!empty($page['sections']['what_is_included']))
            @include('seo.components.service-includes', ['features' => $page['sections']['what_is_included'], 'serviceName' => $service['name'] ?? ''])
        @endif

        @include('seo.components.packages', ['page' => $page, 'service' => $service])

        @if(!empty($page['faqs']))
            @include('seo.components.faq', ['faqs' => $page['faqs']])
        @endif

        @include('seo.components.internal-links', ['links' => $page['internal_links'] ?? []])

        @include('seo.components.cta', ['page' => $page, 'location' => $location])
    </div>
</article>
@endsection
