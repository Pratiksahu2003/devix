@extends('layouts.app')

@section('title', 'Make a Booking | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Book your session at {{ config('company.brand') }}. Simple 3-step process, transparent rates, and full production support for your next shoot." />
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="relative min-h-[70vh] flex items-center justify-center overflow-hidden bg-black text-white" x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 100)">
        {{-- Background Image --}}
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-black z-10"></div>
            <img 
                src="{{ asset('storage/room/IMG_0787.jpeg') }}" 
                alt="Studio Booking" 
                class="w-full h-full object-cover opacity-60 transition-transform duration-[3s] ease-out scale-105"
                :class="{ 'scale-100': shown }"
            >
        </div>

        <div class="relative z-20 container mx-auto px-6 text-center pt-20">
            <div 
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-8 transition-all duration-1000 transform translate-y-4 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                <span class="flex h-2 w-2 rounded-full bg-[var(--color-brand-lens-blue)]"></span>
                <span class="text-sm font-medium tracking-wide uppercase">Open for Bookings 24/7</span>
            </div>
            
            <h1 
                class="text-5xl md:text-7xl lg:text-8xl font-bold tracking-tight mb-8 transition-all duration-1000 delay-200 transform translate-y-8 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                Create Without <br />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[var(--color-brand-lens-blue)] to-purple-400">Compromise.</span>
            </h1>
            
            <p 
                class="text-xl text-gray-300 max-w-2xl mx-auto mb-12 leading-relaxed transition-all duration-1000 delay-400 transform translate-y-8 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                Seamless production workflows. Professional support. The space you need to bring your vision to life.
            </p>
            
            <div 
                class="flex flex-col sm:flex-row gap-6 justify-center transition-all duration-1000 delay-600 transform translate-y-8 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                <a href="#form" class="group relative px-8 py-4 bg-[var(--color-brand-lens-blue)] text-white rounded-full font-bold overflow-hidden">
                    <div class="absolute inset-0 w-full h-full bg-white/20 group-hover:translate-x-full transition-transform duration-500 ease-out -translate-x-full"></div>
                    <span class="relative">Start Booking</span>
                </a>
                <a href="{{ route('pages.pricing') }}" class="px-8 py-4 bg-white/5 text-white rounded-full font-bold hover:bg-white/10 transition-all backdrop-blur-md border border-white/20">
                    View Pricing
                </a>
            </div>
        </div>
        
        {{-- Scroll Indicator --}}
        <div 
            class="absolute bottom-10 left-1/2 transform -translate-x-1/2 transition-all duration-1000 delay-1000 opacity-0"
            :class="{ 'opacity-100': shown }"
        >
            <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center p-2">
                <div class="w-1 h-1.5 bg-white rounded-full animate-bounce"></div>
            </div>
        </div>
    </section>

    {{-- The Process Section --}}
    <section class="py-32 bg-[var(--color-surface)] relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-24">
                <h2 class="text-4xl font-bold text-[var(--color-text-main)] mb-6">Streamlined Booking Process</h2>
                <p class="text-[var(--color-text-muted)] text-xl max-w-2xl mx-auto">
                    From first click to final wrap, we've removed the friction so you can focus on creating.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-12 relative">
                {{-- Connecting Line --}}
                <div class="hidden md:block absolute top-12 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-[var(--color-border-subtle)] to-transparent z-0"></div>
                
                {{-- Step 1 --}}
                <div class="relative z-10 group" x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                    <div class="bg-[var(--color-surface)] p-8 rounded-[2rem] border border-[var(--color-border-subtle)] transition-all duration-500 hover:shadow-2xl hover:border-[var(--color-brand-lens-blue)]/30 h-full flex flex-col items-center text-center">
                        <div 
                            class="w-24 h-24 rounded-2xl bg-[var(--color-surface-muted)] flex items-center justify-center text-3xl font-bold text-[var(--color-brand-lens-blue)] mb-8 shadow-inner transition-all duration-500 transform group-hover:scale-110 group-hover:rotate-3"
                            :class="{ 'bg-[var(--color-brand-lens-blue)] text-white': hover }"
                        >
                            1
                        </div>
                        <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Inquire & Brief</h3>
                        <p class="text-[var(--color-text-muted)] leading-relaxed">
                            Fill out the form below. Tell us your dates, team size, and gear needs. We'll check the calendar instantly.
                        </p>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="relative z-10 group" x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                    <div class="bg-[var(--color-surface)] p-8 rounded-[2rem] border border-[var(--color-border-subtle)] transition-all duration-500 hover:shadow-2xl hover:border-[var(--color-brand-lens-blue)]/30 h-full flex flex-col items-center text-center">
                        <div 
                            class="w-24 h-24 rounded-2xl bg-[var(--color-surface-muted)] flex items-center justify-center text-3xl font-bold text-[var(--color-brand-lens-blue)] mb-8 shadow-inner transition-all duration-500 transform group-hover:scale-110 group-hover:-rotate-3"
                            :class="{ 'bg-[var(--color-brand-lens-blue)] text-white': hover }"
                        >
                            2
                        </div>
                        <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Confirm & Plan</h3>
                        <p class="text-[var(--color-text-muted)] leading-relaxed">
                            Receive a custom quote and call sheet. Lock it in with a deposit. We prep the floor before you arrive.
                        </p>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="relative z-10 group" x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                    <div class="bg-[var(--color-surface)] p-8 rounded-[2rem] border border-[var(--color-border-subtle)] transition-all duration-500 hover:shadow-2xl hover:border-[var(--color-brand-lens-blue)]/30 h-full flex flex-col items-center text-center">
                        <div 
                            class="w-24 h-24 rounded-2xl bg-[var(--color-surface-muted)] flex items-center justify-center text-3xl font-bold text-[var(--color-brand-lens-blue)] mb-8 shadow-inner transition-all duration-500 transform group-hover:scale-110 group-hover:rotate-3"
                            :class="{ 'bg-[var(--color-brand-lens-blue)] text-white': hover }"
                        >
                            3
                        </div>
                        <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Shoot & Create</h3>
                        <p class="text-[var(--color-text-muted)] leading-relaxed">
                            Walk into a ready-to-shoot studio. Our assistant handles the grip while you handle the creative.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Amenities Bento Grid --}}
    <section class="py-32 bg-[var(--color-surface-muted)]">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16 items-center mb-16">
                <div>
                    <span class="text-[var(--color-brand-lens-blue)] font-bold tracking-wider uppercase text-sm mb-4 block">Everything Included</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-[var(--color-text-main)] mb-6">Production-Ready Standards</h2>
                    <p class="text-lg text-[var(--color-text-muted)] leading-relaxed">
                        We don't believe in hidden fees for essentials. Every booking includes full access to our premium amenities suite, designed to keep your cast and crew comfortable.
                    </p>
                </div>
                <div class="flex justify-end">
                    {{-- Decorative visual --}}
                    <div class="flex gap-4">
                        <div class="w-20 h-20 rounded-2xl bg-white shadow-lg flex items-center justify-center transform rotate-6">
                            <svg class="w-8 h-8 text-[var(--color-brand-lens-blue)]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <div class="w-20 h-20 rounded-2xl bg-[var(--color-brand-lens-blue)] shadow-lg flex items-center justify-center transform -rotate-6">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Large Feature Card --}}
                <div class="md:col-span-2 relative group overflow-hidden rounded-[2.5rem] bg-black h-[400px]">
                    <img src="{{ asset('storage/room/IMG_0774.jpeg') }}" alt="Studio Amenities" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-80 group-hover:opacity-60">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-10">
                        <h3 class="text-3xl font-bold text-white mb-2">Makeup & Styling Suite</h3>
                        <p class="text-gray-300 max-w-md">Dedicated vanity stations with daylight-balanced mirrors, clothing racks, and steamer.</p>
                    </div>
                </div>

                {{-- Amenity 1 --}}
                <div class="bg-[var(--color-surface)] p-8 rounded-[2.5rem] flex flex-col justify-between border border-[var(--color-border-subtle)] hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" /></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-[var(--color-text-main)] mb-2">1Gbps Fiber Wi-Fi</h4>
                        <p class="text-[var(--color-text-muted)] text-sm">Upload rushes instantly.</p>
                    </div>
                </div>

                {{-- Amenity 2 --}}
                <div class="bg-[var(--color-surface)] p-8 rounded-[2.5rem] flex flex-col justify-between border border-[var(--color-border-subtle)] hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" /></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-[var(--color-text-main)] mb-2">Bluetooth Sound</h4>
                        <p class="text-[var(--color-text-muted)] text-sm">Set the vibe for your shoot.</p>
                    </div>
                </div>

                {{-- Amenity 3 --}}
                <div class="bg-[var(--color-surface)] p-8 rounded-[2.5rem] flex flex-col justify-between border border-[var(--color-border-subtle)] hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 rounded-full bg-green-50 text-green-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-[var(--color-text-main)] mb-2">Private Changing</h4>
                        <p class="text-[var(--color-text-muted)] text-sm">Discreet area for talent.</p>
                    </div>
                </div>

                {{-- Amenity 4 --}}
                <div class="bg-[var(--color-surface)] p-8 rounded-[2.5rem] flex flex-col justify-between border border-[var(--color-border-subtle)] hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a4.978 4.978 0 01-1.414-2.83m-1.414 5.658a9 9 0 01-2.167-9.238m7.824 2.167a1 1 0 111.414 1.414m-1.414-1.414L3 3m8.293 8.293l1.414 1.414" /></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-[var(--color-text-main)] mb-2">Grip Package</h4>
                        <p class="text-[var(--color-text-muted)] text-sm">Stands, bags, clamps included.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Add-ons Section --}}
    <section class="py-32 bg-[var(--color-surface)]">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
                <div>
                    <h2 class="text-4xl font-bold text-[var(--color-text-main)] mb-4">Upgrade Your Shoot</h2>
                    <p class="text-xl text-[var(--color-text-muted)]">Premium add-ons to enhance your production value.</p>
                </div>
                <a href="{{ route('pages.pricing') }}" class="text-[var(--color-brand-lens-blue)] font-bold flex items-center hover:underline">
                    See Full Price List <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                {{-- Add-on 1 --}}
                <div class="group relative bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-[var(--color-border-subtle)] hover:-translate-y-2">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('storage/room/IMG_0780.jpeg') }}" alt="Studio Assistant" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-[var(--color-brand-lens-blue)]">
                            Most Popular
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-2xl text-[var(--color-text-main)]">Studio Assistant</h3>
                            <span class="text-lg font-bold text-[var(--color-brand-lens-blue)]">₹1,500</span>
                        </div>
                        <p class="text-[var(--color-text-muted)] leading-relaxed mb-6">
                            Hands-on help with lighting changes, set moves, and gear management. Keep your shoot moving fast.
                        </p>
                        <ul class="space-y-2 text-sm text-[var(--color-text-muted)]">
                            <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Lighting Setup</li>
                            <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Gear Runner</li>
                        </ul>
                    </div>
                </div>

                {{-- Add-on 2 --}}
                <div class="group relative bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-[var(--color-border-subtle)] hover:-translate-y-2">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('storage/room/IMG_0776.jpeg') }}" alt="Camera Package" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-2xl text-[var(--color-text-main)]">Camera Package</h3>
                            <span class="text-lg font-bold text-[var(--color-brand-lens-blue)]">₹3,000+</span>
                        </div>
                        <p class="text-[var(--color-text-muted)] leading-relaxed mb-6">
                            High-end cinema and hybrid cameras available on-site. Save on rental transport logistics.
                        </p>
                        <ul class="space-y-2 text-sm text-[var(--color-text-muted)]">
                            <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Sony A7IV / FX3</li>
                            <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> GM Lens Selection</li>
                        </ul>
                    </div>
                </div>

                {{-- Add-on 3 --}}
                <div class="group relative bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-[var(--color-border-subtle)] hover:-translate-y-2">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('storage/room/IMG_0783.jpeg') }}" alt="Set Building" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-2xl text-[var(--color-text-main)]">Set Building</h3>
                            <span class="text-lg font-bold text-[var(--color-brand-lens-blue)]">Custom</span>
                        </div>
                        <p class="text-[var(--color-text-muted)] leading-relaxed mb-6">
                            Need a specific look? We can paint flats, source props, or build custom set pieces before you arrive.
                        </p>
                        <ul class="space-y-2 text-sm text-[var(--color-text-muted)]">
                            <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Painted Flats</li>
                            <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Prop Sourcing</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Booking Form Wrapper --}}
    <div id="form" class="scroll-mt-24 py-32 bg-[var(--color-surface-muted)]">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-[var(--color-border-subtle)]">
                <div class="bg-[var(--color-brand-lens-blue)] p-12 text-center text-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent"></div>
                    <h2 class="text-3xl font-bold relative z-10">Start Your Project</h2>
                    <p class="mt-2 text-blue-100 relative z-10">Fill in the details below and we'll get back to you within 2 hours.</p>
                </div>
                <div class="p-8 md:p-12">
                    <x-home.contact />
                </div>
            </div>
        </div>
    </div>
@endsection
