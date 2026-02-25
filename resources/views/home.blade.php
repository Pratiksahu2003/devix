@extends('layouts.app')

@section('title', config('company.brand').' | Premier Podcast & Content Studio in Delhi NCR')

@section('content')
    {{-- Hero Section (Fitting Frames Cinematic) --}}
    <section class="relative w-full bg-black min-h-screen flex flex-col items-center justify-center overflow-hidden py-20">
        {{-- Background Texture --}}
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')]"></div>
        
        {{-- Top Header --}}
        <div class="relative z-10 text-center px-4 mb-12 reveal-up">
            <h1 class="text-3xl md:text-5xl font-bold uppercase tracking-widest text-white mb-2 font-sans">
                Studio Space Available <span class="text-red-600">24/7</span> For All Your Shooting Needs
            </h1>
            <p class="text-red-600 text-[10px] md:text-sm font-bold tracking-[0.2em] uppercase">
                Equipped With Professional Gear & Versatile Filming Environments
            </p>
        </div>

        {{-- Main Cinematic Composition --}}
        <div class="relative w-full max-w-[1400px] flex flex-col md:flex-row items-center justify-center my-8 gap-8 md:gap-0">
            
            {{-- Left Film Strip --}}
            <div class="w-full md:w-1/3 h-32 relative overflow-hidden opacity-80 md:mr-[-40px] z-0">
                <div class="absolute inset-y-0 left-0 w-20 bg-gradient-to-r from-black to-transparent z-10"></div>
                <div class="flex animate-marquee-reverse hover:[animation-play-state:paused] items-center h-full border-y-4 border-dashed border-gray-800 bg-gray-900/50">
                    @foreach(range(1, 4) as $i)
                        <div class="flex shrink-0">
                            <img src="{{ asset('storage/studio/DSC01002.JPG') }}" class="h-24 w-40 object-cover mx-1 border-2 border-gray-800 transition-all duration-300">
                            <img src="{{ asset('storage/studio/DSC01007.JPG') }}" class="h-24 w-40 object-cover mx-1 border-2 border-gray-800 transition-all duration-300">
                            <img src="{{ asset('storage/studio/DSC01009.JPG') }}" class="h-24 w-40 object-cover mx-1 border-2 border-gray-800 transition-all duration-300">
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Center Piece (Shutter & Text) --}}
            <div class="relative z-20 flex items-center justify-center shrink-0 scale-90 md:scale-100 reveal-up delay-100">
                {{-- Left Bracket --}}
                <div class="hidden md:flex bg-red-900/90 border-l-8 border-red-600 h-24 items-center pl-6 pr-10 rounded-l-2xl shadow-[0_0_30px_rgba(220,38,38,0.3)] transform -skew-x-6 mr-[-30px] z-10">
                    <span class="text-4xl font-serif text-white tracking-widest transform skew-x-6 drop-shadow-md">FITTING</span>
                </div>

                {{-- Central Shutter Circle --}}
                <div class="relative w-72 h-72 md:w-96 md:h-96 rounded-full border-[6px] border-white bg-black overflow-hidden z-20 shadow-[0_0_50px_rgba(0,0,0,0.8)] group">
                    {{-- Spinning Grid --}}
                    <div class="absolute inset-0 grid grid-cols-2 grid-rows-2 gap-1 transform rotate-45 scale-125 transition-transform duration-[20s] ease-linear group-hover:rotate-[225deg]">
                        <div class="overflow-hidden bg-gray-800"><img src="{{ asset('storage/studio/DSC01003.JPG') }}" class="h-full w-full object-cover transform -rotate-45 transition-all duration-700"></div>
                        <div class="overflow-hidden bg-gray-800"><img src="{{ asset('storage/studio/DSC01008.JPG') }}" class="h-full w-full object-cover transform -rotate-45 transition-all duration-700"></div>
                        <div class="overflow-hidden bg-gray-800"><img src="{{ asset('storage/studio/DSC01012.JPG') }}" class="h-full w-full object-cover transform -rotate-45 transition-all duration-700"></div>
                        <div class="overflow-hidden bg-gray-800"><img src="{{ asset('storage/studio/DSC01010.JPG') }}" class="h-full w-full object-cover transform -rotate-45 transition-all duration-700"></div>
                    </div>
                    {{-- Center Aperture Dot --}}
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-16 h-16 bg-black/80 rounded-full border-2 border-red-600 backdrop-blur-sm z-30 flex items-center justify-center">
                        
                    </div>
                </div>

                {{-- Right Bracket --}}
                <div class="hidden md:flex bg-red-900/90 border-r-8 border-red-600 h-24 items-center pr-6 pl-10 rounded-r-2xl shadow-[0_0_30px_rgba(220,38,38,0.3)] transform skew-x-6 ml-[-30px] z-10">
                    <span class="text-4xl font-serif text-white tracking-widest transform -skew-x-6 drop-shadow-md">FRAMES</span>
                </div>
                
                {{-- Mobile Text (Stacked) --}}
                <div class="absolute md:hidden inset-0 flex items-center justify-center pointer-events-none z-30">
                     <span class="text-4xl font-serif text-white font-bold tracking-widest drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">dyWix</span>
                </div>
            </div>

            {{-- Right Film Strip --}}
            <div class="w-full md:w-1/3 h-32 relative overflow-hidden opacity-80 md:ml-[-40px] z-0">
                <div class="absolute inset-y-0 right-0 w-20 bg-gradient-to-l from-black to-transparent z-10"></div>
                <div class="flex animate-marquee hover:[animation-play-state:paused] items-center h-full border-y-4 border-dashed border-gray-800 bg-gray-900/50">
                    @foreach(range(1, 4) as $i)
                        <div class="flex shrink-0">
                            <img src="{{ asset('storage/studio/DSC01008.JPG') }}" class="h-24 w-40 object-cover mx-1 border-2 border-gray-800 transition-all duration-300">
                            <img src="{{ asset('storage/studio/DSC01010.JPG') }}" class="h-24 w-40 object-cover mx-1 border-2 border-gray-800 transition-all duration-300">
                            <img src="{{ asset('storage/studio/DSC01012.JPG') }}" class="h-24 w-40 object-cover mx-1 border-2 border-gray-800 transition-all duration-300">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Bottom Banner --}}
        <div class="relative z-10 w-full max-w-5xl px-4 mt-8 reveal-up delay-200">
            <div class="bg-gradient-to-r from-red-900/80 via-red-600/90 to-red-900/80 py-3 px-6 rounded-lg text-center shadow-[0_10px_40px_-10px_rgba(220,38,38,0.5)] border border-red-500/30 backdrop-blur-sm">
                <p class="text-[10px] md:text-sm font-bold tracking-[0.2em] text-white uppercase truncate">
                    Fashion <span class="mx-2 text-red-300">|</span> Product <span class="mx-2 text-red-300">|</span> Maternity <span class="mx-2 text-red-300">|</span> Commercial <span class="mx-2 text-red-300">|</span> Videography & More
                </p>
            </div>
        </div>

        {{-- Floating CTA --}}
        <div class="fixed bottom-8 left-8 z-50 md:absolute md:bottom-20 md:left-20 reveal-up delay-500">
            <a href="{{ route('pages.booking') }}" class="group relative inline-flex items-center justify-center overflow-hidden rounded-full bg-red-700 px-8 py-3 font-bold text-white shadow-[0_0_20px_rgba(220,38,38,0.6)] transition-all hover:bg-red-600 hover:scale-105 hover:shadow-[0_0_30px_rgba(220,38,38,0.8)]">
                <span class="absolute inset-0 h-full w-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full transition-transform duration-1000 group-hover:animate-shimmer"></span>
                <span class="relative tracking-widest uppercase text-sm">Book Now</span>
            </a>
        </div>
    </section>

    {{-- Scrolling Text Marquee (Modern Infinite) --}}
    <div class="relative overflow-hidden bg-black py-10 border-b border-white/10">
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

        {{-- NEW SECTION 1: Trusted By (Logos) --}}
        <section class="bg-white py-20 border-b border-gray-200">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center md:text-left">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-blue-500 mb-2">Our Network</p>
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Trusted by Industry Leaders</h2>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 border-t border-l border-gray-200">
                    @foreach(range(1, 8) as $i)
                        <div class="group relative flex h-32 items-center justify-center border-r border-b border-gray-200 p-6 ">
                            <img src="{{ asset('brand/' . $i . '.png') }}" 
                                 class=" object-contain" 
                                 alt="Client Logo {{ $i }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- NEW SECTION 2: Visual Sets Video Grid --}}
        <section class="bg-white py-20 text-gray-900">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 flex items-end justify-between">
                    <div>
                        <span class="text-blue-500 font-bold tracking-widest uppercase text-xs">Visual Experience</span>
                        <h2 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl text-gray-900">Versatile Sets</h2>
                    </div>
                    <a href="{{ route('pages.gallery') }}" class="hidden text-sm font-medium text-gray-600 hover:text-gray-900 sm:block">View Gallery →</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 h-[500px] md:h-[400px]">
                    {{-- Card 1: Fashion --}}
                    <div class="group relative h-full w-full overflow-hidden rounded-2xl bg-gray-100 reveal-up" x-intersect="$el.classList.add('is-visible')">
                        <img src="{{ asset('storage/studio/DSC01009.JPG') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                        <div class="absolute bottom-6 left-6">
                            <h3 class="text-xl font-bold text-white">Fashion & Editorial</h3>
                            <p class="text-sm text-gray-300">Cyclorama wall & colored backdrops</p>
                        </div>
                    </div>

                    {{-- Card 2: Podcast --}}
                    <div class="group relative h-full w-full overflow-hidden rounded-2xl bg-gray-100 reveal-up delay-100" x-intersect="$el.classList.add('is-visible')">
                        <img src="{{ asset('storage/studio/DSC01012.JPG') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                        <div class="absolute bottom-6 left-6">
                            <h3 class="text-xl font-bold text-white">Video Podcast</h3>
                            <p class="text-sm text-gray-300">4-person setup with 3-camera angles</p>
                        </div>
                    </div>

                    {{-- Card 3: Product --}}
                    <div class="group relative h-full w-full overflow-hidden rounded-2xl bg-gray-100 reveal-up delay-200" x-intersect="$el.classList.add('is-visible')">
                        <img src="{{ asset('storage/studio/DSC01007.JPG') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                        <div class="absolute bottom-6 left-6">
                            <h3 class="text-xl font-bold text-white">Product & Commercial</h3>
                            <p class="text-sm text-gray-300">Tabletop & controlled lighting</p>
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
                    <img src="{{ asset('storage/studio/DSC01007.JPG') }}" alt="Podcast Studio" class="h-full w-full object-cover transition-transform duration-700 hover:scale-110">
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
            <div class="mb-10 text-center">
                <span class="text-blue-600 font-bold tracking-widest uppercase text-xs">Professional Gear</span>
                <h2 class="mt-2 text-3xl font-bold text-gray-900">Included with Every Booking</h2>
            </div>
            
            <div class="relative">
                <div class="flex gap-6 overflow-x-auto pb-8 snap-x snap-mandatory no-scrollbar" style="scrollbar-width: none; -ms-overflow-style: none;">
                    {{-- Item 1 --}}
                    <div class="min-w-[280px] snap-center rounded-2xl bg-white p-6 shadow-sm border border-gray-100 transition hover:-translate-y-1 hover:shadow-md">
                        <div class="h-40 w-full mb-4 overflow-hidden rounded-lg bg-gray-100">
                            <img src="{{ asset('storage/studio/DSC01009.JPG') }}" class="h-full w-full object-cover">
                        </div>
                        <h3 class="font-bold text-lg">Sony A7S III</h3>
                        <p class="text-xs text-gray-500 mt-1">4K 120fps Cinema Camera</p>
                    </div>
                    {{-- Item 2 --}}
                    <div class="min-w-[280px] snap-center rounded-2xl bg-white p-6 shadow-sm border border-gray-100 transition hover:-translate-y-1 hover:shadow-md">
                        <div class="h-40 w-full mb-4 overflow-hidden rounded-lg bg-gray-100">
                            <img src="{{ asset('storage/studio/DSC01010.JPG') }}" class="h-full w-full object-cover">
                        </div>
                        <h3 class="font-bold text-lg">Godox AD600 Pro</h3>
                        <p class="text-xs text-gray-500 mt-1">High-Speed Strobe</p>
                    </div>
                    {{-- Item 3 --}}
                    <div class="min-w-[280px] snap-center rounded-2xl bg-white p-6 shadow-sm border border-gray-100 transition hover:-translate-y-1 hover:shadow-md">
                        <div class="h-40 w-full mb-4 overflow-hidden rounded-lg bg-gray-100">
                            <img src="{{ asset('storage/studio/DSC01008.JPG') }}" class="h-full w-full object-cover">
                        </div>
                        <h3 class="font-bold text-lg">G Master Lenses</h3>
                        <p class="text-xs text-gray-500 mt-1">24-70mm, 85mm, 16-35mm</p>
                    </div>
                     {{-- Item 4 --}}
                     <div class="min-w-[280px] snap-center rounded-2xl bg-white p-6 shadow-sm border border-gray-100 transition hover:-translate-y-1 hover:shadow-md">
                        <div class="h-40 w-full mb-4 overflow-hidden rounded-lg bg-gray-100">
                            <img src="{{ asset('storage/studio/DSC01002.JPG') }}" class="h-full w-full object-cover">
                        </div>
                        <h3 class="font-bold text-lg">Aputure 600d</h3>
                        <p class="text-xs text-gray-500 mt-1">Continuous LED Lighting</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- NEW SECTION 3: Life at dyWix (Modern Bento Compact) --}}
    <section class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 grid-rows-2 gap-4 h-[600px] md:h-[500px]">
                {{-- Text Block (Top Left) --}}
                <div class="md:col-span-2 md:row-span-2 rounded-3xl bg-gray-50 p-8 flex flex-col justify-between overflow-hidden relative group border border-gray-100">
                    <div class="relative z-10">
                        <span class="text-blue-600 font-bold tracking-widest uppercase text-xs">Community</span>
                        <h2 class="mt-2 text-3xl font-bold text-gray-900 tracking-tight">Life at dyWix</h2>
                        <p class="mt-4 text-gray-600 leading-relaxed text-sm">
                            More than just a studio. A hub where creators connect. From intense fashion shoots to laid-back podcast sessions, the energy here is contagious.
                        </p>
                    </div>
                    <div class="relative z-10 mt-6 grid grid-cols-3 gap-4 border-t border-gray-200 pt-6">
                        <div>
                            <p class="text-2xl font-bold text-black">500+</p>
                            <p class="text-[10px] text-gray-500 uppercase">Shoots</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-black">150+</p>
                            <p class="text-[10px] text-gray-500 uppercase">Clients</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-black">24/7</p>
                            <p class="text-[10px] text-gray-500 uppercase">Access</p>
                        </div>
                    </div>
                    {{-- Decorative bg element --}}
                    <div class="absolute -bottom-10 -right-10 h-64 w-64 bg-blue-100 rounded-full blur-3xl opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                </div>

                {{-- Image 1 (Top Right) --}}
                <div class="md:col-span-2 md:row-span-1 rounded-3xl overflow-hidden relative group">
                    <img src="{{ asset('storage/studio/DSC01003.JPG') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
                    <div class="absolute bottom-4 left-4">
                         <span class="inline-flex items-center rounded-full bg-white/20 px-3 py-1 text-xs font-medium text-white backdrop-blur-md border border-white/10">BTS Action</span>
                    </div>
                </div>

                {{-- Image 2 (Bottom Middle) --}}
                <div class="md:col-span-1 md:row-span-1 rounded-3xl overflow-hidden relative group">
                    <img src="{{ asset('storage/studio/DSC01012.JPG') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                </div>

                {{-- Image 3 (Bottom Right) --}}
                <div class="md:col-span-1 md:row-span-1 rounded-3xl overflow-hidden relative group">
                     <img src="{{ asset('storage/studio/DSC01002.JPG') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                     <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/30 backdrop-blur-[2px]">
                        <span class="text-white font-bold tracking-wider text-sm">Join Us</span>
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
            <img src="{{ asset('storage/studio/DSC01002.JPG') }}" class="h-full w-full object-cover">
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
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900">Simple Pricing</h2>
                <p class="mt-2 text-gray-500">Choose the perfect plan for your project.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                {{-- Plan 1 --}}
                <div class="relative overflow-hidden rounded-2xl bg-gray-50 p-8 transition hover:shadow-lg hover:-translate-y-1 duration-300 border border-gray-100 reveal-up" x-intersect="$el.classList.add('is-visible')">
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
                    <a href="{{ route('pages.booking') }}" class="mt-6 block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-center text-sm font-bold text-gray-900 hover:bg-gray-50 transition">Book Hourly</a>
                </div>

                {{-- Plan 2 (Featured) --}}
                <div class="relative overflow-hidden rounded-2xl bg-black p-8 shadow-xl scale-105 z-10 border border-gray-800 reveal-up delay-100" x-intersect="$el.classList.add('is-visible')">
                    <div class="absolute top-0 right-0 bg-blue-600 px-3 py-1 rounded-bl-lg text-[10px] font-bold text-white">POPULAR</div>
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
                    <a href="{{ route('pages.booking') }}" class="mt-6 block w-full rounded-xl bg-blue-600 px-4 py-3 text-center text-sm font-bold text-white hover:bg-blue-700 transition">Book Full Day</a>
                </div>

                {{-- Plan 3 --}}
                <div class="relative overflow-hidden rounded-2xl bg-gray-50 p-8 transition hover:shadow-lg hover:-translate-y-1 duration-300 border border-gray-100 reveal-up delay-200" x-intersect="$el.classList.add('is-visible')">
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
                    <a href="{{ route('pages.booking') }}" class="mt-6 block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-center text-sm font-bold text-gray-900 hover:bg-gray-50 transition">Go All In</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact CTA (Compacted) --}}
    <div class="py-12">
        <x-home.contact />
    </div>
@endsection