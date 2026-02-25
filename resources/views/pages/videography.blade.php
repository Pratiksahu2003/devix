@extends('layouts.app')

@section('title', 'Videography Studio on Rent in Delhi NCR | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Book a 24×7 videography studio on rent in Delhi NCR at {{ config('company.brand') }}, ideal for interviews, brand films, YouTube content, reels and corporate shoots with controlled lighting and flexible sets." />
@endsection

@section('content')
    <section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-14">
            <h1 class="text-2xl font-semibold tracking-tight sm:text-3xl">
                Videography Studio on Rent
            </h1>
            <p class="mt-3 max-w-2xl text-sm leading-relaxed text-[var(--color-text-muted)]">
                A 24×7 videography studio on rent in Delhi NCR for interviews, brand films, reels, and long‑form content,
                with controlled lighting, flexible sets, and an on‑site team to support your shoot.
            </p>

            <div class="mt-8 grid gap-8 lg:grid-cols-2">
                <div class="space-y-4">
                    <h2 class="text-base font-semibold tracking-tight">
                        Built for interviews, reels and long‑form video
                    </h2>
                    <ul class="space-y-2 text-sm text-[var(--color-text-muted)]">
                        <li>• Quiet studio floor designed for talking‑head and conversational formats.</li>
                        <li>• Layout that supports single‑camera or multi‑camera setups.</li>
                        <li>• Background options that work for brands, agencies and creators.</li>
                        <li>• 24×7 access so you can shoot when your guests are available.</li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h2 class="text-base font-semibold tracking-tight">
                        Videography lighting &amp; support
                    </h2>
                    <ul class="space-y-2 text-sm text-[var(--color-text-muted)]">
                        <li>• Constant lights (Kodak 200) with cutters and diffusers for soft, flattering output.</li>
                        <li>• Options for key, fill and backlight to sculpt your frame.</li>
                        <li>• Light assistant to help you with stands, modifiers and quick changes.</li>
                        <li>• Access to makeup room so your talent looks ready on camera at all times.</li>
                    </ul>
                </div>
            </div>

            <div id="faqs" class="mt-10 border-t border-[var(--color-border-subtle)] pt-8">
                <h2 class="text-base font-semibold tracking-tight">
                    FAQs about our videography studio
                </h2>
                <div class="mt-4 space-y-4 text-sm text-[var(--color-text-muted)]">
                    <div>
                        <p class="font-medium text-[var(--color-text-main)]">
                            What kind of videography projects is the studio best for?
                        </p>
                        <p class="mt-1">
                            We regularly host interviews, brand films, casting videos, content series for YouTube and
                            Instagram, and corporate announcements. If your concept needs a clean and controllable
                            environment, this studio is a good fit.
                        </p>
                    </div>
                    <div>
                        <p class="font-medium text-[var(--color-text-main)]">
                            Do you provide cameras or only the space and lights?
                        </p>
                        <p class="mt-1">
                            Most teams bring their own camera bodies and lenses. We provide the lights, modifiers, stands,
                            backdrops, props and an on‑floor assistant. If you need camera rentals, we can connect you with
                            trusted partners.
                        </p>
                    </div>
                    <div>
                        <p class="font-medium text-[var(--color-text-main)]">
                            Can we record sound directly in the studio?
                        </p>
                        <p class="mt-1">
                            Yes. Many creators record production audio in the space. For best results we recommend directional
                            mics, lavaliers or podcast‑grade microphones, and we can help you place them in the set so they
                            stay out of frame.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
        $faq = [
            [
                'q' => 'What kind of videography projects is the studio best for?',
                'a' => 'We regularly host interviews, brand films, casting videos, YouTube content and corporate announcements. If your concept needs a clean, controllable environment, this studio is a good fit.',
            ],
            [
                'q' => 'Do you provide cameras or only the space and lights?',
                'a' => 'Most teams bring camera bodies and lenses. We provide lights, modifiers, stands, backdrops, props and an on‑floor assistant. Camera rentals are available via trusted partners.',
            ],
            [
                'q' => 'Can we record sound directly in the studio?',
                'a' => 'Yes. Many creators record production audio in the space. For best results, use directional mics, lavaliers or podcast‑grade microphones and we can help you place them to stay out of frame.',
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
            'alt' => 'Interview lighting arrangement in studio',
            'color' => '#e6f0ff',
            'src' => 'https://images.unsplash.com/photo-1511391409289-602dbd83b38c',
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
            <h2 class="text-base font-semibold tracking-tight">Production planning tips</h2>
            <div class="mt-4 grid gap-8 md:grid-cols-2 text-sm text-[var(--color-text-muted)]">
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Interview layouts</p>
                    <p>Decide early between single‑subject, two‑shot or panel framing; this informs flags, mic placement and background choices.</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Audio discipline</p>
                    <p>Keep non‑essential talk off‑set and confirm levels with room tone takes before rolling on content.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
