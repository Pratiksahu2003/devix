@extends('layouts.app')

@section('title', 'Podcast Studio on Rent in Delhi NCR | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Book a dedicated podcast studio on rent in Delhi NCR at {{ config('company.brand') }}, with dynamic microphones, treated lighting and comfortable seating for podcasts, talk shows and panel discussions." />
@endsection

@section('content')
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

        $hero = [
            'alt' => 'Podcast Studio Setup',
            'src' => 'storage/studio/DSC01002.JPG',
        ];

        // Studio Images
        $galleryItems = [
            ['src' => 'storage/studio/DSC01002.JPG', 'alt' => 'Podcast Setup'],
            ['src' => 'storage/studio/DSC01003.JPG', 'alt' => 'Recording Session'],
            ['src' => 'storage/studio/DSC01007.JPG', 'alt' => 'Microphone Detail'],
            ['src' => 'storage/studio/DSC01008.JPG', 'alt' => 'Wide Angle View'],
            ['src' => 'storage/studio/DSC01009.JPG', 'alt' => 'Lighting Setup'],
            ['src' => 'storage/studio/DSC01010.JPG', 'alt' => 'Makeup Room'],
            ['src' => 'storage/studio/DSC01012.JPG', 'alt' => 'Seating Arrangement'],
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
            <span class="inline-block rounded-full bg-purple-600/20 border border-purple-500/30 px-4 py-1.5 text-sm font-medium text-purple-200 backdrop-blur-sm mb-6">
                Professional Audio & Video
            </span>
            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl md:text-7xl drop-shadow-lg">
                Broadcast Your<br/>Voice.
            </h1>
            <p class="mt-6 max-w-2xl text-lg sm:text-xl text-gray-200 leading-relaxed drop-shadow-md">
                A dedicated podcast studio with treated acoustics, professional lighting, and comfortable seating.
                Ready for creators and brands.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="#contact" class="rounded-full bg-white px-8 py-3.5 text-base font-semibold text-black transition hover:bg-gray-200 hover:scale-105 transform duration-200">
                    Book Podcast Studio
                </a>
                <a href="#features" class="rounded-full border border-white/30 bg-white/10 px-8 py-3.5 text-base font-semibold text-white backdrop-blur-sm transition hover:bg-white/20">
                    Explore Features
                </a>
            </div>
        </div>
    </div>

    {{-- Features Grid --}}
    <section id="features" class="bg-[var(--color-surface)] py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="mb-16 md:text-center max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">Designed for Conversation</h2>
                <p class="mt-4 text-lg text-[var(--color-text-muted)]">Focus on the content while we handle the environment.</p>
            </div>
            
            <div class="grid gap-x-8 gap-y-12 sm:grid-cols-2 lg:grid-cols-3">
                {{-- Feature 1 --}}
                <div class="group">
                    <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-600 transition group-hover:scale-110 group-hover:bg-purple-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" /></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[var(--color-text-main)]">Pro Audio Gear</h3>
                    <p class="mt-3 text-[var(--color-text-muted)] leading-relaxed">Equipped with dynamic microphones tuned for speech, ensuring your voice sounds rich and clear.</p>
                </div>
                 {{-- Feature 2 --}}
                <div class="group">
                     <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-600 transition group-hover:scale-110 group-hover:bg-purple-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[var(--color-text-main)]">Video Ready</h3>
                    <p class="mt-3 text-[var(--color-text-muted)] leading-relaxed">Lighting that flatters skin tones and keeps the focus on your guests, perfect for YouTube and Reels.</p>
                </div>
                 {{-- Feature 3 --}}
                <div class="group">
                     <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-600 transition group-hover:scale-110 group-hover:bg-purple-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[var(--color-text-main)]">Comfortable Seating</h3>
                    <p class="mt-3 text-[var(--color-text-muted)] leading-relaxed">Seated layout that works for 1–4 speakers, fostering natural and engaging conversations.</p>
                </div>
                 {{-- Feature 4 --}}
                <div class="group">
                     <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-600 transition group-hover:scale-110 group-hover:bg-purple-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" stroke-linecap="round" stroke-linejoin="round" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2" /></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[var(--color-text-main)]">Acoustic Treatment</h3>
                    <p class="mt-3 text-[var(--color-text-muted)] leading-relaxed">Minimizes echo and background noise, ensuring your audio is clean and professional.</p>
                </div>
                 {{-- Feature 5 --}}
                <div class="group">
                     <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-600 transition group-hover:scale-110 group-hover:bg-purple-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[var(--color-text-main)]">Makeup Room</h3>
                    <p class="mt-3 text-[var(--color-text-muted)] leading-relaxed">Access to a dedicated makeup room so you and your guests are camera-ready before recording.</p>
                </div>
                 {{-- Feature 6 --}}
                <div class="group">
                     <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-600 transition group-hover:scale-110 group-hover:bg-purple-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[var(--color-text-main)]">Technical Support</h3>
                    <p class="mt-3 text-[var(--color-text-muted)] leading-relaxed">Our light assistant is available to help shape the look of your show and manage equipment.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Preview --}}
    <section class="bg-[var(--color-surface-muted)] py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-12 gap-4">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)]">Inside the Studio</h2>
                    <p class="mt-4 text-lg text-[var(--color-text-muted)]">A look at the space where conversations happen.</p>
                </div>
                <a href="{{ url('/gallery') }}" class="group inline-flex items-center font-semibold text-purple-600 hover:text-purple-500">
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
                <p class="mt-4 text-[var(--color-text-muted)]">Details about booking our podcast space.</p>
            </div>
            
            <div class="space-y-4" x-data="{ active: 0 }">
                @foreach($faq as $index => $item)
                    <div class="overflow-hidden rounded-2xl border border-[var(--color-border-subtle)] bg-white transition hover:border-purple-200">
                        <button 
                            @click="active = active === {{ $index }} ? null : {{ $index }}"
                            class="flex w-full items-center justify-between px-6 py-5 text-left font-medium text-[var(--color-text-main)] hover:bg-gray-50/50 transition"
                        >
                            <span class="text-lg">{{ $item['q'] }}</span>
                            <span :class="active === {{ $index }} ? 'rotate-180 text-purple-600' : 'text-gray-400'" class="transition-transform duration-200">
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

    {{-- Best Practices --}}
    <section class="border-t border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-xl font-bold tracking-tight text-[var(--color-text-main)] mb-8">Best Practices for Great Shows</h2>
            <div class="grid gap-8 md:grid-cols-2">
                <div class="rounded-2xl bg-white p-8 shadow-sm border border-[var(--color-border-subtle)]">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" /></svg>
                        </div>
                        <h3 class="font-semibold text-[var(--color-text-main)]">Mic Technique</h3>
                    </div>
                    <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">Coach guests to keep a consistent distance and angle to the mic. Use simple hand signals to pause and resume between topics.</p>
                </div>
                <div class="rounded-2xl bg-white p-8 shadow-sm border border-[var(--color-border-subtle)]">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                        </div>
                        <h3 class="font-semibold text-[var(--color-text-main)]">Edit‑Friendly Takes</h3>
                    </div>
                    <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">Record room tone and clap syncs for each camera change to speed up assembly and noise reduction later.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
