@extends('layouts.app')

@section('title', 'Corporate Film Production Studio in Delhi | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Create impactful corporate films, company profiles, and brand documentaries at our fully equipped video production studio in Dwarka, New Delhi." />
@endsection

@section('content')
    @php
        $faq = [
            [
                'q' => 'What kind of corporate content can I shoot here?',
                'a' => 'Our studio is ideal for CEO messages, internal training videos, company profile films, CSR documentaries, pitch videos, and corporate announcements.',
            ],
            [
                'q' => 'Do you provide a teleprompter?',
                'a' => 'Yes, we can provide professional teleprompter setups to help executives and speakers deliver their messages flawlessly on camera.',
            ],
            [
                'q' => 'Is the studio quiet enough for interviews?',
                'a' => 'Yes, our space features acoustic treatment to minimize outside noise and echo, ensuring pristine audio quality for interviews and dialogue.',
            ],
            [
                'q' => 'Can we customize the backdrop for our brand?',
                'a' => 'Absolutely. We offer various background options including plain colored paper rolls, green screens, and customizable lighting that can match your brand colors.',
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
            'alt' => 'Corporate film production and interview setup',
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
            <img src="{{ asset($hero['src']) }}" alt="{{ $hero['alt'] }}" class="h-full w-full object-cover opacity-60" onerror="this.src='https://placehold.co/1200x800/1e1e1e/333333?text=Corporate+Film+Studio'"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        </div>
        <div class="relative h-full mx-auto max-w-6xl px-4 flex flex-col justify-center items-center text-center">
            <span class="inline-block rounded-full bg-slate-600/20 border border-slate-500/30 px-4 py-1.5 text-sm font-medium text-slate-200 backdrop-blur-sm mb-6">
                Corporate Video Studio
            </span>
            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl md:text-7xl drop-shadow-lg">
                Professional Corporate Films
            </h1>
            <p class="mt-6 max-w-2xl text-lg sm:text-xl text-gray-200 leading-relaxed drop-shadow-md">
                Elevate your brand's communications. A premium, quiet studio space for executive interviews, company profiles, and corporate documentaries.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('pages.booking') }}" class="inline-flex items-center justify-center rounded-lg bg-slate-700 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-slate-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-700">
                    Reserve the Studio
                </a>
                <a href="#features" class="inline-flex items-center justify-center rounded-lg border border-white/30 bg-white/10 px-6 py-3 text-base font-semibold text-white backdrop-blur-sm hover:bg-white/20">
                    View Features
                </a>
            </div>
        </div>
    </div>

    {{-- Intro --}}
    <section class="bg-white py-16 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 text-center">
            <p class="text-lg text-[var(--color-text-muted)] leading-relaxed">
                Trust building begins with professional presentation. {{ config('company.brand') }} provides a <strong class="text-[var(--color-text-main)]">sophisticated and distraction-free environment</strong> for corporate videography in Delhi NCR. From crisp audio capture for CEO messages to highly polished lighting for investor pitches, our studio is designed to make your executives look and sound their absolute best.
            </p>
        </div>
    </section>

    {{-- Studio for Rent / Use cases --}}
    <section class="bg-[var(--color-surface-muted)] py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-3xl text-center mb-10">Corporate Video Solutions</h2>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Executive Interviews</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Flattering lighting and premium audio setups ensure your leadership team projects professionalism and authority.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Internal Training</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Record scalable, high-quality training modules and onboarding videos for your employees.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Company Profiles</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Shoot foundational brand documentaries and "About Us" videos with complete creative control.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-[var(--color-border-subtle)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Investor Pitches</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Deliver confident, crystal-clear pitch videos to stakeholders and investors in a premium setting.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Professional Equipment --}}
    <section id="features" class="bg-[var(--color-surface)] py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="mb-16 md:text-center max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">Why Choose Us For Corporate Films?</h2>
                <p class="mt-4 text-lg text-[var(--color-text-muted)]">A reliable, fully-managed space that respects your time and your brand's image.</p>
            </div>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] p-6">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Teleprompter Support</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Reduce re-takes and keep executives comfortable with easy-to-read, professional teleprompter screens.</p>
                </div>
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] p-6">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Pristine Audio</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">Acoustically treated walls and top-tier lavalier/boom microphones ensure zero distracting background noise.</p>
                </div>
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] p-6">
                    <h3 class="font-semibold text-[var(--color-text-main)]">Professional Environment</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">A clean, air-conditioned workspace with lounges and dressing areas suitable for high-level guests.</p>
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
    <section class="border-t border-[var(--color-border-subtle)] bg-slate-50 py-12">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 text-center">
            <h2 class="text-xl font-bold text-[#2D335A]">Book Your Corporate Video Shoot</h2>
            <p class="mt-2 text-[#555C7A]">Ensure a seamless, professional production experience.</p>
            <a href="{{ route('pages.booking') }}" class="mt-6 inline-flex items-center justify-center rounded-lg bg-slate-700 px-8 py-3 text-base font-semibold text-white shadow-sm hover:bg-slate-800">Book Now</a>
        </div>
    </section>
@endsection
