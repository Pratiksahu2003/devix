@props([
    'plan',
])

@php
    $img = $plan['image'] ?? null;
    $color = $plan['color'] ?? '#e6f0ff';
    $lqip = function ($c) {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="12"><rect width="100%" height="100%" fill="'.$c.'"/></svg>';
        return 'data:image/svg+xml;charset=UTF-8,'.rawurlencode($svg);
    };
    $srcset = function ($b) {
        $q = fn ($w) => $b.'?auto=format&fit=crop&w='.$w.'&q=60';
        return $q(480).' 480w, '.$q(800).' 800w, '.$q(1200).' 1200w';
    };
    $planName = preg_replace('/\\s+·\\s+/',' - ',$plan['name']);
    $href = route('pages.contact').'?plan='.urlencode($planName);
@endphp

<a
    href="{{ $href }}"
    class="group relative flex flex-col overflow-hidden rounded-2xl border border-[var(--color-border-subtle)] bg-white shadow-sm shadow-black/5 transition hover:-translate-y-1 hover:shadow-xl"
>
    <div class="relative aspect-[4/3] overflow-hidden bg-[var(--color-surface-muted)]">
        @if ($img)
            <img
                alt="{{ $plan['badge'] ?? 'Studio plan' }} image"
                loading="lazy"
                decoding="async"
                class="block h-full w-full object-cover transition duration-700 ease-out group-hover:scale-[1.02]"
                src="{{ $img }}?auto=format&fit=crop&w=800&q=70"
                srcset="{{ $srcset($img) }}"
                sizes="(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 33vw"
                style="background: url('{{ $lqip($color) }}') center/cover no-repeat; filter: blur(12px);"
                onload="this.style.filter='none'; this.style.background='none';"
            />
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-brand-lens-blue-soft)] to-transparent opacity-80"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/35 via-transparent to-transparent opacity-0 transition group-hover:opacity-100"></div>
        <span class="absolute left-3 top-3 inline-flex items-center rounded-full bg-black/70 px-2.5 py-1 text-[10px] font-medium text-white">
            {{ $plan['badge'] ?? 'Studio Plan' }}
        </span>
        <span class="pointer-events-none absolute bottom-3 left-3 rounded-full bg-white/80 px-2.5 py-1 text-[10px] font-medium text-[var(--color-text-main)] opacity-0 transition group-hover:opacity-100">
            Get this plan
        </span>
    </div>
    <div class="flex flex-1 flex-col justify-between p-3.5">
        <div class="space-y-1.5">
            <p class="text-[12px] font-medium tracking-tight">
                {{ $plan['name'] }}
            </p>
            <p class="text-[11px] text-[var(--color-text-muted)]">
                {{ $plan['description'] }}
            </p>
        </div>
        <div class="mt-3 flex items-center justify-between text-[12px]">
            <span class="font-semibold">
                ₹{{ $plan['price'] }}
            </span>
            <span class="text-[11px] text-emerald-600">
                {{ $plan['availability'] ?? 'Available 24×7' }}
            </span>
        </div>
    </div>
</a>
