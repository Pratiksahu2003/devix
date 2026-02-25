@extends('layouts.app')

@section('title', 'Photography Studio on Rent in Delhi NCR | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="{{ config('company.brand') }} offers a fully equipped photography studio on rent in Delhi NCR with professional lighting, multiple backdrops, makeup room, and props for portraits, fashion, product and corporate shoots." />
@endsection

@section('content')
    <section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-14">
            <h1 class="text-2xl font-semibold tracking-tight sm:text-3xl">
                Photography Studio on Rent
            </h1>
            <p class="mt-3 max-w-2xl text-sm leading-relaxed text-[var(--color-text-muted)]">
                We are a full‑service photography studio on rent in Delhi NCR, with professional lighting, versatile
                backdrops, and enough floor space to bring your creative vision to life – from portraits and campaigns to
                product shoots.
            </p>

            <div class="mt-8 grid gap-8 lg:grid-cols-2">
                <div class="space-y-4">
                    <h2 class="text-base font-semibold tracking-tight">
                        Why book {{ config('company.brand') }} for your photography shoot?
                    </h2>
                    <ul class="space-y-2 text-sm text-[var(--color-text-muted)]">
                        <li>• Central Delhi NCR location that’s easy for clients and crew to access.</li>
                        <li>• 24×7 availability so you can schedule early‑morning or late‑night shoots.</li>
                        <li>• Dedicated makeup room to keep your talent camera‑ready between looks.</li>
                        <li>• Multiple backdrops and textured walls for different visual moods in a single day.</li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h2 class="text-base font-semibold tracking-tight">
                        Photography studio features &amp; equipment
                    </h2>
                    <ul class="space-y-2 text-sm text-[var(--color-text-muted)]">
                        <li>• 2× Godox QT 1200 IIIm with octa and strip softboxes for crisp, controllable light.</li>
                        <li>• Plain backdrops and textured walls suited for portraits, fashion and e‑commerce.</li>
                        <li>• Props and basic styling elements to quickly build sets on the floor.</li>
                        <li>• On‑floor light assistant to help with setups so you can focus on directing.</li>
                    </ul>
                </div>
            </div>

            <div id="faqs" class="mt-10 border-t border-[var(--color-border-subtle)] pt-8">
                <h2 class="text-base font-semibold tracking-tight">
                    FAQs about our photography studio
                </h2>
                <div class="mt-4 space-y-4 text-sm text-[var(--color-text-muted)]">
                    <div>
                        <p class="font-medium text-[var(--color-text-main)]">
                            How long is the minimum booking?
                        </p>
                        <p class="mt-1">
                            The minimum booking for the studio is 3 hours. You can extend in hourly blocks or upgrade to
                            a full‑day or all‑in package depending on your project.
                        </p>
                    </div>
                    <div>
                        <p class="font-medium text-[var(--color-text-main)]">
                            Can I bring my own equipment or team?
                        </p>
                        <p class="mt-1">
                            Yes. Many photographers bring their own cameras and lenses while using our lights, sets and
                            support staff. You are welcome to bring your own crew as long as they follow our studio rules.
                        </p>
                    </div>
                    <div>
                        <p class="font-medium text-[var(--color-text-main)]">
                            Do you help with concepts and set design?
                        </p>
                        <p class="mt-1">
                            We are happy to walk you through the space, suggest backdrops and props, and help you get the
                            most from the studio layout. For full creative direction, we can also coordinate with partner
                            stylists and art directors on request.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
        $faq = [
            [
                'q' => 'How long is the minimum booking?',
                'a' => 'The minimum booking is 3 hours. You can extend in hourly blocks or upgrade to a full‑day or all‑in package depending on your project.',
            ],
            [
                'q' => 'Can I bring my own equipment or team?',
                'a' => 'Yes. Bring your own cameras and lenses while using our lights, sets and support staff. Your crew is welcome as long as they follow studio rules.',
            ],
            [
                'q' => 'Do you help with concepts and set design?',
                'a' => 'We will walk you through the space, suggest backdrops and props, and help you get the most from the studio layout. Full creative direction can be arranged with partner stylists and art directors.',
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
            'alt' => 'Lighting setup on the studio floor for portraits',
            'color' => '#f5f5f7',
            'src' => 'https://images.unsplash.com/photo-1518770660439-4636190af475',
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
            <h2 class="text-base font-semibold tracking-tight">Pre‑shoot checklist</h2>
            <div class="mt-4 grid gap-8 md:grid-cols-2 text-sm text-[var(--color-text-muted)]">
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Creative</p>
                    <p>References and shot priorities, talent timings, wardrobe notes, set props, styling kit, and a short list of must‑have frames for approval.</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Technical</p>
                    <p>Camera bodies and lenses, batteries and chargers, cards and backups, tethering, and the lighting approach for each scene.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
