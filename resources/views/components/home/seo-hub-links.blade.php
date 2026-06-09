@php
    $hubLinks = app(\App\Services\Seo\SeoLinkService::class)->homepageLinks();
@endphp

<section class="border-t border-white/10 bg-black/40 py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-white">Explore Our Studio Network</h2>
            <p class="mt-2 text-gray-400 max-w-2xl mx-auto">Services, locations, and resources across Delhi NCR — your complete studio authority hub.</p>
        </div>

        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($hubLinks as $group => $links)
                <div>
                    <h3 class="text-[11px] font-semibold uppercase tracking-widest text-[var(--color-brand-lens-blue)] mb-3">{{ $group }}</h3>
                    <ul class="space-y-1.5">
                        @foreach(array_slice($links, 0, 12) as $link)
                            <li>
                                <a href="{{ $link['url'] }}" class="text-sm text-gray-400 hover:text-white transition-colors line-clamp-1">{{ $link['label'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="mt-10 flex flex-wrap justify-center gap-3">
            <a href="{{ route('seo.resources') }}" class="rounded-full bg-[var(--color-brand-lens-blue)] px-6 py-2.5 text-sm font-semibold text-white hover:opacity-90 transition">All Resources</a>
            <a href="{{ route('seo.directory') }}" class="rounded-full border border-white/20 px-6 py-2.5 text-sm font-semibold text-white hover:bg-white/10 transition">SEO Directory</a>
            <a href="{{ route('seo.locations') }}" class="rounded-full border border-white/20 px-6 py-2.5 text-sm font-semibold text-white hover:bg-white/10 transition">All Locations</a>
        </div>
    </div>
</section>
