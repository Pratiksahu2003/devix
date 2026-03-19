@extends('layouts.app')

@section('title', 'Instagram Reel & TikTok Studio in Delhi NCR | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Book a dedicated studio for Instagram reel shoots and TikTok videos in Dwarka, Delhi. Perfect lighting, vibrant backgrounds, and professional gear for viral content." />
@endsection

@section('content')
    @php
        $faq = [
            [
                'q' => 'Is the studio equipped for vertical video formats like Instagram Reels and TikTok?',
                'a' => 'Yes! We provide camera mounts and tripods specially designed for 9:16 vertical shooting, perfect for Shorts, Reels, and TikTok.',
            ],
            [
                'q' => 'Can we shoot multiple outfit changes quickly?',
                'a' => 'Absolutely. Our studio includes a private changing area and makeup station so influencers and creators can swap looks quickly and efficiently.',
            ],
            [
                'q' => 'Do you have ring lights or RGB lighting?',
                'a' => 'We offer modern lighting setups including LED panels with full RGB color control to give your reels exactly the pop and aesthetic they need.',
            ],
            [
                'q' => 'Can I easily transfer footage to my phone?',
                'a' => 'Yes, if you use our cinema cameras, we can provide files post-shoot, or you can mount your own smartphone directly to our professional lighting rigs.',
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
            'alt' => 'Vertical video setup for Instagram Reels in studio',
            'src' => 'storage/room/IMG_0782.jpeg',
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
            <img src="{{ asset($hero['src']) }}" alt="{{ $hero['alt'] }}" class="h-full w-full object-cover opacity-60" onerror="this.src='https://placehold.co/1200x800/1e1e1e/333333?text=Reels+Studio'"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        </div>
        <div class="relative h-full mx-auto max-w-6xl px-4 flex flex-col justify-center items-center text-center">
            <span class="inline-block rounded-full bg-pink-600/20 border border-pink-500/30 px-4 py-1.5 text-sm font-medium text-pink-200 backdrop-blur-sm mb-6">
                Short-Form Video Studio
            </span>
            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl md:text-7xl drop-shadow-lg">
                Create Viral Reels & Shorts
            </h1>
            <p class="mt-6 max-w-2xl text-lg sm:text-xl text-gray-200 leading-relaxed drop-shadow-md">
                A vibrant, flexible studio in Dwarka built for influencers, brands, and creators targeting Instagram Reels, TikTok, and YouTube Shorts.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('pages.booking') }}" class="inline-flex items-center justify-center rounded-lg bg-pink-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-pink-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pink-600">
                    Book Now
                </a>
                <a href="#features" class="inline-flex items-center justify-center rounded-lg border border-white/30 bg-white/10 px-6 py-3 text-base font-semibold text-white backdrop-blur-sm hover:bg-white/20">
                    Check Aesthetics
                </a>
            </div>
        </div>
    </div>

    {{-- Intro --}}
    <section class="bg-white py-16 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 text-center">
            <p class="text-lg text-[var(--color-text-muted)] leading-relaxed">
                Stand out in the feed. The {{ config('company.brand') }} Reels Studio provides <strong class="text-[var(--color-text-main)]">dynamic backdrops, vibrant RGB lighting, and vertical-video optimized setups</strong> to help you create scroll-stopping content in bulk. Whether you're batch-shooting fashion looks, filming quick tutorials, or acting out trending audio, our studio gives your short-form content a massively polished upgrade over filming at home.
            </p>
        </div>
    </section>

    {{-- Studio for Rent / Use cases --}}
    <section class="bg-[var(--color-surface-muted)] py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-3xl text-center mb-10">Optimized for Viral Content</h2>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Instagram Reels</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Batch shoot your weekly reels in hours with perfect lighting conditions that make you glow.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">YouTube Shorts</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Record high-retention 9:16 talking-head videos to grow your subscriber base rapidly.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Fashion & Styling</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Quickly swap outfits in our changing rooms and shoot seamless transition videos.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Brand & Product Demos</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Demonstrate products effectively with sharp macro lenses and bright, aesthetic backgrounds.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Professional Equipment --}}
    <section id="features" class="bg-[var(--color-surface)] py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="mb-16 md:text-center max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">Creator-Focused Features</h2>
                <p class="mt-4 text-lg text-[var(--color-text-muted)]">Designed specifically for the fast-paced needs of social media creators.</p>
            </div>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] p-6">
                    <h3 class="font-semibold text-[var(--color-text-main)]">RGB & Mood Lighting</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Switch the vibe instantly with color-changing RGB panels to match trending aesthetics.</p>
                </div>
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] p-6">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Vertical Video Rigs</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Professional tripods and mounts configured perfectly for native 9:16 vertical recording.</p>
                </div>
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] p-6">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Vanity & Changing Areas</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Look your best with Hollywood mirrors, styling space, and private changing rooms.</p>
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
    <section class="border-t border-[var(--color-border-subtle)] bg-pink-50 py-12">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 text-center">
            <h2 class="text-xl font-bold text-[#2D335A]">Batch Shoot Your Next Viral Reels</h2>
            <p class="mt-2 text-[#555C7A]">Level up your content game. Book the studio today.</p>
            <a href="{{ route('pages.booking') }}" class="mt-6 inline-flex items-center justify-center rounded-lg bg-pink-600 px-8 py-3 text-base font-semibold text-white shadow-sm hover:bg-pink-700">Book Now</a>
        </div>
    </section>
@endsection
