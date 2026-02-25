<section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]">
    <div class="mx-auto max-w-6xl overflow-hidden px-4 py-6 sm:px-6">
        <div class="flex items-center justify-between">
            <p class="text-[11px] font-medium uppercase tracking-[0.28em] text-[var(--color-text-muted)]">Trusted by teams</p>
            <span class="hidden text-[11px] text-[var(--color-text-muted)] sm:inline">Creators, brands and agencies</span>
        </div>
        <div class="marquee mt-4">
            <div class="marquee-track">
                @php
                    $logos = [
                        ['bg' => '#e6f0ff', 'label' => 'Creator'],
                        ['bg' => '#fde68a', 'label' => 'Fashion'],
                        ['bg' => '#f5f5f7', 'label' => 'E‑com'],
                        ['bg' => '#e5e7eb', 'label' => 'Corporate'],
                        ['bg' => '#ede9fe', 'label' => 'Agency'],
                        ['bg' => '#fef3c7', 'label' => 'Podcast'],
                    ];
                    $logos = array_merge($logos, $logos);
                @endphp
                @foreach ($logos as $l)
                    <div class="mx-3 inline-flex h-12 w-28 items-center justify-center rounded-full border border-[var(--color-border-subtle)] bg-white text-[11px] font-medium text-[var(--color-text-muted)]" style="--chip: {{ $l['bg'] }}">
                        <span class="mr-2 inline-block h-2.5 w-2.5 rounded-full" style="background: var(--chip)"></span>
                        {{ $l['label'] }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
