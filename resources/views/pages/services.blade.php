@extends('layouts.app')

@section('title', 'Studio Services | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Explore studio services at {{ config('company.brand') }} in Delhi NCR – portrait and fashion shoots, product photography, corporate content, podcast recording, edit room and more." />
@endsection

@section('content')
    <x-home.shop-by-frame />

    @php
        $hero = [
            ['alt' => 'Portrait set ready with soft key', 'color' => '#e6f0ff', 'src' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2'],
            ['alt' => 'Fashion frame against textured wall', 'color' => '#fde68a', 'src' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772'],
            ['alt' => 'Product catalog lighting setup', 'color' => '#f5f5f7', 'src' => 'https://images.unsplash.com/photo-1520975232559-17ea5bbdfd1d'],
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
    <section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]" id="mosaic">
        <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6">
            <div class="grid gap-4 sm:grid-cols-3">
                @foreach ($hero as $it)
                    @php
                        $href = route('pages.photography') . '#faqs';
                        if (str_contains(strtolower($it['alt']), 'product')) $href = route('pages.photography') . '#faqs';
                        if (str_contains(strtolower($it['alt']), 'fashion')) $href = route('pages.photography') . '#faqs';
                    @endphp
                    <a href="{{ $href }}" class="group overflow-hidden rounded-2xl border border-[var(--color-border-subtle)] bg-white shadow-sm shadow-black/5 transition hover:-translate-y-1 hover:shadow-md" data-tilt="5">
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
                        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 transition group-hover:opacity-100"></div>
                        <figcaption class="absolute bottom-0 left-0 right-0 p-3 text-[12px] text-white/95 opacity-0 transition group-hover:opacity-100">
                            {{ $it['alt'] }} · Learn more
                        </figcaption>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="sticky top-0 z-10 border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]/80 backdrop-blur">
        <div class="mx-auto max-w-6xl px-4 py-2 sm:px-6">
            <nav class="flex flex-wrap gap-2 text-[12px]">
                <a href="#audience" class="rounded-full border border-[var(--color-border-subtle)] bg-white px-3 py-1.5 hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)]">Who it’s for</a>
                <a href="#formats" class="rounded-full border border-[var(--color-border-subtle)] bg-white px-3 py-1.5 hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)]">By format</a>
                <a href="#produce" class="rounded-full border border-[var(--color-border-subtle)] bg-white px-3 py-1.5 hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)]">What we produce</a>
                <a href="#flow" class="rounded-full border border-[var(--color-border-subtle)] bg-white px-3 py-1.5 hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)]">Flow</a>
                <a href="#why" class="rounded-full border border-[var(--color-border-subtle)] bg-white px-3 py-1.5 hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)]">Why choose</a>
                <a href="#faqs" class="rounded-full border border-[var(--color-border-subtle)] bg-white px-3 py-1.5 hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)]">FAQs</a>
            </nav>
        </div>
    </section>

    <section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]" id="audience">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
            <h2 class="text-base font-semibold tracking-tight">
                Who our studio services are for
            </h2>
            <div class="mt-4 grid gap-6 md:grid-cols-3 text-sm text-[var(--color-text-muted)]">
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Independent creators</p>
                    <p>Content creators, photographers and filmmakers who need a reliable, flexible space to shoot in.</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Brands &amp; agencies</p>
                    <p>Teams producing campaigns, lookbooks, product launches, and recurring content series.</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Corporate teams</p>
                    <p>Companies filming leadership messages, training content, internal events and interviews.</p>
                </div>
            </div>
        </div>
    </section>

    @php
        $sets = [
            'Portraits' => [
                ['alt' => 'Headshot with soft key', 'color' => '#e6f0ff', 'src' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2'],
                ['alt' => 'Editorial portrait', 'color' => '#e5e7eb', 'src' => 'https://images.unsplash.com/photo-1519345182560-3f2917c472ef'],
                ['alt' => 'Team portraits batch', 'color' => '#f5f5f7', 'src' => 'https://images.unsplash.com/photo-1520975916090-3105956dac38'],
            ],
            'Fashion' => [
                ['alt' => 'Lookbook textured wall', 'color' => '#fde68a', 'src' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772'],
                ['alt' => 'Editorial full‑length', 'color' => '#fde68a', 'src' => 'https://images.unsplash.com/photo-1539109136881-3be0616acf4b'],
                ['alt' => 'Detail with props', 'color' => '#f5f5f7', 'src' => 'https://images.unsplash.com/photo-1520975232559-17ea5bbdfd1d'],
            ],
            'Products' => [
                ['alt' => 'E‑commerce frame clean bg', 'color' => '#f5f5f7', 'src' => 'https://images.unsplash.com/photo-1585386959984-a41552231658'],
                ['alt' => 'Cosmetic macro highlights', 'color' => '#fef3c7', 'src' => 'https://images.unsplash.com/photo-1585238342028-4bbc2e06a8aa'],
                ['alt' => 'Catalog lighting table', 'color' => '#f5f5f7', 'src' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff'],
            ],
            'Interviews' => [
                ['alt' => 'Two‑shot interview', 'color' => '#e5e7eb', 'src' => 'https://images.unsplash.com/photo-1550124220-1f57b8bd8cf3'],
                ['alt' => 'Corporate talking head', 'color' => '#e5e7eb', 'src' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952'],
                ['alt' => 'Key + fill + backlight', 'color' => '#e6f0ff', 'src' => 'https://images.unsplash.com/photo-1511391409289-602dbd83b38c'],
            ],
            'Podcasts' => [
                ['alt' => 'Two‑person podcast set', 'color' => '#e6f0ff', 'src' => 'https://images.unsplash.com/photo-1525182008055-f88b95ff7980'],
                ['alt' => 'Panel podcast layout', 'color' => '#e6f0ff', 'src' => 'https://images.unsplash.com/photo-1519046904884-53103b34b206'],
                ['alt' => 'Mic technique close', 'color' => '#e6f0ff', 'src' => 'https://images.unsplash.com/photo-1511391409289-602dbd83b38c'],
            ],
        ];
        $lqip2 = function ($c) {
            $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="12"><rect width="100%" height="100%" fill="'.$c.'"/></svg>';
            return 'data:image/svg+xml;charset=UTF-8,'.rawurlencode($svg);
        };
        $srcset2 = function ($b) {
            $q = fn ($w) => $b.'?auto=format&fit=crop&w='.$w.'&q=60';
            return $q(480).' 480w, '.$q(800).' 800w, '.$q(1200).' 1200w';
        };
    @endphp
    <section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]" id="formats" x-data="{ tab: 'Portraits', tabs: ['Portraits','Fashion','Products','Interviews','Podcasts'] }">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
            <div class="flex flex-wrap items-center gap-2">
                <h2 class="text-base font-semibold tracking-tight mr-2">By format</h2>
                <template x-for="t in tabs" :key="t">
                    <button type="button"
                        class="rounded-full border border-[var(--color-border-subtle)] bg-white px-3 py-1.5 text-[12px] font-medium transition hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)]"
                        :class="tab === t ? 'border-[var(--color-brand-lens-blue)] text-[var(--color-brand-lens-blue)]' : ''"
                        @click="tab = t" x-text="t"></button>
                </template>
            </div>
            <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($sets as $name => $items)
                    <template x-if="tab === '{{ $name }}'">
                        <div class="contents">
                            @foreach ($items as $it)
                                <a href="{{ route('pages.gallery') }}" class="group overflow-hidden rounded-2xl border border-[var(--color-border-subtle)] bg-white shadow-sm shadow-black/5 transition hover:-translate-y-1 hover:shadow-md" data-tilt="4">
                                    <img
                                        alt="{{ $it['alt'] }}"
                                        loading="lazy"
                                        decoding="async"
                                        class="block w-full aspect-[4/3] object-cover transition duration-700 ease-out group-hover:scale-[1.02]"
                                        src="{{ $it['src'] }}?auto=format&fit=crop&w=800&q=70"
                                        srcset="{{ $srcset2($it['src']) }}"
                                        sizes="(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 33vw"
                                        style="background: url('{{ $lqip2($it['color']) }}') center/cover no-repeat; filter: blur(12px);"
                                        onload="this.style.filter='none'; this.style.background='none';"
                                    />
                                    <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 transition group-hover:opacity-100"></div>
                                    <figcaption class="absolute bottom-0 left-0 right-0 p-3 text-[12px] text-white/95 opacity-0 transition group-hover:opacity-100">{{ $it['alt'] }} · Open gallery</figcaption>
                                </a>
                            @endforeach
                        </div>
                    </template>
                @endforeach
            </div>
            <div class="mt-6 flex justify-center">
                <a :href="'{{ route('pages.contact') }}?format=' + encodeURIComponent(tab)"
                    class="inline-flex items-center rounded-full bg-[var(--color-brand-lens-blue)] px-5 py-2.5 text-xs font-medium text-white shadow-md shadow-[var(--color-brand-lens-blue)]/40 transition hover:-translate-y-0.5 hover:bg-[#003a88]">
                    Get a quote for <span class="ml-1" x-text="tab"></span>
                </a>
            </div>
        </div>
    </section>

    <section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)]" id="produce">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
            <h2 class="text-base font-semibold tracking-tight">
                What we help you produce
            </h2>
            <div class="mt-6 grid gap-8 lg:grid-cols-2">
                <div class="space-y-4 text-sm text-[var(--color-text-muted)]">
                    <p class="text-[var(--color-text-main)] font-medium">Portraits and personal branding</p>
                    <p>Headshots and personal branding portraits that look natural, clean and consistent across teams and campaigns. With controlled light, practical backdrops and an assistant on floor, you can move quickly between looks while keeping skin tones accurate and flattering.</p>
                    <p class="text-[var(--color-text-main)] font-medium">Fashion and lookbooks</p>
                    <p>From minimal, catalogue‑ready frames to editorial sets, the floor supports quick lighting resets, wardrobe changes in the makeup room and modular props. Use textured walls and backdrops to create variety without losing continuity across the series.</p>
                    <p class="text-[var(--color-text-main)] font-medium">Product and e‑commerce</p>
                    <p>Lights and modifiers are tuned for fast, repeatable results. Whether you’re shooting reflective surfaces, apparel, accessories or cosmetics, you get the space to set up controlled tables, flags and cutters to keep highlights disciplined and edges crisp.</p>
                </div>
                <div class="space-y-4 text-sm text-[var(--color-text-muted)]">
                    <p class="text-[var(--color-text-main)] font-medium">Corporate content and interviews</p>
                    <p>Capture leadership messages, training modules and internal communications with a calm set that keeps the focus on your speakers. The layout supports single‑camera and multi‑camera setups, with power and organization to keep cables and stands out of the way.</p>
                    <p class="text-[var(--color-text-main)] font-medium">Podcast and talk shows</p>
                    <p>The podcast corner balances comfort and acoustics with clean backgrounds. Use dynamic mics for speech clarity and soft LED panels shaped with cutters to hold attention on your guests. Record audio‑only, or add cameras for short‑form and long‑form shows.</p>
                </div>
            </div>
            <div class="mt-8 overflow-x-auto">
                @php
                    $roll = [
                        ['alt' => 'Portrait session in progress', 'color' => '#e6f0ff', 'src' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de'],
                        ['alt' => 'Lookbook on textured wall', 'color' => '#fde68a', 'src' => 'https://images.unsplash.com/photo-1520975916090-3105956dac38'],
                        ['alt' => 'E‑commerce catalog flat‑lay', 'color' => '#f5f5f7', 'src' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff'],
                        ['alt' => 'Corporate interview lighting', 'color' => '#e5e7eb', 'src' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952'],
                        ['alt' => 'Podcast set with dynamic mics', 'color' => '#e6f0ff', 'src' => 'https://images.unsplash.com/photo-1511391409289-602dbd83b38c'],
                    ];
                @endphp
                <div class="flex gap-4">
                    @foreach ($roll as $it)
                        <a href="{{ route('pages.gallery') }}" class="group min-w-[260px] flex-1 overflow-hidden rounded-2xl border border-[var(--color-border-subtle)] bg-white shadow-sm shadow-black/5 transition hover:-translate-y-1 hover:shadow-md sm:min-w-[320px]" data-tilt="4">
                            <img
                                alt="{{ $it['alt'] }}"
                                loading="lazy"
                                decoding="async"
                                class="block w-full aspect-[4/3] object-cover transition duration-700 ease-out group-hover:scale-[1.02]"
                                src="{{ $it['src'] }}?auto=format&fit=crop&w=800&q=70"
                                srcset="{{ $srcset($it['src']) }}"
                                sizes="(max-width: 640px) 80vw, (max-width: 1024px) 40vw, 33vw"
                                style="background: url('{{ $lqip($it['color']) }}') center/cover no-repeat; filter: blur(12px);"
                                onload="this.style.filter='none'; this.style.background='none';"
                            />
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 transition group-hover:opacity-100"></div>
                            <figcaption class="absolute bottom-0 left-0 right-0 p-3 text-[12px] text-white/95 opacity-0 transition group-hover:opacity-100">{{ $it['alt'] }}</figcaption>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]" id="flow">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
            <h2 class="text-base font-semibold tracking-tight">How a typical booking flows</h2>
            <div class="mt-6 grid gap-8 lg:grid-cols-3 text-sm text-[var(--color-text-muted)]">
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Pre‑production</p>
                    <p>Share a quick brief with references, quantity of frames, and preferred dates. We help map backdrops, lighting approach and props so the floor is production‑ready on arrival.</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">On the day</p>
                    <p>Arrive to a clean, organized set. Use the makeup room for prep, then rotate through looks while the assistant helps with stands, modifiers and resets to keep momentum high.</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Wrap & handoff</p>
                    <p>Review selects on set or in the edit room. We assist with safe pack‑down and basic backups so your cards travel securely and the space is ready for the next team.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)]" id="why">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
            <h2 class="text-base font-semibold tracking-tight">Why teams choose this studio</h2>
            <div class="mt-6 grid gap-8 md:grid-cols-2 text-sm text-[var(--color-text-muted)]">
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Availability that respects your schedule</p>
                    <p>24×7 slots for early starts, late‑night shoots and quick turnarounds. No hidden restrictions, no surprise cut‑offs.</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Production‑ready support</p>
                    <p>An on‑floor assistant helps move stands, shape light and reset sets so directors and creators stay focused on the frame and the performance.</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Modular sets and props</p>
                    <p>Combine textured walls, plain backgrounds and simple props to build distinct moods in a single day without bloating setup times.</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Calm, organized spaces</p>
                    <p>Makeup, green room and the floor are planned to reduce clutter and friction, so talent can focus and teams can move with rhythm.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[var(--color-surface)]" id="faqs">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
            <h2 class="text-base font-semibold tracking-tight">FAQs about services</h2>
            <div class="mt-4 space-y-4 text-sm text-[var(--color-text-muted)]">
                <div>
                    <p class="font-medium text-[var(--color-text-main)]">Can you help with creative direction?</p>
                    <p>We guide lighting, backdrop choices and set flow. For end‑to‑end direction, we coordinate with trusted stylists, art directors and producers on request.</p>
                </div>
                <div>
                    <p class="font-medium text-[var(--color-text-main)]">Do you offer crew and equipment add‑ons?</p>
                    <p>Yes. Add podcast mics, constant lights, and an edit room. For cameras and specialty grip we connect you with partner rentals to keep workflows reliable.</p>
                </div>
                <div>
                    <p class="font-medium text-[var(--color-text-main)]">What’s the best way to plan a first visit?</p>
                    <p>Browse the <a class="underline" href="{{ route('pages.pricing') }}">pricing</a> and <a class="underline" href="{{ route('pages.about') }}">about</a> pages, then write to us via <a class="underline" href="{{ route('pages.contact') }}">contact</a> with your brief and dates. We will confirm availability and a plan within a business day.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
