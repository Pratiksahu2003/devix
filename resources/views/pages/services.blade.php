@extends('layouts.app')

@section('title', 'Studio Services | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Explore studio services at {{ config('company.brand') }} in Delhi NCR – portrait and fashion shoots, product photography, corporate content, podcast recording, edit room and more." />
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-black py-24 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-30">
            <img src="{{ asset('storage/studio/DSC01002.JPG') }}" class="h-full w-full object-cover" alt="Studio Background">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/50 to-black"></div>
        
        <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center reveal-up">
            <p class="text-blue-500 font-bold tracking-widest uppercase text-xs mb-4">Our Services</p>
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-6">
                Crafting visual stories <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">starts here.</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto mb-10">
                Portraits, campaigns, podcasts, corporate films & more. A professional space designed for creators and brands.
            </p>
            
            <div class="flex flex-wrap justify-center gap-4 text-sm font-medium">
                <a href="#produce" class="rounded-full bg-white text-black px-6 py-3 hover:bg-gray-200 transition">Explore Services</a>
                <a href="{{ route('pages.booking') }}" class="rounded-full border border-white/30 bg-white/10 px-6 py-3 hover:bg-white/20 transition backdrop-blur-md">Book Now</a>
            </div>
        </div>
    </section>

    {{-- Who it's for --}}
    <section class="py-20 bg-white border-b border-gray-100">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal-up" x-intersect="$el.classList.add('is-visible')">
                <h2 class="text-3xl font-bold text-gray-900">Who it’s for</h2>
                <p class="mt-4 text-gray-500">Tailored experiences for every type of creator.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                {{-- Card 1 --}}
                <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:shadow-lg transition duration-300 reveal-up delay-100" x-intersect="$el.classList.add('is-visible')">
                    <div class="h-12 w-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-6">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Independent Creators</h3>
                    <p class="text-gray-600 leading-relaxed">Content creators, photographers and filmmakers who need a reliable, flexible space to shoot in.</p>
                </div>

                {{-- Card 2 --}}
                <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:shadow-lg transition duration-300 reveal-up delay-200" x-intersect="$el.classList.add('is-visible')">
                    <div class="h-12 w-12 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center mb-6">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Brands & Agencies</h3>
                    <p class="text-gray-600 leading-relaxed">Teams producing campaigns, lookbooks, product launches, and recurring content series.</p>
                </div>

                {{-- Card 3 --}}
                <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:shadow-lg transition duration-300 reveal-up delay-300" x-intersect="$el.classList.add('is-visible')">
                    <div class="h-12 w-12 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center mb-6">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Corporate Teams</h3>
                    <p class="text-gray-600 leading-relaxed">Companies filming leadership messages, training content, internal events and interviews.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- What we produce (Bento Grid) --}}
    <section class="py-20 bg-gray-50" id="produce">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-12 flex items-end justify-between reveal-up" x-intersect="$el.classList.add('is-visible')">
                <div>
                    <span class="text-blue-600 font-bold tracking-widest uppercase text-xs">Our Expertise</span>
                    <h2 class="mt-2 text-3xl font-bold text-gray-900">What we help you produce</h2>
                </div>
                <a href="{{ route('pages.gallery') }}" class="hidden text-sm font-medium text-blue-600 hover:text-blue-800 sm:block group">
                    View Gallery <span class="inline-block transition-transform group-hover:translate-x-1">→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 auto-rows-[400px]">
                {{-- Item 1: Portraits --}}
                <div class="group relative overflow-hidden rounded-2xl bg-black md:col-span-1 reveal-up" x-intersect="$el.classList.add('is-visible')">
                    <img src="{{ asset('storage/vidhu/DSC00987.JPG') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-60" alt="Portraits">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8">
                        <h3 class="text-2xl font-bold text-white mb-2">Portraits & Branding</h3>
                        <p class="text-gray-300 text-sm line-clamp-3 group-hover:line-clamp-none transition-all">Headshots and personal branding portraits that look natural, clean and consistent. Controlled light and practical backdrops.</p>
                    </div>
                </div>

                {{-- Item 2: Fashion --}}
                <div class="group relative overflow-hidden rounded-2xl bg-black md:col-span-2 reveal-up delay-100" x-intersect="$el.classList.add('is-visible')">
                    <img src="{{ asset('storage/pooja/DSC00960.JPG') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-60" alt="Fashion">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8">
                        <h3 class="text-2xl font-bold text-white mb-2">Fashion & Lookbooks</h3>
                        <p class="text-gray-300 text-sm max-w-lg">From minimal, catalogue‑ready frames to editorial sets. Quick lighting resets, wardrobe changes, and modular props for variety.</p>
                    </div>
                </div>

                {{-- Item 3: Product --}}
                <div class="group relative overflow-hidden rounded-2xl bg-black md:col-span-2 reveal-up delay-200" x-intersect="$el.classList.add('is-visible')">
                    <img src="{{ asset('storage/studio/DSC01007.JPG') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-60" alt="Product">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8">
                        <h3 class="text-2xl font-bold text-white mb-2">Product & E-commerce</h3>
                        <p class="text-gray-300 text-sm max-w-lg">Lights and modifiers tuned for fast, repeatable results. Perfect for reflective surfaces, apparel, accessories, or cosmetics.</p>
                    </div>
                </div>

                {{-- Item 4: Podcast --}}
                <div class="group relative overflow-hidden rounded-2xl bg-black md:col-span-1 reveal-up delay-300" x-intersect="$el.classList.add('is-visible')">
                    <img src="{{ asset('storage/studio/DSC01012.JPG') }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-60" alt="Podcast">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8">
                        <h3 class="text-2xl font-bold text-white mb-2">Podcast & Shows</h3>
                        <p class="text-gray-300 text-sm">Comfort and acoustics with clean backgrounds. Dynamic mics and soft LED panels for professional quality.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How it flows --}}
    <section class="py-20 bg-white border-b border-gray-100" id="flow">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal-up" x-intersect="$el.classList.add('is-visible')">
                <h2 class="text-3xl font-bold text-gray-900">How a typical booking flows</h2>
            </div>

            <div class="relative">
                {{-- Connecting Line --}}
                <div class="hidden md:block absolute top-12 left-0 w-full h-0.5 bg-gray-100 -z-10"></div>

                <div class="grid md:grid-cols-3 gap-12">
                    {{-- Step 1 --}}
                    <div class="relative bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition reveal-up" x-intersect="$el.classList.add('is-visible')">
                        <div class="h-10 w-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg mb-6 mx-auto md:mx-0 shadow-lg shadow-blue-200">1</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 text-center md:text-left">Pre‑production</h3>
                        <p class="text-gray-600 text-sm leading-relaxed text-center md:text-left">Share a quick brief with references and preferred dates. We help map backdrops, lighting approach and props so the floor is production‑ready.</p>
                    </div>

                    {{-- Step 2 --}}
                    <div class="relative bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition reveal-up delay-100" x-intersect="$el.classList.add('is-visible')">
                        <div class="h-10 w-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg mb-6 mx-auto md:mx-0 shadow-lg shadow-blue-200">2</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 text-center md:text-left">On the day</h3>
                        <p class="text-gray-600 text-sm leading-relaxed text-center md:text-left">Arrive to a clean, organized set. Use the makeup room for prep, then rotate through looks while our assistant helps with stands and resets.</p>
                    </div>

                    {{-- Step 3 --}}
                    <div class="relative bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition reveal-up delay-200" x-intersect="$el.classList.add('is-visible')">
                        <div class="h-10 w-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg mb-6 mx-auto md:mx-0 shadow-lg shadow-blue-200">3</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 text-center md:text-left">Wrap & handoff</h3>
                        <p class="text-gray-600 text-sm leading-relaxed text-center md:text-left">Review selects on set. We assist with safe pack‑down and basic backups so your cards travel securely and the space is ready for the next team.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Choose Us (Amenities) --}}
    <section class="py-20 bg-gray-50" id="why">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal-up" x-intersect="$el.classList.add('is-visible')">
                <span class="text-blue-600 font-bold tracking-widest uppercase text-xs">Why Us</span>
                <h2 class="mt-2 text-3xl font-bold text-gray-900">Why teams choose this studio</h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition reveal-up" x-intersect="$el.classList.add('is-visible')">
                    <h3 class="font-bold text-lg mb-2">Flexible Availability</h3>
                    <p class="text-sm text-gray-600">24×7 slots for early starts, late‑night shoots and quick turnarounds.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition reveal-up delay-100" x-intersect="$el.classList.add('is-visible')">
                    <h3 class="font-bold text-lg mb-2">Production Support</h3>
                    <p class="text-sm text-gray-600">On‑floor assistant to help move stands, shape light and reset sets.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition reveal-up delay-200" x-intersect="$el.classList.add('is-visible')">
                    <h3 class="font-bold text-lg mb-2">Modular Sets</h3>
                    <p class="text-sm text-gray-600">Textured walls, plain backgrounds and simple props for distinct moods.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition reveal-up delay-300" x-intersect="$el.classList.add('is-visible')">
                    <h3 class="font-bold text-lg mb-2">Organized Spaces</h3>
                    <p class="text-sm text-gray-600">Makeup, green room and floor planned to reduce clutter and friction.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQs --}}
    <section class="py-20 bg-white" id="faqs" x-data="{ active: null }">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal-up" x-intersect="$el.classList.add('is-visible')">
                <h2 class="text-3xl font-bold text-gray-900">FAQs about services</h2>
            </div>
            
            <div class="space-y-4 reveal-up delay-100" x-intersect="$el.classList.add('is-visible')">
                <div class="rounded-xl border border-gray-200 overflow-hidden">
                    <button @click="active = (active === 1 ? null : 1)" class="flex w-full items-center justify-between p-5 text-left font-bold text-gray-900 hover:bg-gray-50">
                        <span>Can you help with creative direction?</span>
                        <svg class="h-5 w-5 transform transition-transform" :class="active === 1 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="active === 1" x-collapse class="p-5 pt-0 text-sm text-gray-600">
                        We guide lighting, backdrop choices and set flow. For end‑to‑end direction, we coordinate with trusted stylists, art directors and producers on request.
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200 overflow-hidden">
                    <button @click="active = (active === 2 ? null : 2)" class="flex w-full items-center justify-between p-5 text-left font-bold text-gray-900 hover:bg-gray-50">
                        <span>Do you offer crew and equipment add‑ons?</span>
                        <svg class="h-5 w-5 transform transition-transform" :class="active === 2 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="active === 2" x-collapse class="p-5 pt-0 text-sm text-gray-600">
                        Yes. Add podcast mics, constant lights, and an edit room. For cameras and specialty grip we connect you with partner rentals to keep workflows reliable.
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200 overflow-hidden">
                    <button @click="active = (active === 3 ? null : 3)" class="flex w-full items-center justify-between p-5 text-left font-bold text-gray-900 hover:bg-gray-50">
                        <span>What’s the best way to plan a first visit?</span>
                        <svg class="h-5 w-5 transform transition-transform" :class="active === 3 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="active === 3" x-collapse class="p-5 pt-0 text-sm text-gray-600">
                        Browse the <a class="text-blue-600 hover:underline" href="{{ route('pages.pricing') }}">pricing</a> and <a class="text-blue-600 hover:underline" href="{{ route('pages.about') }}">about</a> pages, then write to us via <a class="text-blue-600 hover:underline" href="{{ route('pages.contact') }}">contact</a> with your brief and dates. We will confirm availability and a plan within a business day.
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
