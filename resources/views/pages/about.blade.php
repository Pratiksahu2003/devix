@extends('layouts.app')

@section('title', 'About '.config('company.brand').' | Rental Podcast & Content Studio')

@section('meta')
    <meta name="description"
        content="Learn about {{ config('company.brand') }}, a rental podcast and content studio in Delhi NCR offering photography, videography, podcast and edit spaces for creators, brands and agencies." />
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-black text-white pt-20 pb-24 lg:pt-32 lg:pb-40">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1598550476439-6847785fcea6?auto=format&fit=crop&w=1920&q=80" alt="Studio Background" class="h-full w-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
        </div>
        <div class="relative z-10 mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 text-center">
            <p class="mb-4 text-xs font-bold uppercase tracking-widest text-[var(--color-brand-lens-blue)]">
                Our Story
            </p>
            <h1 class="text-4xl font-bold tracking-tight sm:text-5xl lg:text-7xl">
                A Studio That Fits <br class="hidden sm:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[var(--color-brand-lens-blue)] to-blue-400">Every Frame.</span>
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-300 leading-relaxed">
                Born in Delhi. Built for Creators. We’re not just a rental space; we’re a creative partner for photographers, filmmakers, and podcasters.
            </p>
        </div>
    </section>

    {{-- Mission & Values --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-2 lg:gap-20 items-center">
                <div class="space-y-8">
                    <h2 class="text-3xl font-bold text-[var(--color-text-main)] sm:text-4xl">
                        Born in the Capital City
                    </h2>
                    <p class="text-lg text-[var(--color-text-muted)] leading-relaxed">
                        {{ config('company.brand') }} was created to give photographers, filmmakers, and podcasters in Delhi NCR a flexible, reliable space to work from. Instead of juggling separate spaces for shoots, makeup, and editing, we’ve brought everything together under one roof.
                    </p>
                    <p class="text-lg text-[var(--color-text-muted)] leading-relaxed">
                        Whether you’re an independent creator, an in‑house brand team, or an agency, you’ll find a studio that feels like an extension of your own workspace.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6 mt-8">
                        <div class="pl-4 border-l-4 border-[var(--color-brand-lens-blue)]">
                            <p class="text-3xl font-bold text-[var(--color-text-main)]">24/7</p>
                            <p class="text-sm text-[var(--color-text-muted)]">Access Available</p>
                        </div>
                        <div class="pl-4 border-l-4 border-[var(--color-brand-lens-blue)]">
                            <p class="text-3xl font-bold text-[var(--color-text-main)]">1200+</p>
                            <p class="text-sm text-[var(--color-text-muted)]">Sq. Ft. Space</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=600&q=80" alt="Team Meeting" class="rounded-2xl shadow-lg w-full h-64 object-cover transform translate-y-8">
                    <img src="https://images.unsplash.com/photo-1542038784456-1ea8e935640e?auto=format&fit=crop&w=600&q=80" alt="Studio Set" class="rounded-2xl shadow-lg w-full h-64 object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- Core Beliefs --}}
    <section class="py-16 bg-[var(--color-surface-muted)]">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-[var(--color-text-main)]">What We Believe In</h2>
                <p class="mt-4 text-[var(--color-text-muted)]">Our philosophy is simple: Remove friction, add value.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-[var(--color-border-subtle)] hover:shadow-md transition">
                    <div class="h-12 w-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[var(--color-text-main)] mb-3">Respecting Time</h3>
                    <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">
                        We honor your call times with military precision. The floor is prepped before you arrive, so you spend time shooting, not setting up.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-[var(--color-border-subtle)] hover:shadow-md transition">
                    <div class="h-12 w-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[var(--color-text-main)] mb-3">Production Quality</h3>
                    <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">
                        We invest in industry-standard lighting (Godox, Aputure) and modifiers because we know that gear makes a visible difference.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-[var(--color-border-subtle)] hover:shadow-md transition">
                    <div class="h-12 w-12 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[var(--color-text-main)] mb-3">Partnership</h3>
                    <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">
                        We work as partners with creators, not just as a four-wall rental. Need an extra hand? Our assistants are trained to help.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Grid --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-[var(--color-text-main)] mb-12 text-center">Inside the Studio</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="grid gap-4">
                    <img class="h-auto max-w-full rounded-2xl object-cover hover:opacity-90 transition" src="https://images.unsplash.com/photo-1590602847861-f357a9332bbc?auto=format&fit=crop&w=600&q=80" alt="Podcast Setup">
                    <img class="h-auto max-w-full rounded-2xl object-cover hover:opacity-90 transition" src="https://images.unsplash.com/photo-1533750349088-cd871a92f312?auto=format&fit=crop&w=600&q=80" alt="Marketing Shoot">
                </div>
                <div class="grid gap-4">
                    <img class="h-auto max-w-full rounded-2xl object-cover hover:opacity-90 transition" src="https://images.unsplash.com/photo-1598550476439-6847785fcea6?auto=format&fit=crop&w=600&q=80" alt="Lighting Grid">
                    <img class="h-auto max-w-full rounded-2xl object-cover hover:opacity-90 transition" src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80" alt="Edit Suite">
                </div>
                <div class="grid gap-4">
                    <img class="h-auto max-w-full rounded-2xl object-cover hover:opacity-90 transition" src="https://images.unsplash.com/photo-1626785774573-4b7993125651?auto=format&fit=crop&w=600&q=80" alt="Product Photography">
                    <img class="h-auto max-w-full rounded-2xl object-cover hover:opacity-90 transition" src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=600&q=80" alt="Camera Gear">
                </div>
                <div class="grid gap-4">
                    <img class="h-auto max-w-full rounded-2xl object-cover hover:opacity-90 transition" src="https://images.unsplash.com/photo-1603575448360-153f093fd0b2?auto=format&fit=crop&w=600&q=80" alt="Makeup Station">
                    <img class="h-auto max-w-full rounded-2xl object-cover hover:opacity-90 transition" src="https://images.unsplash.com/photo-1574375927938-d5a98e8efe30?auto=format&fit=crop&w=600&q=80" alt="Cyclorama Wall">
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-[var(--color-brand-lens-blue)] py-16 text-center text-white">
        <div class="mx-auto max-w-4xl px-4">
            <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">
                Ready to create something amazing?
            </h2>
            <p class="mt-4 text-lg text-blue-100">
                Join hundreds of creators who trust {{ config('company.brand') }} for their production needs.
            </p>
            <div class="mt-8 flex justify-center gap-4">
                <a href="{{ route('pages.booking') }}" class="inline-block rounded-full bg-white px-8 py-3 text-sm font-bold text-[var(--color-brand-lens-blue)] shadow-lg hover:bg-gray-50 transition">
                    Book Studio
                </a>
                <a href="{{ route('pages.contact') }}" class="inline-block rounded-full border border-white px-8 py-3 text-sm font-bold text-white hover:bg-white/10 transition">
                    Contact Us
                </a>
            </div>
        </div>
    </section>
@endsection
