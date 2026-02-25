@extends('layouts.app')

@section('title', 'Podcast Studio on Rent in Delhi NCR | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Book a dedicated podcast studio on rent in Delhi NCR at {{ config('company.brand') }}, with dynamic microphones, treated lighting and comfortable seating for podcasts, talk shows and panel discussions." />
@endsection

@section('content')
    <section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-14">
            <h1 class="text-2xl font-semibold tracking-tight sm:text-3xl">
                Podcast Studio on Rent
            </h1>
            <p class="mt-3 max-w-2xl text-sm leading-relaxed text-[var(--color-text-muted)]">
                Record podcasts, talk shows, and panel discussions in a dedicated podcast corner equipped with dynamic
                microphones, treated lighting, and comfortable seating – ready for creators and brands alike.
            </p>

            <div class="mt-8 grid gap-8 lg:grid-cols-2">
                <div class="space-y-4">
                    <h2 class="text-base font-semibold tracking-tight">
                        Designed for clear, comfortable conversations
                    </h2>
                    <ul class="space-y-2 text-sm text-[var(--color-text-muted)]">
                        <li>• Seated layout that works for 1–4 speakers on camera or audio‑only.</li>
                        <li>• Lighting that flatters skin tones and keeps the focus on your guests.</li>
                        <li>• Background options suitable for brand podcasts, creator shows and panels.</li>
                        <li>• Easy access to the main studio floor for photo or video content on the same day.</li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h2 class="text-base font-semibold tracking-tight">
                        Podcast audio &amp; equipment
                    </h2>
                    <ul class="space-y-2 text-sm text-[var(--color-text-muted)]">
                        <li>• Set of dynamic microphones tuned for speech and conversation.</li>
                        <li>• 3× Godox 1×1 LED panels with cutters and diffusers to control spill and shadows.</li>
                        <li>• Light assistant to help you shape the look of your show.</li>
                        <li>• Makeup room access so guests can freshen up before recording.</li>
                    </ul>
                </div>
            </div>

            <div id="faqs" class="mt-10 border-t border-[var(--color-border-subtle)] pt-8">
                <h2 class="text-base font-semibold tracking-tight">
                    FAQs about our podcast studio
                </h2>
                <div class="mt-4 space-y-4 text-sm text-[var(--color-text-muted)]">
                    <div>
                        <p class="font-medium text-[var(--color-text-main)]">
                            How many people can we comfortably record at once?
                        </p>
                        <p class="mt-1">
                            The podcast setup is ideal for 2–4 people on mic at the same time, depending on your preferred
                            seating layout and framing.
                        </p>
                    </div>
                    <div>
                        <p class="font-medium text-[var(--color-text-main)]">
                            Do you handle recording and editing?
                        </p>
                        <p class="mt-1">
                            Most teams bring their own recorders, laptops and workflows. If you need end‑to‑end recording
                            and editing support, we can connect you with trusted audio and video partners.
                        </p>
                    </div>
                    <div>
                        <p class="font-medium text-[var(--color-text-main)]">
                            Can we film the podcast for YouTube or reels?
                        </p>
                        <p class="mt-1">
                            Absolutely. Many creators record both audio and video in the space, using a mix of static and
                            moving cameras. The lighting and background are designed to look great on YouTube, reels and
                            shorts.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
        $faq = [
            [
                'q' => 'How many people can we comfortably record at once?',
                'a' => 'The podcast setup is ideal for 2–4 people on mic at the same time, depending on your preferred seating layout and framing.',
            ],
            [
                'q' => 'Do you handle recording and editing?',
                'a' => 'Most teams bring their own recorders, laptops and workflows. If you need end‑to‑end recording and editing support, we can connect you with trusted audio and video partners.',
            ],
            [
                'q' => 'Can we film the podcast for YouTube or reels?',
                'a' => 'Absolutely. Many creators record both audio and video in the space, using a mix of static and moving cameras. The lighting and background are designed to look great on YouTube, reels and shorts.',
            ],
        ];
        $faqLd = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($faq)->map(function ($item) {
                return [
                    '@type' => 'Question',
                    'name' => $item['q'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $item['a'],
                    ],
                ];
            })->toArray(),
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($faqLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>

    @php
        $hero = [
            'alt' => 'Podcast corner with dynamic microphones and soft LED lights',
            'color' => '#e6f0ff',
            'src' => 'https://images.unsplash.com/photo-1519046904884-53103b34b206',
        ];
        $lqip = 'data:image/svg+xml;charset=UTF-8,'.rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="20" height="12"><rect width="100%" height="100%" fill="'.$hero['color'].'"/></svg>');
    @endphp
    <section class="bg-[var(--color-surface-muted)]">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
            <img
                alt="{{ $hero['alt'] }}"
                loading="lazy"
                decoding="async"
                class="block w-full rounded-2xl border border-[var(--color-border-subtle)] object-cover"
                src="{{ $hero['src'] }}?auto=format&fit=crop&w=1200&q=70"
                srcset="{{ $hero['src'] }}?auto=format&fit=crop&w=800&q=60 800w, {{ $hero['src'] }}?auto=format&fit=crop&w=1200&q=60 1200w, {{ $hero['src'] }}?auto=format&fit=crop&w=1600&q=60 1600w"
                sizes="100vw"
                style="background: url('{{ $lqip }}') center/cover no-repeat; filter: blur(12px);"
                onload="this.style.filter='none'; this.style.background='none';"
            />
        </div>
    </section>

    <section class="border-t border-[var(--color-border-subtle)] bg-[var(--color-surface)]">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
            <h2 class="text-base font-semibold tracking-tight">Best practices for great‑sounding shows</h2>
            <div class="mt-4 grid gap-8 md:grid-cols-2 text-sm text-[var(--color-text-muted)]">
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Mic technique</p>
                    <p>Coach guests to keep a consistent distance and angle to the mic. Use simple hand signals to pause and resume between topics.</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Edit‑friendly takes</p>
                    <p>Record room tone and clap syncs for each camera change to speed up assembly and noise reduction later.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
