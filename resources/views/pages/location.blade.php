@extends('layouts.app')

@section('title', 'Location & Access | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Directions to {{ config('company.brand') }} in Dwarka Sector 13, New Delhi. Details on parking, metro access, and nearby amenities for your production team." />
@endsection

@section('content')
    {{-- Hero Map Section --}}
    <section class="relative h-[70vh] min-h-[600px] w-full bg-[var(--color-surface-strong)]">
        <iframe
            src="{{ config('company.map.embed_url') }}"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            class="absolute inset-0 grayscale contrast-125 opacity-70 hover:opacity-100 transition-opacity duration-700"
        ></iframe>
        
        {{-- Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-surface)] via-transparent to-black/30 pointer-events-none"></div>
        
        {{-- Floating Info Card --}}
        <div class="absolute bottom-0 left-0 w-full p-6 lg:p-12 pointer-events-none flex justify-center lg:justify-start">
            <div class="bg-[var(--color-surface)]/90 backdrop-blur-xl p-8 rounded-3xl border border-[var(--color-border-subtle)] shadow-2xl max-w-xl w-full pointer-events-auto transform hover:scale-[1.02] transition-transform duration-300">
                <div class="flex items-center gap-3 mb-4">
                    <span class="inline-flex items-center rounded-full bg-red-500/10 px-3 py-1 text-xs font-bold uppercase tracking-wider text-red-500 border border-red-500/20">
                        <span class="w-2 h-2 rounded-full bg-red-500 mr-2 animate-pulse"></span>
                        Live Location
                    </span>
                    <span class="inline-flex items-center rounded-full bg-[var(--color-surface-muted)] px-3 py-1 text-xs font-bold uppercase tracking-wider text-[var(--color-text-muted)]">
                        New Delhi
                    </span>
                </div>
                <h1 class="text-4xl font-bold text-[var(--color-text-main)] sm:text-5xl mb-2">
                    Dwarka Sector 13
                </h1>
                <p class="text-lg text-[var(--color-text-muted)] font-medium">
                    {{ config('company.address.landmark') }}
                </p>
                <div class="mt-6 flex flex-wrap gap-4">
                    <a href="{{ config('company.map.view_url') }}" target="_blank" class="flex-1 inline-flex justify-center items-center px-6 py-3 bg-[var(--color-brand-lens-blue)] text-white rounded-xl font-bold hover:bg-blue-600 transition-colors shadow-lg shadow-blue-900/20">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Get Directions
                    </a>
                    <button onclick="navigator.clipboard.writeText('{{ implode(', ', config('company.address.lines')) }}')" class="px-6 py-3 bg-[var(--color-surface-muted)] text-[var(--color-text-main)] rounded-xl font-bold hover:bg-[var(--color-border-subtle)] transition-colors border border-[var(--color-border-subtle)]">
                        Copy Address
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Getting Here Section --}}
    <section class="py-24 bg-[var(--color-surface)]">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16 items-start">
                <div>
                    <span class="text-[var(--color-brand-lens-blue)] font-bold tracking-wider uppercase text-sm mb-2 block">Travel Guide</span>
                    <h2 class="text-4xl font-bold text-[var(--color-text-main)] mb-10">Getting to the Studio</h2>
                    
                    <div class="space-y-8 relative">
                        {{-- Vertical Line --}}
                        <div class="absolute left-6 top-8 bottom-8 w-0.5 bg-[var(--color-border-subtle)] hidden sm:block"></div>

                        {{-- Address --}}
                        <div class="relative flex gap-6 group">
                            <div class="flex-shrink-0 hidden sm:block">
                                <div class="h-12 w-12 rounded-full bg-[var(--color-surface)] border-4 border-[var(--color-surface-muted)] flex items-center justify-center text-[var(--color-text-muted)] relative z-10 group-hover:border-[var(--color-brand-lens-blue)] transition-colors">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                </div>
                            </div>
                            <div class="bg-[var(--color-surface-muted)] p-6 rounded-2xl flex-grow border border-[var(--color-border-subtle)] group-hover:shadow-lg transition-all">
                                <h3 class="text-xl font-bold text-[var(--color-text-main)] mb-2">Studio Address</h3>
                                <p class="text-[var(--color-text-muted)] leading-relaxed">
                                    @foreach(config('company.address.lines') as $line)
                                        {{ $line }}<br>
                                    @endforeach
                                    <span class="text-sm text-[var(--color-brand-lens-blue)] font-medium mt-2 block">Landmark: {{ config('company.address.landmark') }}</span>
                                </p>
                            </div>
                        </div>

                        {{-- Metro --}}
                        <div class="relative flex gap-6 group">
                            <div class="flex-shrink-0 hidden sm:block">
                                <div class="h-12 w-12 rounded-full bg-[var(--color-surface)] border-4 border-[var(--color-surface-muted)] flex items-center justify-center text-[var(--color-text-muted)] relative z-10 group-hover:border-[var(--color-brand-lens-blue)] transition-colors">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                </div>
                            </div>
                            <div class="bg-[var(--color-surface-muted)] p-6 rounded-2xl flex-grow border border-[var(--color-border-subtle)] group-hover:shadow-lg transition-all">
                                <h3 class="text-xl font-bold text-[var(--color-text-main)] mb-2">Metro Access</h3>
                                <p class="text-[var(--color-text-muted)] leading-relaxed">
                                    We are conveniently located near <strong>Dwarka Sector 13 Metro Station</strong> (Blue Line). It's a quick 5-minute auto-rickshaw ride or a 15-minute walk from the station.
                                </p>
                            </div>
                        </div>

                        {{-- Parking --}}
                        <div class="relative flex gap-6 group">
                            <div class="flex-shrink-0 hidden sm:block">
                                <div class="h-12 w-12 rounded-full bg-[var(--color-surface)] border-4 border-[var(--color-surface-muted)] flex items-center justify-center text-[var(--color-text-muted)] relative z-10 group-hover:border-[var(--color-brand-lens-blue)] transition-colors">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                                </div>
                            </div>
                            <div class="bg-[var(--color-surface-muted)] p-6 rounded-2xl flex-grow border border-[var(--color-border-subtle)] group-hover:shadow-lg transition-all">
                                <h3 class="text-xl font-bold text-[var(--color-text-main)] mb-2">Parking & Loading</h3>
                                <p class="text-[var(--color-text-muted)] leading-relaxed">
                                    Ample street parking is available around the building. For load-in, you can pull up directly to the building entrance. Please notify us in advance for heavy equipment.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Visual Context --}}
                <div class="relative h-full min-h-[500px] rounded-[2.5rem] overflow-hidden shadow-2xl">
                    <div class="grid grid-rows-2 h-full gap-4 p-4 bg-[var(--color-surface-muted)]">
                        <div class="relative rounded-3xl overflow-hidden group">
                            <img src="{{ asset('storage/room/IMG_0785.jpeg') }}" alt="Studio Vibe" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6">
                                <p class="text-white font-bold text-xl">Your Creative Destination</p>
                            </div>
                        </div>
                        <div class="relative rounded-3xl overflow-hidden group">
                            <img src="{{ asset('storage/room/IMG_0782.jpeg') }}" alt="Studio Setup" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6">
                                <p class="text-white font-bold text-xl">Professional Environment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Neighborhood Section --}}
    <section class="py-24 bg-[var(--color-surface-muted)] border-t border-[var(--color-border-subtle)]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-[var(--color-text-main)] mb-4">In the Neighborhood</h2>
                <p class="text-[var(--color-text-muted)] max-w-2xl mx-auto">Everything you need within a 5-minute radius.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                {{-- Hotel --}}
                <div class="bg-[var(--color-surface)] p-8 rounded-3xl shadow-sm border border-[var(--color-border-subtle)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[var(--color-text-main)] mb-3">Radisson Blu Hotel</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">
                        5-star accommodation just a stone's throw away. Ideal for out-of-town talent or clients requiring premium stays.
                    </p>
                </div>

                {{-- Coffee --}}
                <div class="bg-[var(--color-surface)] p-8 rounded-3xl shadow-sm border border-[var(--color-border-subtle)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8h1a4 4 0 010 8h-1M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[var(--color-text-main)] mb-3">Cafes & Dining</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">
                        Multiple cafes and restaurants within walking distance (City Centre Mall) for crew lunch breaks and coffee runs.
                    </p>
                </div>

                {{-- Supplies --}}
                <div class="bg-[var(--color-surface)] p-8 rounded-3xl shadow-sm border border-[var(--color-border-subtle)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[var(--color-text-main)] mb-3">Convenience Stores</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">
                        24/7 chemist and general store nearby for last-minute production supplies (batteries, tape, refreshments).
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
