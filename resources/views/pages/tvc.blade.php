@extends('layouts.app')

@section('title', 'TV Commercial (TVC) Production Studio in Delhi NCR | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Book a professional TV Commercial (TVC) production studio in Dwarka, Delhi at {{ config('company.brand') }}. Shoot broadcast-quality ad films, digital commercials, and brand campaigns with high-end equipment." />
@endsection

@section('content')
    @php
        $faq = [
            [
                'q' => 'What types of commercials can be produced at ' . config('company.brand') . '?',
                'a' => config('company.brand') . ' is equipped for TV commercials (TVC), digital ad films, product commercials, promotional videos, and high-end brand campaigns.',
            ],
            [
                'q' => 'Does the studio have equipment suitable for broadcast-quality TVCs?',
                'a' => 'Yes, our studio provides access to 4K/6K cinema cameras, professional studio lighting grids, and premium audio equipment capable of delivering broadcast-ready results.',
            ],
            [
                'q' => 'Can my agency bring its own production crew and gear?',
                'a' => 'Absolutely. Agencies and production houses are welcome to bring their own crew, specialized cinema gear, and set designers to execute their vision perfectly.',
            ],
            [
                'q' => 'Is there space for clients and agency directors to monitor the shoot?',
                'a' => 'Yes, we have comfortable lounge areas and dedicated spaces where agency directors and clients can monitor the production live.',
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
            'alt' => 'Professional TVC and commercial production studio setup',
            'src' => 'storage/studio/DSC01010.JPG',
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
            <img src="{{ asset($hero['src']) }}" alt="{{ $hero['alt'] }}" class="h-full w-full object-cover opacity-60" onerror="this.src='https://placehold.co/1200x800/1e1e1e/333333?text=TVC+Studio'"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        </div>
        <div class="relative h-full mx-auto max-w-6xl px-4 flex flex-col justify-center items-center text-center">
            <span class="inline-block rounded-full bg-blue-600/20 border border-blue-500/30 px-4 py-1.5 text-sm font-medium text-blue-200 backdrop-blur-sm mb-6">
                TVC & Ad Film Studio
            </span>
            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl md:text-7xl drop-shadow-lg">
                Broadcast-Ready Commercials
            </h1>
            <p class="mt-6 max-w-2xl text-lg sm:text-xl text-gray-200 leading-relaxed drop-shadow-md">
                A premium production space in Dwarka Sector-13 optimized for high-end TV commercials, digital ad films, and brand campaigns.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('pages.booking') }}" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                    Book the Studio
                </a>
                <a href="#features" class="inline-flex items-center justify-center rounded-lg border border-white/30 bg-white/10 px-6 py-3 text-base font-semibold text-white backdrop-blur-sm hover:bg-white/20">
                    Explore Setup
                </a>
            </div>
        </div>
    </div>

    {{-- Intro --}}
    <section class="bg-white py-16 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 text-center">
            <p class="text-lg text-[var(--color-text-muted)] leading-relaxed">
                Producing a <strong class="text-[var(--color-text-main)]">high-impact TV commercial or digital ad film</strong> requires precision, control, and professional infrastructure. {{ config('company.brand') }} provides a fully controllable studio environment in Delhi NCR. With extensive lighting grids, acoustic treatments, and plenty of space for set builds and crew movement, our studio empowers advertising agencies and directors to bring their creative boards to life without compromise.
            </p>
        </div>
    </section>

    {{-- Studio for Rent / Use cases --}}
    <section class="bg-[var(--color-surface-muted)] py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-3xl text-center mb-10">Optimized for Commercial Production</h2>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">TV Commercials</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Shoot broadcast-standard advertisements with full lighting control and space for professional cinema cameras.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Digital Ad Films</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Create impactful, high-retention video ads tailored for YouTube, OTT platforms, and social media campaigns.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Product Demos</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Showcase products beautifully with dedicated staging areas and macro-friendly lighting setups.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Brand Anthems</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Scale up your production for large-scale brand narrative films with room for talent and crew.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Professional Equipment --}}
    <section id="features" class="bg-[var(--color-surface)] py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="mb-16 md:text-center max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">Studio Capabilities</h2>
                <p class="mt-4 text-lg text-[var(--color-text-muted)]">Everything your crew needs for a smooth, professional production day.</p>
            </div>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] p-6">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Advanced Lighting Options</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Access to a robust overhead lighting grid and heavy-duty stands capable of supporting industry-standard modifiers.</p>
                </div>
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] p-6">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Acoustic Treatment</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Quiet, sound-treated environment ensuring clear dialogue capture without unwanted street noise or echo.</p>
                </div>
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] p-6">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Client & Agency Lounge</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Comfortable viewing areas with monitor feeds so directors and clients can supervise the shoot seamlessly.</p>
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
                        <img src="{{ asset($item['src']) }}" alt="{{ $item['alt'] }}" class="h-48 w-full object-cover transition hover:scale-105" loading="lazy" onerror="this.src='https://placehold.co/400x300/e2e8f0/64748b'"/>
                    </a>
                @endforeach
            </div>
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
    <section class="border-t border-[var(--color-border-subtle)] bg-blue-50 py-12">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 text-center">
            <h2 class="text-xl font-bold text-[#2D335A]">Produce Your Next Commercial at {{ config('company.brand') }}</h2>
            <p class="mt-2 text-[#555C7A]">Reserve the studio for your upcoming ad film or television commercial shoot.</p>
            <a href="{{ route('pages.booking') }}" class="mt-6 inline-flex items-center justify-center rounded-lg bg-blue-600 px-8 py-3 text-base font-semibold text-white shadow-sm hover:bg-blue-700">Book Now</a>
        </div>
    </section>
@endsection
