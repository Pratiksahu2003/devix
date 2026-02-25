@extends('layouts.app')

@section('title', 'Studio Pricing | '.config('company.brand'))

@section('content')
    <x-home.pricing />

    <section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)]">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
            <h2 class="text-base font-semibold tracking-tight">What’s included in every booking</h2>
            @php
                $incImg = ['alt' => 'Organized studio floor with backdrops and lights', 'color' => '#e6f0ff', 'src' => 'https://images.unsplash.com/photo-1518770660439-4636190af475'];
                $lqip = 'data:image/svg+xml;charset=UTF-8,'.rawurlencode('<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"12\"><rect width=\"100%\" height=\"100%\" fill=\"#e6f0ff\"/></svg>');
            @endphp
            <div class="mt-4 grid gap-8 md:grid-cols-2 text-sm text-[var(--color-text-muted)]">
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Production‑ready studio floor</p>
                    <p>Clean, organized sets with access to textured walls and plain backgrounds. Power, stands and basic grip are arranged so you can start lighting immediately.</p>
                    <p class="font-medium text-[var(--color-text-main)]">Assistant on floor</p>
                    <p>Help with lights, stands and resets to keep momentum steady between looks and to reduce time‑overruns that increase cost without improving results.</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Makeup room</p>
                    <p>A dedicated space for wardrobe, makeup and quick resets so talent stays camera‑ready and the floor stays clutter‑free.</p>
                    <p class="font-medium text-[var(--color-text-main)]">Flexible slots</p>
                    <p>24×7 availability so you can schedule early starts or late finishes around your crew and client availability.</p>
                </div>
                <div class="md:col-span-2">
                    <img
                        alt="{{ $incImg['alt'] }}"
                        loading="lazy"
                        decoding="async"
                        class="block w-full rounded-2xl border border-[var(--color-border-subtle)] object-cover"
                        src="{{ $incImg['src'] }}?auto=format&fit=crop&w=1200&q=70"
                        srcset="{{ $incImg['src'] }}?auto=format&fit=crop&w=800&q=60 800w, {{ $incImg['src'] }}?auto=format&fit=crop&w=1200&q=60 1200w, {{ $incImg['src'] }}?auto=format&fit=crop&w=1600&q=60 1600w"
                        sizes="100vw"
                        style="background: url('{{ $lqip }}') center/cover no-repeat; filter: blur(12px);"
                        onload="this.style.filter='none'; this.style.background='none';"
                    />
                </div>
            </div>
        </div>
    </section>

    <section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
            <h2 class="text-base font-semibold tracking-tight">Examples and typical use cases</h2>
            @php
                $examples = [
                    ['title' => 'Pay per hour', 'desc' => 'Best for quick portrait updates, small catalogue sets or one‑off corporate interviews. Book the minimum and extend by the hour if you need more time.', 'src' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2', 'color' => '#e6f0ff'],
                    ['title' => 'Pay per day', 'desc' => 'Ideal for lookbooks, product batches and content sprints where volume and variations matter. The day rate reduces per‑frame cost and planning friction.', 'src' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772', 'color' => '#fde68a'],
                    ['title' => 'All in', 'desc' => 'For campaigns and long‑form content where you need the entire space, maximum lighting options and a clear run‑of‑show without juggling add‑ons.', 'src' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952', 'color' => '#e5e7eb'],
                ];
                $lqipMaker = fn($c) => 'data:image/svg+xml;charset=UTF-8,'.rawurlencode('<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"12\"><rect width=\"100%\" height=\"100%\" fill=\"'.$c.'\"/></svg>');
            @endphp
            <div class="mt-6 grid gap-8 lg:grid-cols-3 text-sm text-[var(--color-text-muted)]">
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Pay per hour</p>
                    <p>Best for quick portrait updates, small catalogue sets or one‑off corporate interviews. Book the minimum and extend by the hour if you need more time.</p>
                    <img alt="{{ $examples[0]['title'] }}" class="mt-2 rounded-xl border border-[var(--color-border-subtle)]"
                        src="{{ $examples[0]['src'] }}?auto=format&fit=crop&w=800&q=70"
                        style="background:url('{{ $lqipMaker($examples[0]['color']) }}') center/cover no-repeat; filter: blur(12px);" onload="this.style.filter='none'; this.style.background='none';" />
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Pay per day</p>
                    <p>Ideal for lookbooks, product batches and content sprints where volume and variations matter. The day rate reduces per‑frame cost and planning friction.</p>
                    <img alt="{{ $examples[1]['title'] }}" class="mt-2 rounded-xl border border-[var(--color-border-subtle)]"
                        src="{{ $examples[1]['src'] }}?auto=format&fit=crop&w=800&q=70"
                        style="background:url('{{ $lqipMaker($examples[1]['color']) }}') center/cover no-repeat; filter: blur(12px);" onload="this.style.filter='none'; this.style.background='none';" />
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">All in</p>
                    <p>For campaigns and long‑form content where you need the entire space, maximum lighting options and a clear run‑of‑show without juggling add‑ons.</p>
                    <img alt="{{ $examples[2]['title'] }}" class="mt-2 rounded-xl border border-[var(--color-border-subtle)]"
                        src="{{ $examples[2]['src'] }}?auto=format&fit=crop&w=800&q=70"
                        style="background:url('{{ $lqipMaker($examples[2]['color']) }}') center/cover no-repeat; filter: blur(12px);" onload="this.style.filter='none'; this.style.background='none';" />
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[var(--color-surface-muted)]">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
            <h2 class="text-base font-semibold tracking-tight">FAQs about pricing</h2>
            <div class="mt-4 space-y-4 text-sm text-[var(--color-text-muted)]">
                <div>
                    <p class="font-medium text-[var(--color-text-main)]">What’s the minimum booking?</p>
                    <p>Three hours. You can extend in hourly blocks or upgrade to a day or all‑in package if your shot list expands.</p>
                </div>
                <div>
                    <p class="font-medium text-[var(--color-text-main)]">How do add‑ons work?</p>
                    <p>Add podcast mics, constant lights or the edit room as needed. We keep add‑ons straightforward so budgets stay predictable, not surprising.</p>
                </div>
                <div>
                    <p class="font-medium text-[var(--color-text-main)]">Do you charge extra for late hours?</p>
                    <p>Slots are available 24×7. For significantly late wraps, we plan buffer time so teams can pack down safely without rushing.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
