@extends('layouts.app')

@section('title', config('company.brand').' | Premier Podcast & Content Studio in Delhi NCR')

@section('content')
    {{-- Hero Section - Cinematic & Bold --}}
    <section class="relative w-full min-h-[85vh] md:min-h-[80vh] flex items-center overflow-hidden group"
             x-data="{ slide: 0, total: 6, paused: false, startTimer() { return setInterval(() => { if (!this.paused) this.slide = (this.slide + 1) % this.total }, 4500) }, timer: null }"
             x-init="timer = startTimer(); $watch('slide', () => { clearInterval(timer); timer = startTimer() })"
             @mouseenter="paused = true"
             @mouseleave="paused = false">
        {{-- Background images with zoom + fade --}}
        <div class="absolute inset-0">
            @foreach(['IMG_0785.jpeg', 'IMG_0769.jpeg', 'IMG_0784.jpeg', 'IMG_0780.jpeg', 'IMG_0781.jpeg', 'IMG_0783.jpeg'] as $i => $img)
                <div x-show="slide === {{ $i }}"
                     x-transition:enter="transition ease-out duration-1200"
                     x-transition:enter-start="opacity-0 scale-110"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-1200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-105"
                     class="absolute inset-0"
                     :class="{ 'z-10': slide === {{ $i }} }">
                    <img src="{{ asset('storage/room/' . $img) }}" alt="Studio {{ $i + 1 }}" class="h-full w-full object-cover object-center">
                </div>
            @endforeach
            {{-- Dramatic overlay --}}
            <div class="absolute inset-0 z-20 bg-gradient-to-r from-black via-black/90 to-black/40 pointer-events-none"></div>
            <div class="absolute inset-0 z-20 bg-gradient-to-t from-black/60 via-transparent to-black/40 pointer-events-none"></div>
            {{-- Film-style corner accents --}}
            <div class="absolute inset-0 z-20 pointer-events-none border-[3px] border-white/10 md:border-white/20" style="border-radius: 2px;"></div>
            <div class="absolute top-8 left-8 right-8 h-px bg-gradient-to-r from-transparent via-red-500/40 to-transparent z-20 pointer-events-none"></div>
            {{-- Subtle film grain --}}
            <div class="absolute inset-0 z-20 pointer-events-none opacity-[0.03] mix-blend-overlay" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 256 256%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noise%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.9%22 numOctaves=%224%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noise)%22/%3E%3C/svg%3E');"></div>
        </div>

        <div class="relative z-30 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-12 lg:gap-16">
                {{-- Left: Content --}}
                <div class="max-w-2xl reveal-up" x-intersect="$el.classList.add('is-visible')">
                    {{-- Live badge --}}
                    <div class="inline-flex items-center gap-2 rounded-full border border-red-500/60 bg-red-500/15 px-4 py-2 mb-6 backdrop-blur-sm shadow-[0_0_20px_rgba(220,38,38,0.2)]">
                        <span class="h-2 w-2 rounded-full bg-red-400 animate-pulse shadow-[0_0_8px_rgba(220,38,38,0.8)]"></span>
                        <span class="text-[10px] font-bold tracking-[0.35em] text-red-300 uppercase">Studio Open 24/7</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white leading-[1.05] tracking-tight">
                        <span class="block font-sans">Your Creative</span>
                        <span class="block mt-1 font-serif bg-gradient-to-r from-white via-red-200 to-red-500 bg-clip-text text-transparent bg-[length:200%_auto] animate-gradient" style="text-shadow: 0 0 60px rgba(220,38,38,0.4);">Space Awaits</span>
                    </h1>
                    <p class="mt-5 text-lg md:text-xl text-gray-300 max-w-lg leading-relaxed">
                        Pro gear, versatile sets & 24/7 access. Fashion, product, commercial & videography — all under one roof.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('pages.booking') }}" class="group/btn inline-flex items-center gap-2 rounded-full bg-red-600 px-8 py-4 text-sm font-bold text-white shadow-[0_0_40px_rgba(220,38,38,0.5)] transition-all duration-300 hover:bg-red-500 hover:shadow-[0_0_50px_rgba(220,38,38,0.7)] hover:scale-105 active:scale-[0.98]">
                            Book Now
                            <svg class="h-5 w-5 transition-transform group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </a>
                        <a href="{{ route('pages.gallery') }}" class="inline-flex items-center gap-2 rounded-full border-2 border-white/50 bg-white/5 px-8 py-4 text-sm font-semibold text-white backdrop-blur-sm transition-all duration-300 hover:bg-white/15 hover:border-white/70">
                            View Gallery
                        </a>
                    </div>

                    {{-- Trust strip --}}
                    <div class="mt-10 flex flex-wrap gap-8 text-white/60 text-sm">
                        <span class="flex items-center gap-2"><span class="font-bold text-white">500+</span> Shoots</span>
                        <span class="flex items-center gap-2"><span class="font-bold text-white">150+</span> Clients</span>
                        <span class="flex items-center gap-2"><span class="font-bold text-red-400">24/7</span> Access</span>
                    </div>
                </div>

                {{-- Right: Floating image card (synced with slide) --}}
                <div class="hidden lg:block flex-shrink-0 reveal-up delay-200" x-intersect="$el.classList.add('is-visible')">
                    <div class="relative w-72 xl:w-80 aspect-[4/5] rounded-2xl overflow-hidden border-2 border-white/20 shadow-2xl shadow-black/50 ring-2 ring-white/10">
                        @foreach(['IMG_0785.jpeg', 'IMG_0769.jpeg', 'IMG_0784.jpeg', 'IMG_0780.jpeg', 'IMG_0781.jpeg', 'IMG_0783.jpeg'] as $i => $img)
                            <div x-show="slide === {{ $i }}"
                                 x-transition:enter="transition ease-out duration-700"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-500"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0"
                                 class="absolute inset-0">
                                <img src="{{ asset('storage/room/' . $img) }}" alt="Studio" class="h-full w-full object-cover">
                            </div>
                        @endforeach
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span class="text-xs font-bold tracking-widest text-white/90 uppercase">DYWIX Studio</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Slide dots --}}
            <div class="absolute bottom-6 right-6 flex gap-2 z-30">
                @foreach(range(0, 5) as $i)
                    <button @click="slide = {{ $i }}" class="rounded-full transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500/60 focus:ring-offset-2 focus:ring-offset-transparent"
                            :class="slide === {{ $i }} ? 'bg-red-500 w-8 h-2' : 'bg-white/30 hover:bg-white/50 w-2 h-2'"
                            aria-label="Slide {{ $i + 1 }}"></button>
                @endforeach
            </div>

            {{-- Scroll hint --}}
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 hidden md:flex flex-col items-center gap-1 text-white/40">
                <span class="text-[10px] font-medium tracking-widest uppercase">Scroll</span>
                <svg class="h-5 w-5 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
            </div>
        </div>
    </section>

    {{-- Scrolling Text Marquee (Modern Infinite) --}}
    <div class="relative overflow-hidden bg-black py-6 md:py-8 border-b border-white/10">
        {{-- Gradient Masks --}}
        <div class="pointer-events-none absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-black to-transparent z-10"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-black to-transparent z-10"></div>

        <div class="marquee-track flex items-center gap-16 hover:[animation-play-state:paused]">
                <div class="flex items-center gap-16 shrink-0">
                    @foreach(['Video Production', 'Podcast & Interview', 'Professional Model Portfolio', 'Live Streaming', 'Advertisement', 'Professional Photography', 'Video Editing', 'Studio for Rentals', 'Kid Portfolio Shoot', 'Creative Space'] as $index => $text)
                        <div class="flex items-center gap-6">
                            <span class="text-2xl font-black uppercase italic tracking-tighter transition-colors duration-300 hover:text-blue-600 {{ $index % 2 != 0 ? 'text-transparent' : 'text-white' }}" 
                                  style="{{ $index % 2 != 0 ? '-webkit-text-stroke: 1px rgba(255,255,255,0.4);' : '' }}">
                                {{ $text }}
                            </span>
                            {{-- Separator --}}
                            <svg class="h-8 w-8 text-blue-600 animate-spin-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                    @endforeach
                </div>
        </div>
    </div>

        {{-- NEW SECTION 1: Trusted By (Logos - Modern Infinite Loop) --}}
        <section class="bg-white py-12 border-b border-gray-100 overflow-hidden">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mb-8 text-center">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-blue-500 mb-2">Our Network</p>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Trusted by Industry Leaders</h2>
            </div>
            
            <div class="relative w-full overflow-hidden">
                {{-- Gradient Masks --}}
                <div class="pointer-events-none absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-white to-transparent z-10"></div>
                <div class="pointer-events-none absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-white to-transparent z-10"></div>

                {{-- Infinite Marquee Track --}}
                <div class="marquee-track flex items-center gap-12 hover:[animation-play-state:paused] py-4">
                    {{-- Double the content for seamless loop --}}
                    @foreach(range(1, 2) as $loop)
                        <div class="flex items-center gap-12 shrink-0">
                            @foreach(range(1, 9) as $i)
                                <div class="group relative flex h-30 w-32 items-center justify-center ">
                                    <img src="{{ asset('brand/' . $i . '.png') }}" 
                                         class="max-h-20 w-auto object-contain" 
                                         alt="Client Logo {{ $i }}">
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- NEW SECTION 2: Visual Sets Video Grid --}}
        <section class="bg-white py-20 text-gray-900">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 flex items-end justify-between reveal-up" x-intersect="$el.classList.add('is-visible')">
                    <div>
                        <span class="text-blue-500 font-bold tracking-widest uppercase text-xs">Visual Experience</span>
                        <h2 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl text-gray-900">Versatile Sets</h2>
                    </div>
                    <a href="{{ route('pages.gallery') }}" class="hidden text-sm font-medium text-gray-600 hover:text-gray-900 sm:block group">
                        View Gallery <span class="inline-block transition-transform group-hover:translate-x-1">→</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-[500px] md:h-[400px]">
                    {{-- Card 1: Fashion --}}
                    <div class="group relative h-full w-full overflow-hidden rounded-2xl bg-gray-100 reveal-up" 
                         x-intersect="$el.classList.add('is-visible')"
                         x-data="{ hover: false, rotateX: 0, rotateY: 0 }"
                         @mousemove="
                            const rect = $el.getBoundingClientRect();
                            const x = $event.clientX - rect.left;
                            const y = $event.clientY - rect.top;
                            rotateY = ((x - rect.width / 2) / rect.width) * 20;
                            rotateX = ((y - rect.height / 2) / rect.height) * -20;
                         "
                         @mouseleave="rotateX = 0; rotateY = 0; hover = false"
                         @mouseenter="hover = true"
                         :style="`transform: perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(${hover ? 1.02 : 1}); transition: transform 0.1s ease-out;`">
                        <img src="{{ asset('storage/room/IMG_0780.jpeg') }}" class="h-full w-full object-cover transition-transform duration-700 scale-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                        
                        {{-- Shine Effect --}}
                        <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/20 to-transparent translate-x-[-100%] transition-transform duration-1000 group-hover:translate-x-[100%]"></div>

                        <div class="absolute bottom-6 left-6 translate-y-4 transition-transform duration-500 group-hover:translate-y-0">
                            <h3 class="text-xl font-bold text-white">Fashion & Editorial</h3>
                            <p class="text-sm text-gray-300 opacity-0 transition-opacity duration-500 group-hover:opacity-100">Cyclorama wall & colored backdrops</p>
                        </div>
                    </div>

                    {{-- Card 2: Podcast --}}
                    <div class="group relative h-full w-full overflow-hidden rounded-2xl bg-gray-100 reveal-up delay-100" 
                         x-intersect="$el.classList.add('is-visible')"
                         x-data="{ hover: false, rotateX: 0, rotateY: 0 }"
                         @mousemove="
                            const rect = $el.getBoundingClientRect();
                            const x = $event.clientX - rect.left;
                            const y = $event.clientY - rect.top;
                            rotateY = ((x - rect.width / 2) / rect.width) * 20;
                            rotateX = ((y - rect.height / 2) / rect.height) * -20;
                         "
                         @mouseleave="rotateX = 0; rotateY = 0; hover = false"
                         @mouseenter="hover = true"
                         :style="`transform: perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(${hover ? 1.02 : 1}); transition: transform 0.1s ease-out;`">
                        <img src="{{ asset('storage/room/IMG_0781.jpeg') }}" class="h-full w-full object-cover transition-transform duration-700 scale-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                        
                        {{-- Shine Effect --}}
                        <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/20 to-transparent translate-x-[-100%] transition-transform duration-1000 group-hover:translate-x-[100%]"></div>

                        <div class="absolute bottom-6 left-6 translate-y-4 transition-transform duration-500 group-hover:translate-y-0">
                            <h3 class="text-xl font-bold text-white">Video Podcast</h3>
                            <p class="text-sm text-gray-300 opacity-0 transition-opacity duration-500 group-hover:opacity-100">4-person setup with 3-camera angles</p>
                        </div>
                    </div>

                    {{-- Card 3: Product --}}
                    <div class="group relative h-full w-full overflow-hidden rounded-2xl bg-gray-100 reveal-up delay-200" 
                         x-intersect="$el.classList.add('is-visible')"
                         x-data="{ hover: false, rotateX: 0, rotateY: 0 }"
                         @mousemove="
                            const rect = $el.getBoundingClientRect();
                            const x = $event.clientX - rect.left;
                            const y = $event.clientY - rect.top;
                            rotateY = ((x - rect.width / 2) / rect.width) * 20;
                            rotateX = ((y - rect.height / 2) / rect.height) * -20;
                         "
                         @mouseleave="rotateX = 0; rotateY = 0; hover = false"
                         @mouseenter="hover = true"
                         :style="`transform: perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(${hover ? 1.02 : 1}); transition: transform 0.1s ease-out;`">
                        <img src="{{ asset('storage/room/IMG_0782.jpeg') }}" class="h-full w-full object-cover transition-transform duration-700 scale-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                        
                        {{-- Shine Effect --}}
                        <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/20 to-transparent translate-x-[-100%] transition-transform duration-1000 group-hover:translate-x-[100%]"></div>

                        <div class="absolute bottom-6 left-6 translate-y-4 transition-transform duration-500 group-hover:translate-y-0">
                            <h3 class="text-xl font-bold text-white">Product & Commercial</h3>
                            <p class="text-sm text-gray-300 opacity-0 transition-opacity duration-500 group-hover:opacity-100">Tabletop & controlled lighting</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    {{-- Podcast & Content Studio (Compacted) --}}
    <section class="relative bg-black py-20 text-white overflow-hidden border-t border-white/5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <div class="space-y-8">
                    <div>
                        <span class="text-blue-500 font-bold tracking-widest uppercase text-xs">The Studio</span>
                        <h2 class="mt-2 text-4xl font-bold tracking-tighter sm:text-5xl text-gradient">
                            Pro-Level Podcasting.<br>
                            <span class="text-gray-500">Ready to Record.</span>
                        </h2>
                        <p class="mt-4 text-lg text-gray-400 font-light">
                            Step into a broadcast-quality environment designed for creators. Just bring your voice; we handle the rest.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="rounded-xl bg-white/5 p-4 border border-white/5 reveal-up">
                            <svg class="h-6 w-6 text-white mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" /></svg>
                            <h3 class="font-bold">Crystal Clear Audio</h3>
                            <p class="text-sm text-gray-400 mt-1">Shure SM7B mics & Rodecaster Pro II.</p>
                        </div>
                        <div class="rounded-xl bg-white/5 p-4 border border-white/5 reveal-up delay-100">
                            <svg class="h-6 w-6 text-white mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                            <h3 class="font-bold">4K Multi-Cam</h3>
                            <p class="text-sm text-gray-400 mt-1">Sony cinema line cameras.</p>
                        </div>
                    </div>
                </div>

                {{-- Visual Representation --}}
                <div class="relative h-[450px] w-full rounded-2xl overflow-hidden glass tilt-card reveal-up delay-200" x-intersect="$el.classList.add('is-visible')">
                    <img src="{{ asset('storage/room/IMG_0783.jpeg') }}" alt="Podcast Studio" class="h-full w-full object-cover transition-transform duration-700 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-green-500/20 px-2 py-0.5 text-[10px] font-bold text-green-400 backdrop-blur-sm mb-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-green-500 animate-pulse"></span> Available Today
                        </div>
                        <h4 class="text-2xl font-bold">The Lounge</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- NEW SECTION 2: Equipment Spotlight (Horizontal Scroll) --}}
    <section class="bg-gray-50 py-20 text-black overflow-hidden">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center reveal-up" x-intersect="$el.classList.add('is-visible')">
                <span class="text-blue-600 font-bold tracking-widest uppercase text-xs">Professional Gear</span>
                <h2 class="mt-2 text-3xl font-bold text-gray-900">Included with Every Booking</h2>
            </div>
            
            <div class="relative reveal-up delay-100" x-intersect="$el.classList.add('is-visible')">
                <div class="flex gap-6 overflow-x-auto pb-12 snap-x snap-mandatory no-scrollbar p-4" style="scrollbar-width: none; -ms-overflow-style: none;">
                    {{-- Item 1 --}}
                    <div class="min-w-[280px] snap-center rounded-2xl bg-white p-6 shadow-sm border border-gray-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-blue-100 group">
                        <div class="h-40 w-full mb-4 overflow-hidden rounded-lg bg-gray-100 relative">
                            <img src="{{ asset('storage/room/IMG_0784.jpeg') }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <h3 class="font-bold text-lg group-hover:text-blue-600 transition-colors">Sony A7S III</h3>
                        <p class="text-xs text-gray-500 mt-1">4K 120fps Cinema Camera</p>
                    </div>
                    {{-- Item 2 --}}
                    <div class="min-w-[280px] snap-center rounded-2xl bg-white p-6 shadow-sm border border-gray-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-blue-100 group">
                        <div class="h-40 w-full mb-4 overflow-hidden rounded-lg bg-gray-100 relative">
                            <img src="{{ asset('storage/room/IMG_0785.jpeg') }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <h3 class="font-bold text-lg group-hover:text-blue-600 transition-colors">Godox AD600 Pro</h3>
                        <p class="text-xs text-gray-500 mt-1">High-Speed Strobe</p>
                    </div>
                    {{-- Item 3 --}}
                    <div class="min-w-[280px] snap-center rounded-2xl bg-white p-6 shadow-sm border border-gray-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-blue-100 group">
                        <div class="h-40 w-full mb-4 overflow-hidden rounded-lg bg-gray-100 relative">
                            <img src="{{ asset('storage/room/IMG_0786.jpeg') }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <h3 class="font-bold text-lg group-hover:text-blue-600 transition-colors">G Master Lenses</h3>
                        <p class="text-xs text-gray-500 mt-1">24-70mm, 85mm, 16-35mm</p>
                    </div>
                     {{-- Item 4 --}}
                     <div class="min-w-[280px] snap-center rounded-2xl bg-white p-6 shadow-sm border border-gray-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-blue-100 group">
                        <div class="h-40 w-full mb-4 overflow-hidden rounded-lg bg-gray-100 relative">
                            <img src="{{ asset('storage/room/IMG_0787.jpeg') }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <h3 class="font-bold text-lg group-hover:text-blue-600 transition-colors">Aputure 600d</h3>
                        <p class="text-xs text-gray-500 mt-1">Continuous LED Lighting</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- NEW SECTION 3: Life at dyWix (Modern Bento Compact) --}}
    <section class="bg-white py-20" x-data="{ mouseX: 0, mouseY: 0 }" @mousemove="mouseX = $event.clientX; mouseY = $event.clientY">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 grid-rows-2 gap-4 h-[600px] md:h-[500px]">
                {{-- Text Block (Top Left) --}}
                <div class="md:col-span-2 md:row-span-2 rounded-3xl bg-gray-50 p-8 flex flex-col justify-between overflow-hidden relative group border border-gray-100 reveal-up"
                     x-intersect="$el.classList.add('is-visible')">
                    
                    {{-- Spotlight Effect --}}
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"
                         :style="`background: radial-gradient(600px circle at ${mouseX - $el.getBoundingClientRect().left}px ${mouseY - $el.getBoundingClientRect().top}px, rgba(59, 130, 246, 0.1), transparent 40%);`"></div>

                    <div class="relative z-10">
                        <span class="text-blue-600 font-bold tracking-widest uppercase text-xs">Community</span>
                        <h2 class="mt-2 text-3xl font-bold text-gray-900 tracking-tight">Life at dyWix</h2>
                        <p class="mt-4 text-gray-600 leading-relaxed text-sm">
                            More than just a studio. A hub where creators connect. From intense fashion shoots to laid-back podcast sessions, the energy here is contagious.
                        </p>
                    </div>
                    <div class="relative z-10 mt-6 grid grid-cols-3 gap-4 border-t border-gray-200 pt-6">
                        <div class="group/stat cursor-default">
                            <p class="text-2xl font-bold text-black transition-transform group-hover/stat:-translate-y-1">500+</p>
                            <p class="text-[10px] text-gray-500 uppercase">Shoots</p>
                        </div>
                        <div class="group/stat cursor-default">
                            <p class="text-2xl font-bold text-black transition-transform group-hover/stat:-translate-y-1 delay-75">150+</p>
                            <p class="text-[10px] text-gray-500 uppercase">Clients</p>
                        </div>
                        <div class="group/stat cursor-default">
                            <p class="text-2xl font-bold text-black transition-transform group-hover/stat:-translate-y-1 delay-100">24/7</p>
                            <p class="text-[10px] text-gray-500 uppercase">Access</p>
                        </div>
                    </div>
                    {{-- Decorative bg element --}}
                    <div class="absolute -bottom-10 -right-10 h-64 w-64 bg-blue-100 rounded-full blur-3xl opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                </div>

                {{-- Image 1 (Top Right) --}}
                <div class="md:col-span-2 md:row-span-1 rounded-3xl overflow-hidden relative group reveal-up delay-100" x-intersect="$el.classList.add('is-visible')">
                    <img src="{{ asset('storage/room/IMG_0787.jpeg') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
                    <div class="absolute bottom-4 left-4">
                         <span class="inline-flex items-center rounded-full bg-white/20 px-3 py-1 text-xs font-medium text-white backdrop-blur-md border border-white/10 transition-transform group-hover:scale-105">BTS Action</span>
                    </div>
                </div>

                {{-- Image 2 (Bottom Middle) --}}
                <div class="md:col-span-1 md:row-span-1 rounded-3xl overflow-hidden relative group reveal-up delay-200" x-intersect="$el.classList.add('is-visible')">
                    <img src="{{ asset('storage/room/IMG_0770.jpeg') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                </div>

                {{-- Image 3 (Bottom Right) --}}
                <div class="md:col-span-1 md:row-span-1 rounded-3xl overflow-hidden relative group reveal-up delay-300" x-intersect="$el.classList.add('is-visible')">
                     <img src="{{ asset('storage/room/IMG_0773.jpeg') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                     <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/30 backdrop-blur-[2px]">
                        <span class="text-white font-bold tracking-wider text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform">Join Us</span>
                     </div>
                </div>
            </div>
        </div>
    </section>

    {{-- NEW SECTION 4: Studio Amenities (Grid) --}}
    <section class="bg-gray-50 py-20 border-t border-gray-200">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-blue-600 font-bold tracking-widest uppercase text-xs">Comfort & Convenience</span>
                <h2 class="mt-2 text-3xl font-bold text-gray-900">Everything You Need</h2>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                {{-- Amenity 1 --}}
                <div class="flex flex-col items-center text-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition reveal-up">
                    <div class="h-12 w-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" /></svg>
                    </div>
                    <h3 class="font-bold text-gray-900">Gigabit WiFi</h3>
                    <p class="text-xs text-gray-500 mt-2">Upload footage instantly.</p>
                </div>
                {{-- Amenity 2 --}}
                <div class="flex flex-col items-center text-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition reveal-up delay-100">
                    <div class="h-12 w-12 rounded-full bg-pink-50 text-pink-600 flex items-center justify-center mb-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="font-bold text-gray-900">Makeup Room</h3>
                    <p class="text-xs text-gray-500 mt-2">Well-lit vanity mirrors.</p>
                </div>
                {{-- Amenity 3 --}}
                <div class="flex flex-col items-center text-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition reveal-up delay-200">
                    <div class="h-12 w-12 rounded-full bg-yellow-50 text-yellow-600 flex items-center justify-center mb-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="font-bold text-gray-900">Power Backup</h3>
                    <p class="text-xs text-gray-500 mt-2">Uninterrupted shoots.</p>
                </div>
                {{-- Amenity 4 --}}
                <div class="flex flex-col items-center text-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition reveal-up delay-300">
                    <div class="h-12 w-12 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center mb-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h3 class="font-bold text-gray-900">Refreshments</h3>
                    <p class="text-xs text-gray-500 mt-2">Coffee & pantry access.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- NEW SECTION 5: FAQs (Accordion) --}}
    <section class="bg-white py-20" x-data="{ active: null }">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Common Questions</h2>
            </div>
            
            <div class="space-y-4">
                <div class="rounded-xl border border-gray-200 overflow-hidden">
                    <button @click="active = (active === 1 ? null : 1)" class="flex w-full items-center justify-between p-5 text-left font-bold text-gray-900 hover:bg-gray-50">
                        <span>Do you provide equipment?</span>
                        <svg class="h-5 w-5 transform transition-transform" :class="active === 1 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="active === 1" x-collapse class="p-5 pt-0 text-sm text-gray-600">
                        Yes! All our booking tiers include basic lighting and grip. Premium cameras and lenses are available for an additional fee or included in the All Access plan.
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200 overflow-hidden">
                    <button @click="active = (active === 2 ? null : 2)" class="flex w-full items-center justify-between p-5 text-left font-bold text-gray-900 hover:bg-gray-50">
                        <span>Is there a makeup artist available?</span>
                        <svg class="h-5 w-5 transform transition-transform" :class="active === 2 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="active === 2" x-collapse class="p-5 pt-0 text-sm text-gray-600">
                        We have a dedicated makeup room. We can also connect you with our partner MUAs if you need one for your shoot.
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200 overflow-hidden">
                    <button @click="active = (active === 3 ? null : 3)" class="flex w-full items-center justify-between p-5 text-left font-bold text-gray-900 hover:bg-gray-50">
                        <span>Can I record a podcast with video?</span>
                        <svg class="h-5 w-5 transform transition-transform" :class="active === 3 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="active === 3" x-collapse class="p-5 pt-0 text-sm text-gray-600">
                        Absolutely. Our podcast lounge is equipped with a 3-camera 4K setup specifically designed for video podcasts.
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- NEW SECTION 6: Location & Final CTA --}}
    <section class="relative bg-black py-24 text-white overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('storage/room/IMG_0779.jpeg') }}" class="h-full w-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/80 to-transparent"></div>
        
        <div class="relative z-10 mx-auto max-w-4xl px-4 text-center">
            <h2 class="text-4xl font-bold tracking-tight sm:text-5xl mb-6">Ready to Create?</h2>
            <p class="text-xl text-gray-300 mb-10">Located centrally in Dwarka Sector 13. Open 24/7 for your creative needs.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('pages.booking') }}" class="inline-flex items-center justify-center rounded-full bg-white px-8 py-4 text-sm font-bold text-black hover:bg-gray-200 transition">
                    Book Your Slot
                </a>
                <a href="https://maps.google.com" target="_blank" class="inline-flex items-center justify-center rounded-full border border-white/30 bg-white/10 px-8 py-4 text-sm font-bold text-white backdrop-blur-md hover:bg-white/20 transition">
                    <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    Get Directions
                </a>
            </div>
        </div>
    </section>

    {{-- Parallax Text Section (Compacted) --}}
    <section class="relative py-24 bg-gray-50 overflow-hidden border-t border-gray-200">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <div x-data="{ shown: false }" x-intersect.threshold.0.5="shown = true">
                <h2 
                    class="text-4xl font-bold tracking-tighter text-black sm:text-6xl lg:text-7xl transition-all duration-1000 transform scale-90 opacity-0"
                    :class="{ 'scale-100 opacity-100': shown }"
                >
                    Built for speed.<br />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Designed for quality.</span>
                </h2>
                <p 
                    class="mx-auto mt-6 max-w-3xl text-lg text-gray-500 font-light leading-relaxed transition-all duration-1000 delay-300 transform translate-y-8 opacity-0"
                    :class="{ 'translate-y-0 opacity-100': shown }"
                >
                    No hidden charges. No confusing tiers. Just transparent pricing and professional gear included with every booking.
                </p>
            </div>
        </div>
    </section>

    {{-- Modern Pricing Cards (Compacted) --}}
    <section class="bg-white py-20" id="pricing">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal-up" x-intersect="$el.classList.add('is-visible')">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900">Simple Pricing</h2>
                <p class="mt-2 text-gray-500">Choose the perfect plan for your project.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                {{-- Plan 1 --}}
                <div class="relative overflow-hidden rounded-2xl bg-gray-50 p-8 transition-all duration-300 hover:shadow-xl hover:-translate-y-2 border border-gray-100 reveal-up" 
                     x-intersect="$el.classList.add('is-visible')">
                    <h3 class="text-lg font-bold text-gray-900">Hourly</h3>
                    <div class="mt-2 flex items-baseline">
                        <span class="text-4xl font-bold tracking-tight text-gray-900">₹1,400</span>
                        <span class="ml-1 text-base font-medium text-gray-500">/hr</span>
                    </div>
                    <ul class="mt-6 space-y-3 text-sm text-gray-600">
                        <li class="flex items-center"><svg class="mr-3 h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Min. 3 Hours</li>
                        <li class="flex items-center"><svg class="mr-3 h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> 2x Godox Strobes</li>
                        <li class="flex items-center"><svg class="mr-3 h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Basic Grip</li>
                    </ul>
                    <a href="{{ route('pages.booking') }}" class="mt-6 block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-center text-sm font-bold text-gray-900 hover:bg-gray-50 transition hover:scale-105 active:scale-95">Book Hourly</a>
                </div>

                {{-- Plan 2 (Featured) --}}
                <div class="relative overflow-hidden rounded-2xl bg-black p-8 shadow-2xl scale-105 z-10 border border-gray-800 reveal-up delay-100 ring-4 ring-blue-500/20" 
                     x-intersect="$el.classList.add('is-visible')">
                    <div class="absolute top-0 right-0 bg-blue-600 px-3 py-1 rounded-bl-lg text-[10px] font-bold text-white shadow-lg animate-pulse">POPULAR</div>
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-black to-gray-900"></div>
                    
                    <div class="relative z-10">
                        <h3 class="text-lg font-bold text-white">Full Day</h3>
                        <div class="mt-2 flex items-baseline">
                            <span class="text-4xl font-bold tracking-tight text-white">₹9,000</span>
                            <span class="ml-1 text-base font-medium text-gray-400">/10hr</span>
                        </div>
                        <ul class="mt-6 space-y-3 text-sm text-gray-300">
                            <li class="flex items-center"><svg class="mr-3 h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> 4x Lights (Strobe/Video)</li>
                            <li class="flex items-center"><svg class="mr-3 h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Full Grip Package</li>
                            <li class="flex items-center"><svg class="mr-3 h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Assistant Included</li>
                        </ul>
                        <a href="{{ route('pages.booking') }}" class="mt-6 block w-full rounded-xl bg-blue-600 px-4 py-3 text-center text-sm font-bold text-white hover:bg-blue-700 transition shadow-lg shadow-blue-900/50 hover:shadow-blue-600/50 hover:scale-105 active:scale-95">Book Full Day</a>
                    </div>
                </div>

                {{-- Plan 3 --}}
                <div class="relative overflow-hidden rounded-2xl bg-gray-50 p-8 transition-all duration-300 hover:shadow-xl hover:-translate-y-2 border border-gray-100 reveal-up delay-200" 
                     x-intersect="$el.classList.add('is-visible')">
                    <h3 class="text-lg font-bold text-gray-900">All Access</h3>
                    <div class="mt-2 flex items-baseline">
                        <span class="text-4xl font-bold tracking-tight text-gray-900">₹15,000</span>
                        <span class="ml-1 text-base font-medium text-gray-500">/12hr</span>
                    </div>
                    <ul class="mt-6 space-y-3 text-sm text-gray-600">
                        <li class="flex items-center"><svg class="mr-3 h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Multi-Set Access</li>
                        <li class="flex items-center"><svg class="mr-3 h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Podcast Recording</li>
                        <li class="flex items-center"><svg class="mr-3 h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Priority Editing Slot</li>
                    </ul>
                    <a href="{{ route('pages.booking') }}" class="mt-6 block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-center text-sm font-bold text-gray-900 hover:bg-gray-50 transition hover:scale-105 active:scale-95">Go All In</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact CTA (Compacted) --}}
    <div class="py-12">
        <x-home.contact />
    </div>
@endsection
