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
            'src' => 'storage/room/IMG_0780.jpeg',
        ];

        // Studio Images - Mixing Studio and Room images for a complete vibe
        $galleryItems = [
            ['src' => 'storage/room/IMG_0780.jpeg', 'alt' => 'Studio Ambiance'],
            ['src' => 'storage/room/IMG_0781.jpeg', 'alt' => 'Creative Lighting'],
            ['src' => 'storage/room/IMG_0782.jpeg', 'alt' => 'Podcast Setup'],
            ['src' => 'storage/room/IMG_0783.jpeg', 'alt' => 'Cozy Corner'],
            ['src' => 'storage/room/IMG_0784.jpeg', 'alt' => 'Lounge Area'],
            ['src' => 'storage/room/IMG_0785.jpeg', 'alt' => 'Acoustic Treatment'],
        ];
    @endphp

    <script type="application/ld+json">{!! json_encode($faqLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>

    {{-- Hero Section --}}
    <div class="relative bg-black h-[85vh] min-h-[600px] overflow-hidden group">
        <div class="absolute inset-0 transition-transform duration-1000 group-hover:scale-105">
             <img src="{{ asset($hero['src']) }}" alt="{{ $hero['alt'] }}" class="h-full w-full object-cover opacity-60" />
             <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
             <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-transparent to-transparent"></div>
        </div>
        <div class="relative h-full mx-auto max-w-7xl px-4 flex flex-col justify-center items-center text-center">
            <div class="animate-fade-in-up">
                <span class="inline-block rounded-full bg-purple-500/20 border border-purple-500/30 px-6 py-2 text-sm font-medium text-purple-200 backdrop-blur-md mb-8">
                    <span class="mr-2">●</span> Professional Audio & Video Studio
                </span>
                <h1 class="text-5xl font-bold tracking-tight text-white sm:text-7xl md:text-8xl drop-shadow-2xl">
                    Broadcast<br/>Your Voice.
                </h1>
                <p class="mt-8 max-w-2xl text-xl text-gray-200 leading-relaxed drop-shadow-lg mx-auto font-light">
                    A dedicated podcast suite with acoustically treated walls, professional lighting, and a vibe that sparks conversation.
                </p>
            </div>
            <div class="mt-12 flex flex-col sm:flex-row gap-5 animate-fade-in-up delay-100">
                <a href="#contact" class="rounded-full bg-white px-10 py-4 text-lg font-semibold text-black transition hover:bg-gray-100 hover:scale-105 transform duration-200 shadow-xl shadow-white/10">
                    Book Podcast Studio
                </a>
                <a href="#features" class="rounded-full border border-white/20 bg-white/5 px-10 py-4 text-lg font-semibold text-white backdrop-blur-md transition hover:bg-white/10 hover:border-white/40">
                    Explore Features
                </a>
            </div>
        </div>
    </div>

    {{-- Features Grid --}}
    <section id="features" class="bg-[var(--color-surface)] py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="mb-20 md:text-center max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-5xl mb-6">Designed for Conversation</h2>
                <p class="text-xl text-[var(--color-text-muted)] leading-relaxed">Focus on the content while we handle the environment. Every detail is tuned for creators.</p>
            </div>
            
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                {{-- Feature 1 --}}
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 p-8 transition-all hover:bg-white hover:shadow-xl border border-transparent hover:border-purple-100">
                    <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-600 text-white shadow-lg shadow-purple-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-3">Pro Audio Gear</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">Equipped with dynamic microphones tuned for speech, ensuring your voice sounds rich, clear, and broadcast-ready.</p>
                </div>
                 {{-- Feature 2 --}}
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 p-8 transition-all hover:bg-white hover:shadow-xl border border-transparent hover:border-purple-100">
                     <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-600 text-white shadow-lg shadow-purple-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-3">Video Ready</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">Soft, flattering lighting that keeps the focus on your guests. Perfect for YouTube video podcasts, Reels, and Shorts.</p>
                </div>
                 {{-- Feature 3 --}}
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 p-8 transition-all hover:bg-white hover:shadow-xl border border-transparent hover:border-purple-100">
                     <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-600 text-white shadow-lg shadow-purple-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-3">Comfortable Seating</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">Flexible seating layouts for 1–4 speakers. Foster natural, engaging conversations in a relaxed atmosphere.</p>
                </div>
                 {{-- Feature 4 --}}
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 p-8 transition-all hover:bg-white hover:shadow-xl border border-transparent hover:border-purple-100">
                     <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-600 text-white shadow-lg shadow-purple-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" stroke-linecap="round" stroke-linejoin="round" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-3">Acoustic Treatment</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">Sound-absorbing panels minimize echo and background noise, ensuring your audio is crisp and professional.</p>
                </div>
                 {{-- Feature 5 --}}
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 p-8 transition-all hover:bg-white hover:shadow-xl border border-transparent hover:border-purple-100">
                     <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-600 text-white shadow-lg shadow-purple-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-3">Makeup Room</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">Private access to a well-lit makeup room so you and your guests can get camera-ready before recording.</p>
                </div>
                 {{-- Feature 6 --}}
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 p-8 transition-all hover:bg-white hover:shadow-xl border border-transparent hover:border-purple-100">
                     <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-600 text-white shadow-lg shadow-purple-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-3">Technical Support</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">Our studio assistant is available to help set up lights, adjust mics, and ensure everything runs smoothly.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Preview --}}
    <section class="bg-[var(--color-surface-muted)] py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-12 gap-6">
                <div>
                    <h2 class="text-4xl font-bold tracking-tight text-[var(--color-text-main)]">Inside the Studio</h2>
                    <p class="mt-4 text-xl text-[var(--color-text-muted)]">A look at the space where conversations happen.</p>
                </div>
                <a href="{{ url('/gallery') }}" class="group inline-flex items-center text-lg font-semibold text-purple-600 hover:text-purple-500">
                    View Full Gallery 
                    <svg class="ml-2 h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($galleryItems as $item)
                    <div class="group relative overflow-hidden rounded-2xl bg-gray-200 aspect-[4/5] cursor-pointer shadow-md hover:shadow-xl transition-all duration-300">
                        <img 
                            src="{{ asset($item['src']) }}" 
                            alt="{{ $item['alt'] }}" 
                            class="h-full w-full object-cover transition duration-700 group-hover:scale-110"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 transition duration-300 group-hover:opacity-100 flex items-end p-8">
                            <span class="text-white font-medium text-lg translate-y-4 transition duration-300 group-hover:translate-y-0">{{ $item['alt'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="bg-[var(--color-surface)] py-24">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold tracking-tight text-[var(--color-text-main)]">Common Questions</h2>
                <p class="mt-4 text-xl text-[var(--color-text-muted)]">Everything you need to know before you book.</p>
            </div>
            
            <div class="space-y-6" x-data="{ active: 0 }">
                @foreach($faq as $index => $item)
                    <div class="overflow-hidden rounded-3xl border border-[var(--color-border-subtle)] bg-white transition hover:border-purple-200 hover:shadow-sm">
                        <button 
                            @click="active = active === {{ $index }} ? null : {{ $index }}"
                            class="flex w-full items-center justify-between px-8 py-6 text-left font-medium text-[var(--color-text-main)] hover:bg-gray-50/50 transition"
                        >
                            <span class="text-xl">{{ $item['q'] }}</span>
                            <span :class="active === {{ $index }} ? 'rotate-180 text-purple-600' : 'text-gray-400'" class="transition-transform duration-300">
                                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </span>
                        </button>
                        <div 
                            x-show="active === {{ $index }}" 
                            x-collapse
                            class="border-t border-[var(--color-border-subtle)] bg-gray-50/30 px-8 py-6 text-[var(--color-text-muted)] leading-relaxed text-lg"
                        >
                            {{ $item['a'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Best Practices --}}
    <section class="border-t border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] mb-12">Best Practices for Great Shows</h2>
            <div class="grid gap-8 md:grid-cols-2">
                <div class="rounded-3xl bg-white p-10 shadow-sm border border-[var(--color-border-subtle)] transition hover:shadow-md">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" /></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-[var(--color-text-main)]">Mic Technique</h3>
                    </div>
                    <p class="text-[var(--color-text-muted)] text-lg leading-relaxed">Coach guests to keep a consistent distance (about a fist's width) and angle to the mic. Use simple hand signals to pause and resume between topics to keep the flow natural.</p>
                </div>
                <div class="rounded-3xl bg-white p-10 shadow-sm border border-[var(--color-border-subtle)] transition hover:shadow-md">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-[var(--color-text-main)]">Edit‑Friendly Takes</h3>
                    </div>
                    <p class="text-[var(--color-text-muted)] text-lg leading-relaxed">Record 30 seconds of room tone and use clap syncs for each camera change. This simple step speeds up assembly and noise reduction significantly in post-production.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
