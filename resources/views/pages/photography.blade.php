@extends('layouts.app')

@section('title', 'Photography Studio on Rent in Delhi NCR | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="{{ config('company.brand') }} offers a fully equipped photography studio on rent in Delhi NCR with professional lighting, multiple backdrops, makeup room, and props for portraits, fashion, product and corporate shoots." />
@endsection

@section('content')
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

        $hero = [
            'alt' => 'Photography studio makeup room with lighted mirror',
            'src' => 'storage/studio/DSC01010.JPG',
        ];

        // Selected images from Pooja and Vidhu folders
        $galleryItems = [
            ['src' => 'storage/pooja/DSC00956.JPG', 'alt' => 'Fashion Shoot'],
            ['src' => 'storage/vidhu/DSC00982.JPG', 'alt' => 'Portrait Session'],
            ['src' => 'storage/pooja/DSC00963.JPG', 'alt' => 'Creative Lighting'],
            ['src' => 'storage/vidhu/DSC00987.JPG', 'alt' => 'Studio Portraits'],
            ['src' => 'storage/pooja/DSC00973.JPG', 'alt' => 'Fashion Editorial'],
            ['src' => 'storage/vidhu/DSC00991.JPG', 'alt' => 'Professional Headshots'],
        ];
    @endphp

    <script type="application/ld+json">{!! json_encode($faqLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>

    {{-- Hero Section --}}
    <div class="relative bg-black h-[80vh] min-h-[500px] overflow-hidden">
        <div class="absolute inset-0">
             <img src="{{ asset($hero['src']) }}" alt="{{ $hero['alt'] }}" class="h-full w-full object-cover opacity-60" />
             <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        </div>
        <div class="relative h-full mx-auto max-w-6xl px-4 flex flex-col justify-center items-center text-center">
            <span class="inline-block rounded-full bg-blue-600/20 border border-blue-500/30 px-4 py-1.5 text-sm font-medium text-blue-200 backdrop-blur-sm mb-6">
                Now Open in Delhi NCR
            </span>
            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl md:text-7xl drop-shadow-lg">
                Your Vision.<br/>Our Studio.
            </h1>
            <p class="mt-6 max-w-2xl text-lg sm:text-xl text-gray-200 leading-relaxed drop-shadow-md">
                Professional lighting, limitless backdrops, and the creative freedom you need.
                Book your slot today and create something extraordinary.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="#contact" class="rounded-full bg-white px-8 py-3.5 text-base font-semibold text-black transition hover:bg-gray-200 hover:scale-105 transform duration-200">
                    Book Studio Now
                </a>
                <a href="#features" class="rounded-full border border-white/30 bg-white/10 px-8 py-3.5 text-base font-semibold text-white backdrop-blur-sm transition hover:bg-white/20">
                    View Features
                </a>
            </div>
        </div>
    </div>

    {{-- Features Grid --}}
    <section id="features" class="bg-[var(--color-surface)] py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="mb-16 md:text-center max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">Everything You Need to Create</h2>
                <p class="mt-4 text-lg text-[var(--color-text-muted)]">We've thought of every detail so you can focus entirely on your shoot.</p>
            </div>
            
            <div class="grid gap-x-8 gap-y-12 sm:grid-cols-2 lg:grid-cols-3">
                {{-- Feature 1 --}}
                <div class="group">
                    <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[var(--color-text-main)]">Prime Location</h3>
                    <p class="mt-3 text-[var(--color-text-muted)] leading-relaxed">Located centrally in Delhi NCR with easy access for your entire crew and equipment. Ample parking available.</p>
                </div>
                 {{-- Feature 2 --}}
                <div class="group">
                     <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[var(--color-text-main)]">24/7 Access</h3>
                    <p class="mt-3 text-[var(--color-text-muted)] leading-relaxed">Early morning light or late-night creative bursts? We are open round the clock to suit your schedule.</p>
                </div>
                 {{-- Feature 3 --}}
                <div class="group">
                     <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[var(--color-text-main)]">Pro Gear Included</h3>
                    <p class="mt-3 text-[var(--color-text-muted)] leading-relaxed">Godox QT 1200 IIIm lights, octa & strip softboxes, C-stands, and triggers are part of your booking.</p>
                </div>
                 {{-- Feature 4 --}}
                <div class="group">
                     <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[var(--color-text-main)]">Private Makeup Room</h3>
                    <p class="mt-3 text-[var(--color-text-muted)] leading-relaxed">A dedicated, well-lit space with vanity mirrors for your styling team to prep models comfortably.</p>
                </div>
                 {{-- Feature 5 --}}
                <div class="group">
                     <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[var(--color-text-main)]">Versatile Sets</h3>
                    <p class="mt-3 text-[var(--color-text-muted)] leading-relaxed">Choose from various colored paper backdrops and textured walls to create distinct looks in one session.</p>
                </div>
                 {{-- Feature 6 --}}
                <div class="group">
                     <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[var(--color-text-main)]">Studio Assistance</h3>
                    <p class="mt-3 text-[var(--color-text-muted)] leading-relaxed">Our on-floor light assistant is there to help with equipment changes so you stay in the flow.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Preview --}}
    <section class="bg-[var(--color-surface-muted)] py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-12 gap-4">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)]">Shot at Our Studio</h2>
                    <p class="mt-4 text-lg text-[var(--color-text-muted)]">Real results from recent bookings. See what's possible.</p>
                </div>
                <a href="{{ url('/gallery') }}" class="group inline-flex items-center font-semibold text-blue-600 hover:text-blue-500">
                    View Full Gallery 
                    <svg class="ml-2 h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-6">
                @foreach($galleryItems as $item)
                    <div class="relative group overflow-hidden rounded-2xl bg-gray-200 aspect-[4/5] cursor-pointer">
                        <img 
                            src="{{ asset($item['src']) }}" 
                            alt="{{ $item['alt'] }}" 
                            class="h-full w-full object-cover transition duration-700 group-hover:scale-110"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 transition duration-300 group-hover:opacity-100 flex items-end p-6">
                            <span class="text-white font-medium">{{ $item['alt'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="bg-[var(--color-surface)] py-20">
        <div class="mx-auto max-w-3xl px-4 sm:px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)]">Common Questions</h2>
                <p class="mt-4 text-[var(--color-text-muted)]">Everything you need to know before you book.</p>
            </div>
            
            <div class="space-y-4" x-data="{ active: 0 }">
                @foreach($faq as $index => $item)
                    <div class="overflow-hidden rounded-2xl border border-[var(--color-border-subtle)] bg-white transition hover:border-blue-200">
                        <button 
                            @click="active = active === {{ $index }} ? null : {{ $index }}"
                            class="flex w-full items-center justify-between px-6 py-5 text-left font-medium text-[var(--color-text-main)] hover:bg-gray-50/50 transition"
                        >
                            <span class="text-lg">{{ $item['q'] }}</span>
                            <span :class="active === {{ $index }} ? 'rotate-180 text-blue-600' : 'text-gray-400'" class="transition-transform duration-200">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </span>
                        </button>
                        <div 
                            x-show="active === {{ $index }}" 
                            x-collapse
                            class="border-t border-[var(--color-border-subtle)] bg-gray-50/30 px-6 py-5 text-[var(--color-text-muted)] leading-relaxed"
                        >
                            {{ $item['a'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Pre-shoot Checklist (Kept from original but styled) --}}
    <section class="border-t border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-xl font-bold tracking-tight text-[var(--color-text-main)] mb-8">Pre-shoot Checklist</h2>
            <div class="grid gap-8 md:grid-cols-2">
                <div class="rounded-2xl bg-white p-8 shadow-sm border border-[var(--color-border-subtle)]">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <h3 class="font-semibold text-[var(--color-text-main)]">Creative</h3>
                    </div>
                    <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">References and shot priorities, talent timings, wardrobe notes, set props, styling kit, and a short list of must‑have frames for approval.</p>
                </div>
                <div class="rounded-2xl bg-white p-8 shadow-sm border border-[var(--color-border-subtle)]">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <h3 class="font-semibold text-[var(--color-text-main)]">Technical</h3>
                    </div>
                    <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">Camera bodies and lenses, batteries and chargers, cards and backups, tethering, and the lighting approach for each scene.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
