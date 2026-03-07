@extends('layouts.app')

@section('title', 'Podcast Studio in Dwarka, Delhi | Professional Recording – '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Professional podcast studio for rent in Dwarka, Delhi. Record audio & video podcasts, interviews, YouTube content. Fully equipped with broadcast mics, multi-camera setup & studio lighting." />
@endsection

@section('content')
    @php
        $faq = [
            [
                'q' => 'What types of podcasts can be recorded at ' . config('company.brand') . ' Studio?',
                'a' => 'You can record various formats including interview podcasts, video podcasts, business podcasts, educational podcasts, and panel discussions.',
            ],
            [
                'q' => 'Is the podcast studio available for rent?',
                'a' => 'Yes, ' . config('company.brand') . ' offers a fully equipped podcast studio for rent. The studio can be booked for hourly or full-day sessions depending on your recording needs.',
            ],
            [
                'q' => 'Can we record video podcasts at ' . config('company.brand') . '?',
                'a' => 'Yes. The studio supports multi-camera video podcast recording, allowing you to create high-quality podcast videos for YouTube and other platforms.',
            ],
            [
                'q' => 'Where is ' . config('company.brand') . ' Podcast Studio located?',
                'a' => config('company.brand') . ' Podcast Studio is located in Dwarka Sector-13, New Delhi, making it convenient for creators across Delhi NCR.',
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
    <div class="relative bg-slate-950 h-[90vh] min-h-[640px] overflow-hidden group">
        <div class="absolute inset-0 transition-transform duration-[1.2s] ease-out group-hover:scale-[1.03]">
            <img src="{{ asset($hero['src']) }}" alt="{{ $hero['alt'] }}" class="h-full w-full object-cover object-center" />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-slate-950/30"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-transparent to-transparent"></div>
        </div>
        <div class="relative h-full mx-auto max-w-7xl px-4 sm:px-6 flex flex-col justify-center items-center text-center">
            <div class="max-w-4xl">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 border border-white/20 px-5 py-2 text-xs font-semibold text-white/90 backdrop-blur-xl mb-8 tracking-widest uppercase">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Professional Audio & Video Studio
                </span>
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-6xl md:text-7xl lg:text-8xl leading-[1.05]">
                    Podcast Studio<br class="hidden sm:block" />
                    <span class="bg-gradient-to-r from-white via-purple-200 to-purple-400 bg-clip-text text-transparent">Dwarka, Delhi</span>
                </h1>
                <p class="mt-6 max-w-2xl text-lg sm:text-xl text-slate-300 leading-relaxed mx-auto font-light">
                    Professional Podcast Recording Studio – {{ config('company.brand') }}
                </p>
            </div>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="#contact" class="group inline-flex items-center justify-center gap-2 rounded-full bg-white px-8 py-4 text-base font-bold text-slate-900 transition-all duration-300 hover:bg-slate-100 hover:scale-[1.02] active:scale-[0.98] shadow-2xl shadow-black/30">
                    Book Podcast Studio
                    <svg class="h-5 w-5 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
                <a href="#features" class="inline-flex items-center justify-center rounded-full border-2 border-white/30 bg-white/5 px-8 py-4 text-base font-semibold text-white backdrop-blur-sm transition-all duration-300 hover:bg-white/15 hover:border-white/50">
                    Explore Features
                </a>
            </div>
            <div class="mt-12 flex gap-10 text-center text-white/70 text-sm">
                <div><span class="block text-2xl font-bold text-white">Pro</span>Equipment</div>
                <div><span class="block text-2xl font-bold text-white">Multi-Cam</span>Video Ready</div>
                <div><span class="block text-2xl font-bold text-white">Dwarka</span>Sector 13</div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-[var(--color-surface)] to-transparent pointer-events-none"></div>
    </div>

    {{-- Intro - Divided into Cards --}}
    <section class="bg-[var(--color-surface)] py-20 sm:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <p class="text-xs font-semibold tracking-[0.2em] uppercase text-purple-600 mb-8 text-center">Welcome to {{ config('company.brand') }}</p>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="rounded-2xl lg:rounded-3xl bg-white p-6 sm:p-8 shadow-lg shadow-slate-200/50 border border-[var(--color-border-subtle)] transition-all duration-300 hover:shadow-xl hover:shadow-purple-500/5 hover:border-purple-200">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-[var(--color-text-main)] mb-3">Your Studio Awaits</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">
                        Looking for a <strong class="text-[var(--color-text-main)]">professional podcast studio in Delhi</strong> to record your next podcast or interview? Welcome to {{ config('company.brand') }} Podcast Studio, a fully equipped podcast recording space located in Dwarka Sector-13, New Delhi, designed for creators, influencers, entrepreneurs, and brands.
                    </p>
                </div>
                <div class="rounded-2xl lg:rounded-3xl bg-white p-6 sm:p-8 shadow-lg shadow-slate-200/50 border border-[var(--color-border-subtle)] transition-all duration-300 hover:shadow-xl hover:shadow-purple-500/5 hover:border-purple-200">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-[var(--color-text-main)] mb-3">Pro Equipment & Setup</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">
                        At {{ config('company.brand') }}, we provide a high-quality podcast studio for rent where you can record audio podcasts, video podcasts, interviews, talk shows, and content for YouTube or social media. Our studio combines professional audio equipment, multi-camera video recording, studio lighting, and a comfortable creative environment to help you produce polished and engaging podcast content.
                    </p>
                </div>
                <div class="rounded-2xl lg:rounded-3xl bg-white p-6 sm:p-8 shadow-lg shadow-slate-200/50 border border-[var(--color-border-subtle)] transition-all duration-300 hover:shadow-xl hover:shadow-purple-500/5 hover:border-purple-200">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-[var(--color-text-main)] mb-3">Ready for Any Project</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">
                        Whether you are launching your first podcast or recording a professional interview series, {{ config('company.brand') }} provides the technology, studio space, and production setup needed to create high-quality content.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Podcast Studio for Rent in Delhi --}}
    <section id="features" class="bg-[var(--color-surface-muted)] py-20 sm:py-28">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl mb-8">Podcast Studio for Rent in Delhi</h2>
            <div class="rounded-2xl lg:rounded-3xl bg-white p-8 sm:p-10 shadow-lg shadow-slate-200/50 border border-[var(--color-border-subtle)] mb-8">
                <p class="text-lg text-[var(--color-text-muted)] leading-relaxed mb-6">
                    {{ config('company.brand') }} offers a fully equipped podcast studio available for rent in Dwarka, Delhi, allowing creators and businesses to record podcasts in a professional environment without investing in expensive equipment.
                </p>
                <p class="text-lg text-[var(--color-text-muted)] font-medium mb-4">Our podcast studio rental service is perfect for:</p>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach(['Podcast recording and interview shows', 'YouTube podcast videos', 'Business and brand storytelling podcasts', 'Influencer collaborations', 'Educational podcasts and discussions', 'Panel conversations and round-table podcasts'] as $item)
                    <div class="flex items-center gap-3 rounded-xl bg-purple-50/50 border border-purple-100 p-4 transition-all duration-300 hover:bg-purple-50 hover:border-purple-200">
                        <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </span>
                        <span class="text-[var(--color-text-muted)]">{{ $item }}</span>
                    </div>
                    @endforeach
                </div>
                <p class="text-lg text-[var(--color-text-muted)] leading-relaxed mt-6 mb-4">
                    The studio can be booked for hourly sessions, half-day recordings, or full-day productions, providing flexibility for both individual creators and professional production teams.
                </p>
                <p class="text-lg text-[var(--color-text-muted)] leading-relaxed">
                    By recording in a professional podcast studio, creators can achieve clear sound quality, professional visuals, and a distraction-free recording environment, making their content more engaging for listeners and viewers.
                </p>
            </div>
        </div>
    </section>

    {{-- Professional Podcast Equipment --}}
    <section class="bg-[var(--color-surface)] py-20 sm:py-28">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl mb-8">Professional Podcast Equipment</h2>
            <p class="text-lg text-[var(--color-text-muted)] leading-relaxed mb-10 max-w-3xl">
                {{ config('company.brand') }} Podcast Studio is equipped with industry-grade audio and video equipment to ensure your podcast recordings meet professional standards.
            </p>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach([
                    ['Broadcast-quality microphones', 'Crystal-clear voice recording', 'M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z'],
                    ['Professional audio mixers', 'Recording systems included', 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3'],
                    ['Multi-camera video', 'Video podcast recording', 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'],
                    ['Studio lighting', 'High-quality visuals', 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
                    ['Comfortable seating', 'Interview setup ready', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                ] as $eq)
                <div class="group rounded-2xl lg:rounded-3xl bg-white p-6 sm:p-8 shadow-lg shadow-slate-200/50 border border-[var(--color-border-subtle)] transition-all duration-300 hover:shadow-xl hover:shadow-purple-500/5 hover:border-purple-200">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center mb-4 group-hover:bg-purple-600 transition-all duration-300">
                        <svg class="w-6 h-6 text-purple-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $eq[2] }}" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-[var(--color-text-main)] mb-2">{{ $eq[0] }}</h3>
                    <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">{{ $eq[1] }}</p>
                </div>
                @endforeach
            </div>
      
        </div>
    </section>

    {{-- Multi-Camera Video Podcast Setup --}}
    <section class="bg-[var(--color-surface-muted)] py-20 sm:py-28">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl mb-8">Multi-Camera Video Podcast Setup</h2>
            <div class="rounded-2xl lg:rounded-3xl bg-white p-8 sm:p-10 shadow-lg shadow-slate-200/50 border border-[var(--color-border-subtle)] mb-8">
                <p class="text-lg text-[var(--color-text-muted)] leading-relaxed mb-6">
                    Modern podcasts often include video recording for platforms like YouTube and social media, and {{ config('company.brand') }} Podcast Studio is designed to support this format.
                </p>
                <p class="text-lg text-[var(--color-text-muted)] font-medium mb-6">Our studio offers a multi-camera video podcast setup, allowing you to record:</p>
                <div class="grid sm:grid-cols-2 gap-4 mb-6">
                    @foreach(['Host and guest conversations', 'Two-person interviews', 'Group discussions and panel podcasts', 'Professional talk shows'] as $item)
                    <div class="flex items-center gap-3 rounded-xl bg-purple-50/50 border border-purple-100 p-4 transition-all duration-300 hover:bg-purple-50 hover:border-purple-200">
                        <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </span>
                        <span class="text-[var(--color-text-muted)]">{{ $item }}</span>
                    </div>
                    @endforeach
                </div>
                <p class="text-lg text-[var(--color-text-muted)] leading-relaxed">
                    Multiple camera angles help create dynamic and engaging podcast videos, making your content more visually appealing for viewers.
                </p>
            </div>
        </div>
    </section>

    {{-- Designed for Creators, Influencers, and Brands --}}
    <section class="bg-[var(--color-surface)] py-20 sm:py-28">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl mb-8">Designed for Creators, Influencers, and Brands</h2>
            <div class="rounded-2xl lg:rounded-3xl bg-white p-8 sm:p-10 shadow-lg shadow-slate-200/50 border border-[var(--color-border-subtle)]">
                <p class="text-lg text-[var(--color-text-muted)] leading-relaxed mb-6">
                    {{ config('company.brand') }} Podcast Studio is built for modern digital creators and businesses who want to produce professional podcast content without complex technical setups.
                </p>
                <p class="text-lg text-[var(--color-text-muted)] font-medium mb-6">Our studio is ideal for:</p>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    @foreach(['Podcasters and content creators', 'YouTubers and influencers', 'Business leaders and entrepreneurs', 'Marketing and advertising teams', 'Coaches, speakers, and educators', 'Brands creating storytelling content'] as $item)
                    <div class="flex items-center gap-3 rounded-xl bg-purple-50/50 border border-purple-100 p-4 transition-all duration-300 hover:bg-purple-50 hover:border-purple-200">
                        <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </span>
                        <span class="text-[var(--color-text-muted)]">{{ $item }}</span>
                    </div>
                    @endforeach
                </div>
                <p class="text-lg text-[var(--color-text-muted)] leading-relaxed">
                    Whether you are recording a business podcast, interview series, influencer collaboration, or knowledge-sharing podcast, {{ config('company.brand') }} provides the perfect space for your production.
                </p>
            </div>
        </div>
    </section>

    {{-- Why Choose DyWix Podcast Studio --}}
    <section class="bg-[var(--color-surface)] py-20 sm:py-28">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <p class="text-xs font-semibold tracking-[0.2em] uppercase text-purple-600 mb-4">Why Us</p>
            <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl mb-8">Why Choose {{ config('company.brand') }} Podcast Studio</h2>
            <p class="text-lg text-[var(--color-text-muted)] leading-relaxed mb-12 max-w-2xl">
                There are many reasons creators choose {{ config('company.brand') }} for their podcast recordings.
            </p>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="group rounded-2xl border border-[var(--color-border-subtle)] bg-white p-6 transition-all duration-300 hover:border-purple-200 hover:shadow-lg hover:shadow-purple-500/5">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-5 h-5 text-purple-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-[var(--color-text-main)] mb-2">Professional Environment</h3>
                    <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">A quiet, controlled space designed for podcast production.</p>
                </div>
                <div class="group rounded-2xl border border-[var(--color-border-subtle)] bg-white p-6 transition-all duration-300 hover:border-purple-200 hover:shadow-lg hover:shadow-purple-500/5">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-5 h-5 text-purple-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-[var(--color-text-main)] mb-2">Pro Audio & Video</h3>
                    <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">Clean audio and sharp visuals with pro equipment.</p>
                </div>
                <div class="group rounded-2xl border border-[var(--color-border-subtle)] bg-white p-6 transition-all duration-300 hover:border-purple-200 hover:shadow-lg hover:shadow-purple-500/5">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-5 h-5 text-purple-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-[var(--color-text-main)] mb-2">Flexible Booking</h3>
                    <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">Hourly, half-day, or full-day sessions available.</p>
                </div>
                <div class="group rounded-2xl border border-[var(--color-border-subtle)] bg-white p-6 transition-all duration-300 hover:border-purple-200 hover:shadow-lg hover:shadow-purple-500/5">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-5 h-5 text-purple-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-[var(--color-text-main)] mb-2">Creator-Friendly</h3>
                    <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">Relaxed, focused space for your best recordings.</p>
                </div>
                <div class="group rounded-2xl border border-[var(--color-border-subtle)] bg-white p-6 transition-all duration-300 hover:border-purple-200 hover:shadow-lg hover:shadow-purple-500/5 sm:col-span-2 lg:col-span-1">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-5 h-5 text-purple-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-[var(--color-text-main)] mb-2">Dwarka, Delhi</h3>
                    <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">Easily accessible from across Delhi NCR.</p>
                </div>
            </div>
            <p class="mt-10 text-lg text-[var(--color-text-muted)] leading-relaxed">
                At {{ config('company.brand') }}, our goal is to help creators produce high-quality podcasts that look and sound professional.
            </p>
        </div>
    </section>

    {{-- Gallery Preview --}}
    <section class="bg-[var(--color-surface-muted)] py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-12 gap-6">
                <div>
                    <p class="text-xs font-semibold tracking-[0.2em] uppercase text-purple-600 mb-4">Gallery</p>
                    <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-[var(--color-text-main)]">Inside the Studio</h2>
                    <p class="mt-4 text-lg text-[var(--color-text-muted)]">A look at the space where conversations happen.</p>
                </div>
                <a href="{{ url('/gallery') }}" class="group inline-flex items-center text-lg font-semibold text-purple-600 hover:text-purple-500">
                    View Full Gallery 
                    <svg class="ml-2 h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach($galleryItems as $item)
                    <div class="group relative overflow-hidden rounded-2xl lg:rounded-3xl bg-gray-200 aspect-[4/5] cursor-pointer shadow-lg hover:shadow-2xl hover:shadow-purple-500/10 transition-all duration-500 ring-1 ring-black/5 hover:ring-purple-300/30">
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
    <section class="bg-[var(--color-surface)] py-20 sm:py-28">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-[var(--color-text-main)]">Frequently Asked Questions</h2>
                <p class="mt-4 text-lg text-[var(--color-text-muted)]">Everything you need to know before you book.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 lg:gap-6" x-data="{ active: null }">
                @foreach($faq as $index => $item)
                    <div class="overflow-hidden rounded-2xl lg:rounded-3xl border border-[var(--color-border-subtle)] bg-white transition-all duration-300 hover:border-purple-200 hover:shadow-lg hover:shadow-purple-500/5">
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

    {{-- Location --}}
    <section class="border-t border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] py-16 sm:py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <p class="text-xs font-semibold tracking-[0.2em] uppercase text-purple-600 mb-4">Find Us</p>
            <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-[var(--color-text-main)] mb-8">Convenient Podcast Studio Location</h2>
            <div class="group rounded-2xl lg:rounded-3xl bg-white p-8 sm:p-10 shadow-lg shadow-slate-200/50 border border-[var(--color-border-subtle)] transition-all duration-300 hover:shadow-xl hover:shadow-purple-500/5 hover:border-purple-200">
                <div class="flex items-start gap-6">
                    <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-purple-100 flex items-center justify-center group-hover:bg-purple-600 transition-colors duration-300">
                        <svg class="w-7 h-7 text-purple-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-lg text-[var(--color-text-muted)] leading-relaxed mb-6">{{ config('company.brand') }} Podcast Studio is located in <strong class="text-[var(--color-text-main)]">Dwarka Sector-13, New Delhi</strong>, making it easily accessible for creators across Delhi NCR including West Delhi, Janakpuri, Gurugram, and nearby areas. The studio's location provides a professional and private environment for podcast recording, away from the noise and distractions of typical home setups.</p>
                        <a href="{{ route('pages.location') }}" class="inline-flex items-center font-semibold text-purple-600 hover:text-purple-500 transition-colors">
                            View location &amp; access
                            <svg class="ml-2 h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
   

    {{-- Best Practices --}}
    <section class="border-t border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)] py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <p class="text-xs font-semibold tracking-[0.2em] uppercase text-purple-600 mb-4">Pro Tips</p>
            <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl mb-12">Best Practices for Great Shows</h2>
            <div class="grid gap-6 lg:gap-8 md:grid-cols-2">
                <div class="group rounded-2xl lg:rounded-3xl bg-white p-8 lg:p-10 shadow-sm border border-[var(--color-border-subtle)] transition-all duration-300 hover:shadow-xl hover:shadow-purple-500/5 hover:border-purple-100">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" /></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-[var(--color-text-main)]">Mic Technique</h3>
                    </div>
                    <p class="text-[var(--color-text-muted)] text-lg leading-relaxed">Coach guests to keep a consistent distance (about a fist's width) and angle to the mic. Use simple hand signals to pause and resume between topics to keep the flow natural.</p>
                </div>
                <div class="group rounded-2xl lg:rounded-3xl bg-white p-8 lg:p-10 shadow-sm border border-[var(--color-border-subtle)] transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/5 hover:border-blue-100">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform duration-300">
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
