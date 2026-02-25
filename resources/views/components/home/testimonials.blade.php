<section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)]">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
        <div class="flex items-center justify-between gap-4">
            <h2 class="text-lg font-semibold tracking-tight sm:text-xl">What teams say</h2>
            <span class="hidden text-[11px] font-medium text-[var(--color-text-muted)] sm:inline">From quick portraits to multi‑day content sprints</span>
        </div>
        <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @php
                $quotes = [
                    ['q' => 'Clean, calm sets and an assistant who kept things moving. Wrapped ahead of schedule.', 'a' => 'Brand team'],
                    ['q' => 'Lighting made skin tones look great on camera. The space is easy to work in.', 'a' => 'Portrait creator'],
                    ['q' => 'We shot interviews and a podcast on the same day without changing locations.', 'a' => 'Agency producer'],
                ];
            @endphp
            @foreach ($quotes as $t)
                <figure class="tilt-card rounded-2xl border border-[var(--color-border-subtle)] bg-white p-5 shadow-sm shadow-black/5">
                    <blockquote class="text-sm text-[var(--color-text-muted)]">{{ $t['q'] }}</blockquote>
                    <figcaption class="mt-3 text-[11px] font-medium text-[var(--color-text-main)]">— {{ $t['a'] }}</figcaption>
                </figure>
            @endforeach
        </div>
    </div>
    </section>
