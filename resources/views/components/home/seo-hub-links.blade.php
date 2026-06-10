@php
    $hubLinks = app(\App\Services\Seo\SeoLinkService::class)->homepageLinks();
@endphp

<section class="border-t border-border-subtle bg-surface-muted py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-text-main">Explore Our Studio Network</h2>
            <p class="mt-2 text-text-muted max-w-2xl mx-auto">Services, locations, and resources across Delhi NCR — your complete studio authority hub.</p>
        </div>

        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($hubLinks as $group => $links)
                <div>
                    <h3 class="text-[11px] font-semibold uppercase tracking-widest text-brand-lens-blue mb-3">{{ $group }}</h3>
                    <ul class="space-y-1.5">
                        @foreach(array_slice($links, 0, 12) as $link)
                            <li>
                                <a href="{{ $link['url'] }}" class="text-sm text-text-muted hover:text-brand-lens-blue transition-colors line-clamp-1">{{ $link['label'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="mt-10 flex flex-wrap justify-center gap-3">
            <a href="{{ route('seo.resources') }}" class="rounded-full bg-brand-lens-blue px-6 py-2.5 text-sm font-semibold text-white hover:opacity-90 transition">All Resources</a>
            <a href="{{ route('seo.directory') }}" class="rounded-full border border-border-subtle px-6 py-2.5 text-sm font-semibold text-text-main hover:border-brand-lens-blue hover:text-brand-lens-blue transition">SEO Directory</a>
            <a href="{{ route('seo.locations') }}" class="rounded-full border border-border-subtle px-6 py-2.5 text-sm font-semibold text-text-main hover:border-brand-lens-blue hover:text-brand-lens-blue transition">All Locations</a>
        </div>
    </div>
</section>
