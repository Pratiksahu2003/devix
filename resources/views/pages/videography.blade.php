@extends('layouts.app')

@section('title', 'Videography Studio on Rent in Delhi NCR | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Book a professional videography studio on rent in Dwarka, Delhi at {{ config('company.brand') }} — ideal for interviews, YouTube content, product videos, podcasts and brand films with 4K cameras, lighting and multi-camera setups." />
@endsection

@section('content')
    @php
        $faq = [
            [
                'q' => 'What types of videos can be produced at ' . config('company.brand') . ' Videography Studio?',
                'a' => config('company.brand') . ' Videography Studio supports interviews, YouTube content, product videos, social media reels, podcast videos, brand films, and commercial video production.',
            ],
            [
                'q' => 'Is the videography studio available for rent?',
                'a' => 'Yes, ' . config('company.brand') . ' Videography Studio is available for rent. You can book the studio for hourly, half-day, or full-day sessions depending on your project needs.',
            ],
            [
                'q' => 'Who can use ' . config('company.brand') . ' Videography Studio?',
                'a' => 'Content creators, YouTubers, brands, agencies, filmmakers, and businesses looking for a professional videography space in Delhi NCR can book the studio.',
            ],
            [
                'q' => 'Where is ' . config('company.brand') . ' Videography Studio located?',
                'a' => config('company.brand') . ' Videography Studio is located in Dwarka Sector-13, New Delhi, making it easily accessible from major areas of Delhi NCR.',
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
            'alt' => 'Videography studio setup with lighting and cameras in Dwarka',
            'src' => 'storage/studio/DSC01008.JPG',
        ];
        $galleryItems = [
            ['src' => 'storage/studio/DSC01007.JPG', 'alt' => 'Studio lighting and setup'],
            ['src' => 'storage/room/IMG_0780.jpeg', 'alt' => 'Podcast and interview setup'],
            ['src' => 'storage/studio/DSC01009.JPG', 'alt' => 'Videography lighting'],
            ['src' => 'storage/room/IMG_0782.jpeg', 'alt' => 'Multi-camera recording'],
            ['src' => 'storage/studio/DSC01010.JPG', 'alt' => 'Professional studio space'],
            ['src' => 'storage/room/IMG_0784.jpeg', 'alt' => 'Content creation studio'],
        ];
    @endphp

    <script type="application/ld+json">{!! json_encode($faqLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>

    {{-- Hero --}}
    <div class="relative bg-black h-[80vh] min-h-[500px] overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset($hero['src']) }}" alt="{{ $hero['alt'] }}" class="h-full w-full object-cover opacity-60" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        </div>
        <div class="relative h-full mx-auto max-w-6xl px-4 flex flex-col justify-center items-center text-center">
            <span class="inline-block rounded-full bg-emerald-600/20 border border-emerald-500/30 px-4 py-1.5 text-sm font-medium text-emerald-200 backdrop-blur-sm mb-6">
                Videography Studio in Dwarka
            </span>
            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl md:text-7xl drop-shadow-lg">
                Professional Videography Studio
            </h1>
            <p class="mt-6 max-w-2xl text-lg sm:text-xl text-gray-200 leading-relaxed drop-shadow-md">
                A fully equipped videography studio in Dwarka Sector-13 for interviews, YouTube content, product videos, podcasts, and brand films — with 4K cameras, lighting, and multi-camera setups.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('pages.booking') }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                    Book the Studio
                </a>
                <a href="#features" class="inline-flex items-center justify-center rounded-lg border border-white/30 bg-white/10 px-6 py-3 text-base font-semibold text-white backdrop-blur-sm hover:bg-white/20">
                    See Features
                </a>
            </div>
        </div>
    </div>

    {{-- Intro --}}
    <section class="bg-white py-16 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 text-center">
            <p class="text-lg text-[var(--color-text-muted)] leading-relaxed">
                Need a <strong class="text-[var(--color-text-main)]">professional videography studio in Delhi</strong> for your next video project? {{ config('company.brand') }} Videography Studio in Dwarka Sector-13 offers a fully equipped space for rent, ideal for interviews, YouTube content, product videos, podcast recordings, social media reels, and brand films. Our studio combines high-end cameras, professional lighting, multi-camera setups, and audio equipment to help you produce broadcast-quality video content.
            </p>
        </div>
    </section>

    {{-- Studio for Rent / Use cases --}}
    <section class="bg-[var(--color-surface-muted)] py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-3xl text-center mb-10">Studio for Rent — Built for Video</h2>
            <p class="text-center text-[var(--color-text-muted)] max-w-2xl mx-auto mb-12">Whether you're shooting interviews, YouTube episodes, product demos, or podcast videos, our videography studio provides the space and gear you need.</p>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Interviews &amp; Talk Shows</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Single or multi-camera interview setups with professional lighting and audio for podcasts and talk shows.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">YouTube &amp; Long-Form</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Dedicated space for YouTube videos, vlogs, and long-form content with consistent lighting and backdrops.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Product &amp; Commercial</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Product videos, unboxing, and commercial shoots with controlled lighting and multiple angles.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Social &amp; Reels</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Short-form content, reels, and social media videos with quick turnaround and professional look.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Professional Equipment --}}
    <section id="features" class="bg-[var(--color-surface)] py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="mb-16 md:text-center max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">Professional Videography Equipment</h2>
                <p class="mt-4 text-lg text-[var(--color-text-muted)]">4K cameras, studio lighting, multi-camera setups, and professional audio so you can focus on content.</p>
            </div>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] p-6">
                    <h3 class="font-semibold text-[var(--color-text-main)]">4K Cameras &amp; Lenses</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">High-quality 4K cameras and lenses for sharp, professional video output suitable for broadcast and web.</p>
                </div>
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] p-6">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Studio Lighting</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Professional lighting setups with key, fill, and backlight options for flattering, consistent results.</p>
                </div>
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] p-6">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Multi-Camera &amp; Audio</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Multi-camera recording for podcasts and interviews; professional mics and audio for clear dialogue.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery --}}
    <section class="border-t border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold tracking-tight text-[var(--color-text-main)] mb-8">Studio in Action</h2>
            <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                @foreach($galleryItems as $item)
                    <a href="{{ asset($item['src']) }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-xl border border-[var(--color-border-subtle)] bg-[var(--color-surface)]">
                        <img src="{{ asset($item['src']) }}" alt="{{ $item['alt'] }}" class="h-48 w-full object-cover transition hover:scale-105" loading="lazy" />
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Why Choose --}}
    <section class="border-t border-[var(--color-border-subtle)] bg-white py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold tracking-tight text-[var(--color-text-main)] mb-6">Why Choose {{ config('company.brand') }} Videography Studio</h2>
            <p class="text-[var(--color-text-muted)] mb-8">Perfect for creators, YouTubers, brands, and businesses who need a professional videography space without the cost of building their own studio. We provide the equipment, space, and support so you can focus on creating great content.</p>
            <ul class="grid gap-4 sm:grid-cols-2 text-[var(--color-text-muted)]">
                <li class="flex items-start gap-2"><span class="text-emerald-600 mt-0.5">✓</span> Fully equipped with 4K cameras, lighting, and audio</li>
                <li class="flex items-start gap-2"><span class="text-emerald-600 mt-0.5">✓</span> Multiple shooting setups: podcast, interview, product, social</li>
                <li class="flex items-start gap-2"><span class="text-emerald-600 mt-0.5">✓</span> Convenient location in Dwarka Sector-13, Delhi</li>
                <li class="flex items-start gap-2"><span class="text-emerald-600 mt-0.5">✓</span> Flexible booking: hourly, half-day, or full-day</li>
            </ul>
        </div>
    </section>

    {{-- Location --}}
    <section class="border-t border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold tracking-tight text-[var(--color-text-main)] mb-4">Convenient Location</h2>
            <p class="text-[var(--color-text-muted)] mb-6">{{ config('company.brand') }} Videography Studio is located in <strong class="text-[var(--color-text-main)]">Dwarka Sector-13, New Delhi</strong>, easily accessible from major areas of Delhi NCR. Ideal for content creators, YouTubers, and brands across Delhi and NCR.</p>
            <a href="{{ route('pages.location') }}" class="inline-flex items-center font-semibold text-emerald-600 hover:text-emerald-500">
                View location &amp; access
                <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
            </a>
        </div>
    </section>

    {{-- FAQ --}}
    <section id="frequently Asked Questions" class="border-t border-[var(--color-border-subtle)] bg-[var(--color-surface)] py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold tracking-tight text-[var(--color-text-main)] mb-8 text-center">Frequently Asked Questions</h2>
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($faq as $item)
                    <li>
                        <h3 class="font-semibold text-[var(--color-text-main)]">{{ $item['q'] }}</h3>
                        <p class="mt-2 text-[var(--color-text-muted)]">{{ $item['a'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- CTA --}}
    <section class="border-t border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] py-12">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 text-center">
            <h2 class="text-xl font-bold text-[var(--color-text-main)]">Book {{ config('company.brand') }} Videography Studio</h2>
            <p class="mt-2 text-[var(--color-text-muted)]">Reserve your slot for interviews, YouTube content, product videos, or podcast recordings.</p>
            <a href="{{ route('pages.booking') }}" class="mt-6 inline-flex items-center justify-center rounded-lg bg-emerald-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-emerald-500">Book Now</a>
        </div>
    </section>
@endsection
