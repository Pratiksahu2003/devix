@extends('seo.layout')

@section('content')
<article class="bg-surface text-text-main py-10 px-4 md:px-8">
    <div class="max-w-6xl mx-auto space-y-12">
        <!-- 1. Breadcrumbs -->
        @include('seo.components.breadcrumbs', ['page' => $page, 'service' => $service, 'location' => $location])

        <!-- 2. Hero Section -->
        @include('seo.components.hero', ['page' => $page, 'service' => $service, 'location' => $location])

        <!-- 3. Intro Section -->
        <section class="prose max-w-4xl mx-auto text-lg leading-relaxed text-text-muted bg-surface-muted p-6 rounded-2xl border border-border-subtle reveal-up is-visible">
            <h2 class="text-2xl font-serif text-brand-lens-blue mb-4">Professional Studio Solutions in {{ $location['name'] ?? 'Delhi NCR' }}</h2>
            <p>{{ $page['intro'] }}</p>
        </section>

        <!-- 4. Features/Included Features -->
        @if(!empty($page['sections']['what_is_included']))
            @include('seo.components.service-includes', ['features' => $page['sections']['what_is_included'], 'serviceName' => $service['name'] ?? ''])
        @endif

        <!-- 5. Who is it for -->
        @if(!empty($page['sections']['who_is_it_for']))
            <section class="space-y-6 reveal-up is-visible">
                <div class="text-center max-w-2xl mx-auto">
                    <h2 class="text-3xl font-serif text-brand-lens-blue">Ideal For Creators & Businesses</h2>
                    <p class="text-text-muted">Tailored to meet the high standards of modern digital production in {{ $location['name'] ?? 'Delhi NCR' }}.</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-w-4xl mx-auto">
                    @foreach($page['sections']['who_is_it_for'] as $target)
                        <div class="p-4 bg-white border border-border-subtle rounded-xl text-center shadow-sm">
                            <span class="font-semibold text-text-main">{{ $target }}</span>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- 6. Local Area Coverage -->
        @include('seo.components.location-coverage', ['page' => $page, 'location' => $location])

        <!-- 7. Packages & Pricing -->
        @include('seo.components.packages', ['page' => $page, 'service' => $service])

        <!-- 8. Use Cases -->
        @if(!empty($page['sections']['use_cases']))
            <section class="bg-surface-muted p-8 rounded-2xl border border-border-subtle space-y-6 reveal-up is-visible">
                <div class="text-center max-w-2xl mx-auto">
                    <h2 class="text-3xl font-serif text-brand-lens-blue">Production Use Cases</h2>
                    <p class="text-text-muted">What you can record or shoot at DyWix Studio.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                    @foreach($page['sections']['use_cases'] as $case)
                        <div class="flex items-start space-x-3 bg-white p-4 rounded-xl border border-border-subtle">
                            <div class="w-6 h-6 rounded-full bg-brand-lens-blue-soft text-brand-lens-blue flex items-center justify-center font-bold text-sm">✓</div>
                            <span class="text-text-main font-medium">{{ $case }}</span>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- 9. FAQ Section -->
        @if(!empty($page['faqs']))
            @include('seo.components.faq', ['faqs' => $page['faqs']])
        @endif

        <!-- 10. Internal Links Grid -->
        @include('seo.components.internal-links', ['links' => $page['internal_links'] ?? []])

        <!-- 11. Final Call To Action -->
        @include('seo.components.cta', ['page' => $page, 'location' => $location])
    </div>
</article>
@endsection
