@props(['items' => []])

<section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold tracking-tight sm:text-xl">Featured work</h2>
                <p class="mt-1 text-xs text-[var(--color-text-muted)]">Recent studio videos from {{ config('company.short_name') }} on YouTube.</p>
            </div>
            <a href="{{ config('company.social.youtube') }}" target="_blank" rel="noopener noreferrer" class="hidden text-[11px] font-medium text-[var(--color-text-muted)] hover:text-[var(--color-text-main)] sm:inline">See YouTube channel</a>
        </div>

        @if(count($items) > 0)
            <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($items as $item)
                    <figure class="group overflow-hidden rounded-2xl border border-[var(--color-border-subtle)] bg-white shadow-sm shadow-black/5 transition hover:-translate-y-1 hover:shadow-md">
                        <div class="relative aspect-[4/3] bg-black">
                            <iframe
                                src="{{ $item['embed_url'] }}"
                                title="{{ $item['caption'] ?? 'DyWix studio video' }}"
                                class="absolute inset-0 h-full w-full"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                                loading="lazy"
                                referrerpolicy="strict-origin-when-cross-origin"
                            ></iframe>
                        </div>

                        <figcaption class="flex items-center justify-between gap-3 p-3 text-[12px] text-[var(--color-text-muted)]">
                            <span>{{ $item['caption'] ?? 'Studio video' }}</span>
                            @if(! empty($item['watch_url']))
                                <a href="{{ $item['watch_url'] }}" target="_blank" rel="noopener noreferrer" class="shrink-0 font-semibold text-[var(--color-brand-lens-blue)] hover:underline">
                                    YouTube
                                </a>
                            @endif
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        @else
            <div class="mt-6 rounded-2xl border border-dashed border-[var(--color-border-subtle)] bg-white px-6 py-10 text-center text-sm text-[var(--color-text-muted)]">
                Studio videos will appear here once Our Work YouTube links are added in the admin panel.
            </div>
        @endif

        <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
            <a href="{{ config('company.social.youtube') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center rounded-full border border-[var(--color-border-subtle)] bg-white px-4 py-2 text-xs font-medium hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)]">
                Watch on YouTube
            </a>
            <a href="{{ route('pages.gallery') }}" class="inline-flex items-center rounded-full border border-[var(--color-border-subtle)] bg-white px-4 py-2 text-xs font-medium hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)]">
                Open gallery
            </a>
        </div>
    </div>
</section>
