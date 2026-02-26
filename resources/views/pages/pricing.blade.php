@extends('layouts.app')

@section('title', 'Studio Pricing | '.config('company.brand'))

@section('content')
    {{-- Hero & Pricing Table --}}
    <div class="bg-[var(--color-surface-strong)] pt-12 pb-6">
        <div class="text-center container mx-auto px-6 mb-12">
            <span class="inline-block py-1 px-3 rounded-full bg-[var(--color-brand-lens-blue)]/20 text-[var(--color-brand-lens-blue)] text-sm font-semibold mb-6 backdrop-blur-sm border border-[var(--color-brand-lens-blue)]/30">
                Transparent Rates
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Simple, All-Inclusive Pricing</h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                No hidden fees. No surprise charges. Just professional space for your creative needs.
            </p>
        </div>
        <x-home.pricing />
    </div>

    {{-- What's Included Section --}}
    <section class="py-24 bg-[var(--color-surface)] border-b border-[var(--color-border-subtle)] relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1">
                    <h2 class="text-3xl font-bold text-[var(--color-text-main)] mb-8">What’s included in every booking</h2>
                    
                    <div class="grid gap-8 sm:grid-cols-2">
                        <div class="space-y-3">
                            <div class="w-10 h-10 rounded-full bg-blue-50 text-[var(--color-brand-lens-blue)] flex items-center justify-center mb-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                            </div>
                            <h3 class="font-bold text-[var(--color-text-main)] text-lg">Production‑ready Floor</h3>
                            <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">
                                Clean, organized sets with access to textured walls and plain backgrounds. Power, stands and basic grip are arranged so you can start lighting immediately.
                            </p>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="w-10 h-10 rounded-full bg-green-50 text-green-600 flex items-center justify-center mb-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                            </div>
                            <h3 class="font-bold text-[var(--color-text-main)] text-lg">Assistant on Floor</h3>
                            <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">
                                Help with lights, stands and resets to keep momentum steady between looks and to reduce time‑overruns that increase cost without improving results.
                            </p>
                        </div>

                        <div class="space-y-3">
                            <div class="w-10 h-10 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center mb-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                            </div>
                            <h3 class="font-bold text-[var(--color-text-main)] text-lg">Makeup Room</h3>
                            <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">
                                A dedicated space for wardrobe, makeup and quick resets so talent stays camera‑ready and the floor stays clutter‑free.
                            </p>
                        </div>

                        <div class="space-y-3">
                            <div class="w-10 h-10 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center mb-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <h3 class="font-bold text-[var(--color-text-main)] text-lg">Flexible Slots</h3>
                            <p class="text-[var(--color-text-muted)] text-sm leading-relaxed">
                                24×7 availability so you can schedule early starts or late finishes around your crew and client availability.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="order-1 lg:order-2">
                    <div class="relative rounded-[2rem] overflow-hidden shadow-2xl group">
                        <img src="{{ asset('storage/room/IMG_0779.jpeg') }}" alt="Studio Floor" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="py-24 bg-[var(--color-surface-muted)]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-[var(--color-text-main)] mb-4">Choose Your Pace</h2>
                <p class="text-[var(--color-text-muted)] max-w-2xl mx-auto">Whether it's a quick update or a full campaign, we have a plan that fits.</p>
            </div>
            
            <div class="grid gap-8 lg:grid-cols-3">
                {{-- Case 1 --}}
                <div class="bg-[var(--color-surface)] rounded-3xl overflow-hidden shadow-sm border border-[var(--color-border-subtle)] group hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="h-64 overflow-hidden relative">
                        <img src="{{ asset('storage/room/IMG_0772.jpeg') }}" alt="Hourly Booking" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-[var(--color-text-main)] shadow-sm">Hourly</div>
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="font-bold text-xl text-[var(--color-text-main)] mb-3">Pay per hour</h3>
                        <p class="text-[var(--color-text-muted)] text-sm leading-relaxed mb-6 flex-1">
                            Best for quick portrait updates, small catalogue sets or one‑off corporate interviews. Book the minimum and extend by the hour if you need more time.
                        </p>
                        <a href="{{ route('pages.booking') }}" class="inline-flex items-center text-[var(--color-brand-lens-blue)] font-bold hover:underline">
                            Book Hourly <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </a>
                    </div>
                </div>

                {{-- Case 2 --}}
                <div class="bg-[var(--color-surface)] rounded-3xl overflow-hidden shadow-sm border border-[var(--color-border-subtle)] group hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="h-64 overflow-hidden relative">
                        <img src="{{ asset('storage/room/IMG_0773.jpeg') }}" alt="Day Booking" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 right-4 bg-[var(--color-brand-lens-blue)]/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-white shadow-sm">Popular</div>
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="font-bold text-xl text-[var(--color-text-main)] mb-3">Pay per day</h3>
                        <p class="text-[var(--color-text-muted)] text-sm leading-relaxed mb-6 flex-1">
                            Ideal for lookbooks, product batches and content sprints where volume and variations matter. The day rate reduces per‑frame cost and planning friction.
                        </p>
                        <a href="{{ route('pages.booking') }}" class="inline-flex items-center text-[var(--color-brand-lens-blue)] font-bold hover:underline">
                            Book Full Day <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </a>
                    </div>
                </div>

                {{-- Case 3 --}}
                <div class="bg-[var(--color-surface)] rounded-3xl overflow-hidden shadow-sm border border-[var(--color-border-subtle)] group hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="h-64 overflow-hidden relative">
                        <img src="{{ asset('storage/room/IMG_0777.jpeg') }}" alt="All In Booking" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 right-4 bg-purple-500/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-white shadow-sm">Campaign</div>
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="font-bold text-xl text-[var(--color-text-main)] mb-3">All In Package</h3>
                        <p class="text-[var(--color-text-muted)] text-sm leading-relaxed mb-6 flex-1">
                            For campaigns and long‑form content where you need the entire space, maximum lighting options and a clear run‑of‑show without juggling add‑ons.
                        </p>
                        <a href="{{ route('pages.booking') }}" class="inline-flex items-center text-[var(--color-brand-lens-blue)] font-bold hover:underline">
                            Contact for Quote <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="py-24 bg-[var(--color-surface)] border-t border-[var(--color-border-subtle)]">
        <div class="container mx-auto px-6 max-w-4xl">
            <h2 class="text-3xl font-bold text-[var(--color-text-main)] mb-12 text-center">Frequently Asked Questions</h2>
            
            <div class="space-y-6">
                <div class="bg-[var(--color-surface-muted)] rounded-2xl p-6 border border-[var(--color-border-subtle)]">
                    <h3 class="font-bold text-lg text-[var(--color-text-main)] mb-2">What’s the minimum booking?</h3>
                    <p class="text-[var(--color-text-muted)]">Three hours. You can extend in hourly blocks or upgrade to a day or all‑in package if your shot list expands.</p>
                </div>

                <div class="bg-[var(--color-surface-muted)] rounded-2xl p-6 border border-[var(--color-border-subtle)]">
                    <h3 class="font-bold text-lg text-[var(--color-text-main)] mb-2">How do add‑ons work?</h3>
                    <p class="text-[var(--color-text-muted)]">Add podcast mics, constant lights or the edit room as needed. We keep add‑ons straightforward so budgets stay predictable, not surprising.</p>
                </div>

                <div class="bg-[var(--color-surface-muted)] rounded-2xl p-6 border border-[var(--color-border-subtle)]">
                    <h3 class="font-bold text-lg text-[var(--color-text-main)] mb-2">Do you charge extra for late hours?</h3>
                    <p class="text-[var(--color-text-muted)]">Slots are available 24×7. For significantly late wraps, we plan buffer time so teams can pack down safely without rushing.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
