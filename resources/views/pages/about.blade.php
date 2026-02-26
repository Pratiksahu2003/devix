@extends('layouts.app')

@section('title', 'About '.config('company.brand').' | Rental Podcast & Content Studio')

@section('meta')
    <meta name="description"
        content="Learn about {{ config('company.brand') }}, a rental podcast and content studio in Delhi NCR offering photography, videography, podcast and edit spaces for creators, brands and agencies." />
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-black text-white h-[70vh] min-h-[500px] flex items-center justify-center">
        <div class="absolute inset-0 z-0">
            <img 
                src="{{ asset('storage/room/IMG_0787.jpeg') }}" 
                alt="Studio Background" 
                class="h-full w-full object-cover opacity-40 animate-pan-slow"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
        </div>
        <div class="relative z-10 mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 text-center" x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 100)">
            <p 
                class="mb-6 text-sm font-bold uppercase tracking-[0.2em] text-[var(--color-brand-lens-blue)] transition-all duration-1000 transform translate-y-4 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                Our Story
            </p>
            <h1 
                class="text-5xl font-bold tracking-tight sm:text-7xl lg:text-8xl transition-all duration-1000 delay-200 transform translate-y-8 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                A Studio That Fits <br class="hidden sm:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[var(--color-brand-lens-blue)] to-blue-400">Every Frame.</span>
            </h1>
            <p 
                class="mx-auto mt-8 max-w-2xl text-xl text-gray-300 leading-relaxed font-light transition-all duration-1000 delay-500 transform translate-y-8 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                Born in Delhi. Built for Creators. We’re not just a rental space; we’re a creative partner for photographers, filmmakers, and podcasters.
            </p>
        </div>
    </section>

    {{-- Mission & Values --}}
    <section class="py-24 bg-white overflow-hidden">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-16 lg:grid-cols-2 lg:gap-24 items-center">
                <div class="space-y-8" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true">
                    <h2 
                        class="text-4xl font-bold text-[var(--color-text-main)] sm:text-5xl transition-all duration-1000 transform -translate-x-8 opacity-0"
                        :class="{ 'translate-x-0 opacity-100': shown }"
                    >
                        Born in the Capital City
                    </h2>
                    <div 
                        class="space-y-6 text-lg text-[var(--color-text-muted)] leading-relaxed transition-all duration-1000 delay-200 transform translate-y-4 opacity-0"
                        :class="{ 'translate-y-0 opacity-100': shown }"
                    >
                        <p>
                            {{ config('company.brand') }} was created to give photographers, filmmakers, and podcasters in Delhi NCR a flexible, reliable space to work from. Instead of juggling separate spaces for shoots, makeup, and editing, we’ve brought everything together under one roof.
                        </p>
                        <p>
                            Whether you’re an independent creator, an in‑house brand team, or an agency, you’ll find a studio that feels like an extension of your own workspace.
                        </p>
                    </div>
                    
                    <div 
                        class="grid grid-cols-2 gap-8 mt-12 transition-all duration-1000 delay-500 transform translate-y-4 opacity-0"
                        :class="{ 'translate-y-0 opacity-100': shown }"
                    >
                        <div class="pl-6 border-l-4 border-[var(--color-brand-lens-blue)]">
                            <p class="text-4xl font-bold text-[var(--color-text-main)]">24/7</p>
                            <p class="text-base text-[var(--color-text-muted)] font-medium mt-1">Access Available</p>
                        </div>
                        <div class="pl-6 border-l-4 border-[var(--color-brand-lens-blue)]">
                            <p class="text-4xl font-bold text-[var(--color-text-main)]">1200+</p>
                            <p class="text-base text-[var(--color-text-muted)] font-medium mt-1">Sq. Ft. Space</p>
                        </div>
                    </div>
                </div>
                
                <div class="relative grid grid-cols-2 gap-6" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true">
                    <div 
                        class="space-y-6 pt-12 transition-all duration-1000 delay-200 transform translate-y-12 opacity-0"
                        :class="{ 'translate-y-0 opacity-100': shown }"
                    >
                        <img src="{{ asset('storage/room/IMG_0780.jpeg') }}" alt="Team Meeting" class="rounded-3xl shadow-xl w-full h-64 object-cover hover:scale-105 transition duration-500">
                        <img src="{{ asset('storage/room/IMG_0783.jpeg') }}" alt="Studio Vibe" class="rounded-3xl shadow-xl w-full h-48 object-cover hover:scale-105 transition duration-500">
                    </div>
                    <div 
                        class="space-y-6 transition-all duration-1000 delay-400 transform translate-y-12 opacity-0"
                        :class="{ 'translate-y-0 opacity-100': shown }"
                    >
                        <img src="{{ asset('storage/room/IMG_0781.jpeg') }}" alt="Studio Set" class="rounded-3xl shadow-xl w-full h-48 object-cover hover:scale-105 transition duration-500">
                        <img src="{{ asset('storage/room/IMG_0785.jpeg') }}" alt="Creative Space" class="rounded-3xl shadow-xl w-full h-64 object-cover hover:scale-105 transition duration-500">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Beliefs --}}
    <section class="py-24 bg-[var(--color-surface-muted)] relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-5 pointer-events-none">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 L100 0 L100 100 Z" fill="currentColor" class="text-blue-600"/>
            </svg>
        </div>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20 max-w-3xl mx-auto">
                <h2 class="text-4xl font-bold text-[var(--color-text-main)] mb-6">What We Believe In</h2>
                <p class="text-xl text-[var(--color-text-muted)]">Our philosophy is simple: Remove friction, add value.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-10 rounded-[2rem] shadow-sm border border-[var(--color-border-subtle)] hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                    <div class="h-14 w-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-8 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Respecting Time</h3>
                    <p class="text-base text-[var(--color-text-muted)] leading-relaxed">
                        We honor your call times with military precision. The floor is prepped before you arrive, so you spend time shooting, not setting up.
                    </p>
                </div>

                <div class="bg-white p-10 rounded-[2rem] shadow-sm border border-[var(--color-border-subtle)] hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                    <div class="h-14 w-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center mb-8 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Production Quality</h3>
                    <p class="text-base text-[var(--color-text-muted)] leading-relaxed">
                        We invest in industry-standard lighting (Godox, Aputure) and modifiers because we know that gear makes a visible difference.
                    </p>
                </div>

                <div class="bg-white p-10 rounded-[2rem] shadow-sm border border-[var(--color-border-subtle)] hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                    <div class="h-14 w-14 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center mb-8 group-hover:bg-green-600 group-hover:text-white transition-colors">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Partnership</h3>
                    <p class="text-base text-[var(--color-text-muted)] leading-relaxed">
                        We work as partners with creators, not just as a four-wall rental. Need an extra hand? Our assistants are trained to help.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Grid --}}
    <section class="py-24 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-[var(--color-text-main)] mb-16 text-center">Inside the Studio</h2>
            
            <div class="columns-2 md:columns-4 gap-4 space-y-4">
                {{-- Column 1 --}}
                <div class="break-inside-avoid relative group overflow-hidden rounded-2xl">
                    <img class="w-full object-cover transition duration-700 group-hover:scale-110" src="{{ asset('storage/room/IMG_0782.jpeg') }}" alt="Podcast Setup">
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300"></div>
                </div>
                <div class="break-inside-avoid relative group overflow-hidden rounded-2xl">
                    <img class="w-full object-cover transition duration-700 group-hover:scale-110" src="{{ asset('storage/room/IMG_0776.jpeg') }}" alt="Marketing Shoot">
                     <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300"></div>
                </div>

                 {{-- Column 2 --}}
                <div class="break-inside-avoid relative group overflow-hidden rounded-2xl">
                    <img class="w-full object-cover transition duration-700 group-hover:scale-110" src="{{ asset('storage/room/IMG_0769.jpeg') }}" alt="Lighting Grid">
                     <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300"></div>
                </div>
                <div class="break-inside-avoid relative group overflow-hidden rounded-2xl">
                    <img class="w-full object-cover transition duration-700 group-hover:scale-110" src="{{ asset('storage/room/IMG_0774.jpeg') }}" alt="Edit Suite">
                     <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300"></div>
                </div>

                 {{-- Column 3 --}}
                <div class="break-inside-avoid relative group overflow-hidden rounded-2xl">
                    <img class="w-full object-cover transition duration-700 group-hover:scale-110" src="{{ asset('storage/room/IMG_0779.jpeg') }}" alt="Product Photography">
                     <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300"></div>
                </div>
                <div class="break-inside-avoid relative group overflow-hidden rounded-2xl">
                    <img class="w-full object-cover transition duration-700 group-hover:scale-110" src="{{ asset('storage/room/IMG_0772.jpeg') }}" alt="Camera Gear">
                     <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300"></div>
                </div>

                 {{-- Column 4 --}}
                <div class="break-inside-avoid relative group overflow-hidden rounded-2xl">
                    <img class="w-full object-cover transition duration-700 group-hover:scale-110" src="{{ asset('storage/room/IMG_0777.jpeg') }}" alt="Makeup Station">
                     <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300"></div>
                </div>
                <div class="break-inside-avoid relative group overflow-hidden rounded-2xl">
                    <img class="w-full object-cover transition duration-700 group-hover:scale-110" src="{{ asset('storage/room/IMG_0773.jpeg') }}" alt="Cyclorama Wall">
                     <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-[var(--color-brand-lens-blue)] py-24 text-center text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="mx-auto max-w-4xl px-4 relative z-10">
            <h2 class="text-4xl font-bold tracking-tight sm:text-5xl mb-6">
                Ready to create something amazing?
            </h2>
            <p class="text-xl text-blue-100 mb-10 max-w-2xl mx-auto leading-relaxed">
                Join hundreds of creators who trust {{ config('company.brand') }} for their production needs.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-5">
                <a href="{{ route('pages.booking') }}" class="inline-block rounded-full bg-white px-10 py-4 text-base font-bold text-[var(--color-brand-lens-blue)] shadow-xl hover:bg-gray-50 hover:scale-105 transition transform duration-200">
                    Book Studio
                </a>
                <a href="{{ route('pages.contact') }}" class="inline-block rounded-full border-2 border-white px-10 py-4 text-base font-bold text-white hover:bg-white/10 hover:scale-105 transition transform duration-200">
                    Contact Us
                </a>
            </div>
        </div>
    </section>
@endsection
