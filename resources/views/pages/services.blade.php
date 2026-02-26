@extends('layouts.app')

@section('title', 'Studio Services | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Explore studio services at {{ config('company.brand') }} in Delhi NCR – portrait and fashion shoots, product photography, corporate content, podcast recording, edit room and more." />
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-black h-[70vh] min-h-[600px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img 
                src="{{ asset('storage/room/IMG_0780.jpeg') }}" 
                class="h-full w-full object-cover opacity-50 animate-pan-slow" 
                alt="Studio Background"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/40 to-black"></div>
        </div>
        
        <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center" x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 100)">
            <p 
                class="text-[var(--color-brand-lens-blue)] font-bold tracking-[0.2em] uppercase text-sm mb-6 transition-all duration-1000 transform translate-y-4 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                Our Services
            </p>
            <h1 
                class="text-5xl md:text-7xl font-bold tracking-tight mb-8 text-white transition-all duration-1000 delay-200 transform translate-y-8 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                Crafting visual stories <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-[var(--color-brand-lens-blue)] to-blue-400">starts here.</span>
            </h1>
            <p 
                class="text-xl text-gray-300 max-w-2xl mx-auto mb-12 font-light transition-all duration-1000 delay-500 transform translate-y-8 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                Portraits, campaigns, podcasts, corporate films & more. A professional space designed for creators and brands.
            </p>
            
            <div 
                class="flex flex-col sm:flex-row justify-center gap-5 transition-all duration-1000 delay-700 transform translate-y-8 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                <a href="#produce" class="rounded-full bg-white text-black px-8 py-4 font-bold hover:bg-gray-100 transition transform hover:scale-105 duration-200">Explore Services</a>
                <a href="{{ route('pages.booking') }}" class="rounded-full border border-white/30 bg-white/10 px-8 py-4 text-white font-bold hover:bg-white/20 transition backdrop-blur-md transform hover:scale-105 duration-200">Book Now</a>
            </div>
        </div>
    </section>

    {{-- Who it's for --}}
    <section class="py-24 bg-white border-b border-gray-100">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true">
                <h2 
                    class="text-4xl font-bold text-[var(--color-text-main)] transition-all duration-1000 transform translate-y-4 opacity-0"
                    :class="{ 'translate-y-0 opacity-100': shown }"
                >
                    Who it’s for
                </h2>
                <p 
                    class="mt-4 text-xl text-[var(--color-text-muted)] transition-all duration-1000 delay-200 transform translate-y-4 opacity-0"
                    :class="{ 'translate-y-0 opacity-100': shown }"
                >
                    Tailored experiences for every type of creator.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                {{-- Card 1 --}}
                <div class="group p-10 rounded-[2rem] bg-gray-50 border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }">
                    <div class="h-16 w-16 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center mb-8 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Independent Creators</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">Content creators, photographers and filmmakers who need a reliable, flexible space to shoot in.</p>
                </div>

                {{-- Card 2 --}}
                <div class="group p-10 rounded-[2rem] bg-gray-50 border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 150ms;">
                    <div class="h-16 w-16 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center mb-8 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Brands & Agencies</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">Teams producing campaigns, lookbooks, product launches, and recurring content series.</p>
                </div>

                {{-- Card 3 --}}
                <div class="group p-10 rounded-[2rem] bg-gray-50 border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 300ms;">
                    <div class="h-16 w-16 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center mb-8 group-hover:bg-pink-600 group-hover:text-white transition-colors duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Corporate Teams</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">Companies filming leadership messages, training content, internal events and interviews.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- What we produce (Bento Grid) --}}
    <section class="py-24 bg-gray-50" id="produce">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-16 flex items-end justify-between" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true">
                <div>
                    <span 
                        class="text-[var(--color-brand-lens-blue)] font-bold tracking-widest uppercase text-sm block mb-2 transition-all duration-1000 transform translate-y-4 opacity-0"
                        :class="{ 'translate-y-0 opacity-100': shown }"
                    >
                        Our Expertise
                    </span>
                    <h2 
                        class="text-4xl font-bold text-[var(--color-text-main)] transition-all duration-1000 delay-200 transform translate-y-4 opacity-0"
                        :class="{ 'translate-y-0 opacity-100': shown }"
                    >
                        What we help you produce
                    </h2>
                </div>
                <a href="{{ route('pages.gallery') }}" class="hidden text-base font-medium text-[var(--color-brand-lens-blue)] hover:text-blue-800 sm:block group transition-all duration-1000 delay-500 transform translate-x-4 opacity-0" :class="{ 'translate-x-0 opacity-100': shown }">
                    View Gallery <span class="inline-block transition-transform group-hover:translate-x-1">→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 auto-rows-[500px]">
                {{-- Item 1: Portraits --}}
                <div class="group relative overflow-hidden rounded-[2rem] bg-black md:col-span-1 shadow-lg hover:shadow-2xl transition-all duration-500" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-12': !shown, 'opacity-100 translate-y-0': shown }">
                    <img src="{{ asset('storage/room/IMG_0783.jpeg') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-60" alt="Portraits">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-10 transform transition-transform duration-500 group-hover:-translate-y-2">
                        <h3 class="text-3xl font-bold text-white mb-3">Portraits & Branding</h3>
                        <p class="text-gray-300 text-base line-clamp-3 group-hover:line-clamp-none transition-all">Headshots and personal branding portraits that look natural, clean and consistent.</p>
                    </div>
                </div>

                {{-- Item 2: Fashion --}}
                <div class="group relative overflow-hidden rounded-[2rem] bg-black md:col-span-2 shadow-lg hover:shadow-2xl transition-all duration-500" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-12': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 150ms;">
                    <img src="{{ asset('storage/room/IMG_0776.jpeg') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-60" alt="Fashion">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-10 transform transition-transform duration-500 group-hover:-translate-y-2">
                        <h3 class="text-3xl font-bold text-white mb-3">Fashion & Lookbooks</h3>
                        <p class="text-gray-300 text-base max-w-lg">From minimal, catalogue‑ready frames to editorial sets. Quick lighting resets and modular props.</p>
                    </div>
                </div>

                {{-- Item 3: Product --}}
                <div class="group relative overflow-hidden rounded-[2rem] bg-black md:col-span-2 shadow-lg hover:shadow-2xl transition-all duration-500" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-12': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 300ms;">
                    <img src="{{ asset('storage/room/IMG_0779.jpeg') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-60" alt="Product">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-10 transform transition-transform duration-500 group-hover:-translate-y-2">
                        <h3 class="text-3xl font-bold text-white mb-3">Product & E-commerce</h3>
                        <p class="text-gray-300 text-base max-w-lg">Lights and modifiers tuned for fast, repeatable results. Perfect for reflective surfaces and apparel.</p>
                    </div>
                </div>

                {{-- Item 4: Podcast --}}
                <div class="group relative overflow-hidden rounded-[2rem] bg-black md:col-span-1 shadow-lg hover:shadow-2xl transition-all duration-500" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-12': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 450ms;">
                    <img src="{{ asset('storage/room/IMG_0782.jpeg') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-60" alt="Podcast">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-10 transform transition-transform duration-500 group-hover:-translate-y-2">
                        <h3 class="text-3xl font-bold text-white mb-3">Podcast & Shows</h3>
                        <p class="text-gray-300 text-base">Comfort and acoustics with clean backgrounds. Dynamic mics and professional lighting.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How it flows --}}
    <section class="py-24 bg-white border-b border-gray-100" id="flow">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true">
                <h2 
                    class="text-4xl font-bold text-[var(--color-text-main)] transition-all duration-1000 transform translate-y-4 opacity-0"
                    :class="{ 'translate-y-0 opacity-100': shown }"
                >
                    How a typical booking flows
                </h2>
            </div>

            <div class="relative">
                {{-- Connecting Line --}}
                <div class="hidden md:block absolute top-12 left-0 w-full h-0.5 bg-gray-100 -z-10"></div>

                <div class="grid md:grid-cols-3 gap-16">
                    {{-- Step 1 --}}
                    <div class="relative bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }">
                        <div class="h-14 w-14 bg-[var(--color-brand-lens-blue)] text-white rounded-2xl flex items-center justify-center font-bold text-xl mb-8 mx-auto md:mx-0 shadow-lg shadow-blue-200">1</div>
                        <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4 text-center md:text-left">Pre‑production</h3>
                        <p class="text-[var(--color-text-muted)] text-base leading-relaxed text-center md:text-left">Share a quick brief with references and preferred dates. We help map backdrops, lighting approach and props.</p>
                    </div>

                    {{-- Step 2 --}}
                    <div class="relative bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 150ms;">
                        <div class="h-14 w-14 bg-[var(--color-brand-lens-blue)] text-white rounded-2xl flex items-center justify-center font-bold text-xl mb-8 mx-auto md:mx-0 shadow-lg shadow-blue-200">2</div>
                        <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4 text-center md:text-left">On the day</h3>
                        <p class="text-[var(--color-text-muted)] text-base leading-relaxed text-center md:text-left">Arrive to a clean, organized set. Use the makeup room for prep, then rotate through looks while our assistant helps.</p>
                    </div>

                    {{-- Step 3 --}}
                    <div class="relative bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 300ms;">
                        <div class="h-14 w-14 bg-[var(--color-brand-lens-blue)] text-white rounded-2xl flex items-center justify-center font-bold text-xl mb-8 mx-auto md:mx-0 shadow-lg shadow-blue-200">3</div>
                        <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4 text-center md:text-left">Wrap & handoff</h3>
                        <p class="text-[var(--color-text-muted)] text-base leading-relaxed text-center md:text-left">Review selects on set. We assist with safe pack‑down so the space is ready for the next team.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Choose Us (Amenities) --}}
    <section class="py-24 bg-gray-50" id="why">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true">
                <span 
                    class="text-[var(--color-brand-lens-blue)] font-bold tracking-widest uppercase text-sm block mb-2 transition-all duration-1000 transform translate-y-4 opacity-0"
                    :class="{ 'translate-y-0 opacity-100': shown }"
                >
                    Why Us
                </span>
                <h2 
                    class="text-4xl font-bold text-[var(--color-text-main)] transition-all duration-1000 delay-200 transform translate-y-4 opacity-0"
                    :class="{ 'translate-y-0 opacity-100': shown }"
                >
                    Why teams choose this studio
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }">
                    <h3 class="font-bold text-xl mb-4 text-[var(--color-text-main)]">Flexible Availability</h3>
                    <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">24×7 slots for early starts, late‑night shoots and quick turnarounds.</p>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 100ms;">
                    <h3 class="font-bold text-xl mb-4 text-[var(--color-text-main)]">Production Support</h3>
                    <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">On‑floor assistant to help move stands, shape light and reset sets.</p>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 200ms;">
                    <h3 class="font-bold text-xl mb-4 text-[var(--color-text-main)]">Modular Sets</h3>
                    <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">Textured walls, plain backgrounds and simple props for distinct moods.</p>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 300ms;">
                    <h3 class="font-bold text-xl mb-4 text-[var(--color-text-main)]">Organized Spaces</h3>
                    <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">Makeup, green room and floor planned to reduce clutter and friction.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQs --}}
    <section class="py-24 bg-white" id="faqs" x-data="{ active: null }">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true">
                <h2 
                    class="text-4xl font-bold text-[var(--color-text-main)] transition-all duration-1000 transform translate-y-4 opacity-0"
                    :class="{ 'translate-y-0 opacity-100': shown }"
                >
                    FAQs about services
                </h2>
            </div>
            
            <div class="space-y-6" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }">
                <div class="rounded-2xl border border-gray-200 overflow-hidden hover:border-blue-200 transition-colors duration-300">
                    <button @click="active = (active === 1 ? null : 1)" class="flex w-full items-center justify-between p-6 text-left font-bold text-lg text-[var(--color-text-main)] hover:bg-gray-50 transition-colors">
                        <span>Can you help with creative direction?</span>
                        <svg class="h-6 w-6 transform transition-transform duration-300" :class="active === 1 ? 'rotate-180 text-blue-600' : 'text-gray-400'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="active === 1" x-collapse class="p-6 pt-0 text-base text-[var(--color-text-muted)] leading-relaxed">
                        We guide lighting, backdrop choices and set flow. For end‑to‑end direction, we coordinate with trusted stylists, art directors and producers on request.
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-200 overflow-hidden hover:border-blue-200 transition-colors duration-300">
                    <button @click="active = (active === 2 ? null : 2)" class="flex w-full items-center justify-between p-6 text-left font-bold text-lg text-[var(--color-text-main)] hover:bg-gray-50 transition-colors">
                        <span>Do you offer crew and equipment add‑ons?</span>
                        <svg class="h-6 w-6 transform transition-transform duration-300" :class="active === 2 ? 'rotate-180 text-blue-600' : 'text-gray-400'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="active === 2" x-collapse class="p-6 pt-0 text-base text-[var(--color-text-muted)] leading-relaxed">
                        Yes. Add podcast mics, constant lights, and an edit room. For cameras and specialty grip we connect you with partner rentals to keep workflows reliable.
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-200 overflow-hidden hover:border-blue-200 transition-colors duration-300">
                    <button @click="active = (active === 3 ? null : 3)" class="flex w-full items-center justify-between p-6 text-left font-bold text-lg text-[var(--color-text-main)] hover:bg-gray-50 transition-colors">
                        <span>What’s the best way to plan a first visit?</span>
                        <svg class="h-6 w-6 transform transition-transform duration-300" :class="active === 3 ? 'rotate-180 text-blue-600' : 'text-gray-400'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="active === 3" x-collapse class="p-6 pt-0 text-base text-[var(--color-text-muted)] leading-relaxed">
                        Browse the <a class="text-blue-600 hover:underline font-medium" href="{{ route('pages.pricing') }}">pricing</a> and <a class="text-blue-600 hover:underline font-medium" href="{{ route('pages.about') }}">about</a> pages, then write to us via <a class="text-blue-600 hover:underline font-medium" href="{{ route('pages.contact') }}">contact</a> with your brief and dates. We will confirm availability and a plan within a business day.
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
