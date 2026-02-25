@php
    $items = [
        ['alt' => 'Portrait with soft key', 'color' => '#e0e7ff', 'src' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2'],
        ['alt' => 'Fashion full‑length', 'color' => '#fde68a', 'src' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772'],
        ['alt' => 'Product flat‑lay', 'color' => '#f5f5f7', 'src' => 'https://images.unsplash.com/photo-1520975232559-17ea5bbdfd1d'],
        ['alt' => 'Corporate interview', 'color' => '#e5e7eb', 'src' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952'],
        ['alt' => 'Podcast corner', 'color' => '#e6f0ff', 'src' => 'https://images.unsplash.com/photo-1511391409289-602dbd83b38c'],
        ['alt' => 'Edit session', 'color' => '#f3e8ff', 'src' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085'],
    ];
    $lqip = function ($c) {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="12"><rect width="100%" height="100%" fill="'.$c.'"/></svg>';
        return 'data:image/svg+xml;charset=UTF-8,'.rawurlencode($svg);
    };
    $srcset = function ($b) {
        $q = fn ($w) => $b.'?auto=format&fit=crop&w='.$w.'&q=60';
        return $q(480).' 480w, '.$q(800).' 800w, '.$q(1200).' 1200w';
    };
@endphp
<section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
        <div class="flex items-center justify-between gap-4">
            <h2 class="text-lg font-semibold tracking-tight sm:text-xl">Featured work</h2>
            <a href="{{ route('pages.gallery') }}" class="hidden text-[11px] font-medium text-[var(--color-text-muted)] hover:text-[var(--color-text-main)] sm:inline">See full gallery</a>
        </div>
        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($items as $it)
                <figure class="group overflow-hidden rounded-2xl border border-[var(--color-border-subtle)] bg-white shadow-sm shadow-black/5 transition hover:-translate-y-1 hover:shadow-md">
                    <img
                        alt="{{ $it['alt'] }}"
                        loading="lazy"
                        decoding="async"
                        class="block w-full aspect-[4/3] object-cover transition duration-700 ease-out group-hover:scale-[1.02]"
                        src="{{ $it['src'] }}?auto=format&fit=crop&w=800&q=70"
                        srcset="{{ $srcset($it['src']) }}"
                        sizes="(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 33vw"
                        style="background: url('{{ $lqip($it['color']) }}') center/cover no-repeat; filter: blur(12px);"
                        onload="this.style.filter='none'; this.style.background='none';"
                    />
                    <figcaption class="p-3 text-[12px] text-[var(--color-text-muted)]">{{ $it['alt'] }}</figcaption>
                </figure>
            @endforeach
        </div>
        <div class="mt-6 flex justify-center">
            <a href="{{ route('pages.gallery') }}" class="inline-flex items-center rounded-full border border-[var(--color-border-subtle)] bg-white px-4 py-2 text-xs font-medium hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)]">Open gallery</a>
        </div>
    </div>
</section>
