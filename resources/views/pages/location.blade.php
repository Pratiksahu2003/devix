@extends('layouts.app')

@section('title', 'Location & Access | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Directions to {{ config('company.brand') }} in Dwarka Sector 13, New Delhi. Details on parking, metro access, and nearby amenities for your production team." />
@endsection

@section('content')
    {{-- Hero Map --}}
    <section class="relative h-[60vh] min-h-[500px] w-full bg-gray-200">
        <iframe
            src="{{ config('company.map.embed_url') }}"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            class="absolute inset-0 grayscale contrast-125 opacity-80"
        ></iframe>
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 right-0 p-8 lg:p-12 pointer-events-none">
            <div class="mx-auto max-w-6xl">
                <span class="inline-flex items-center rounded-full bg-white px-3 py-1 text-xs font-bold uppercase tracking-wider text-black mb-4">
                    New Delhi
                </span>
                <h1 class="text-4xl font-bold text-white sm:text-5xl lg:text-6xl">
                    Dwarka Sector 13
                </h1>
                <p class="mt-2 text-lg text-gray-300">
                    {{ config('company.address.landmark') }}
                </p>
            </div>
        </div>
    </section>

    {{-- Getting Here Grid --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16">
                <div>
                    <h2 class="text-3xl font-bold text-[var(--color-text-main)] mb-8">Getting Here</h2>
                    
                    <div class="space-y-8">
                        {{-- Address --}}
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 mt-1">
                                <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-[var(--color-text-main)]">Studio Address</h3>
                                <p class="text-[var(--color-text-muted)] mt-1 leading-relaxed">
                                    @foreach(config('company.address.lines') as $line)
                                        {{ $line }}<br>
                                    @endforeach
                                    <span class="text-sm text-gray-400 mt-1 block">Landmark: {{ config('company.address.landmark') }}</span>
                                </p>
                                <a href="{{ config('company.map.view_url') }}" target="_blank" class="inline-flex items-center mt-3 text-sm font-semibold text-[var(--color-brand-lens-blue)] hover:underline">
                                    Open in Google Maps &rarr;
                                </a>
                            </div>
                        </div>

                        {{-- Metro --}}
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 mt-1">
                                <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-[var(--color-text-main)]">Metro Access</h3>
                                <p class="text-[var(--color-text-muted)] mt-1 leading-relaxed">
                                    We are conveniently located near <strong>Dwarka Sector 13 Metro Station</strong> (Blue Line). It's a quick 5-minute auto-rickshaw ride or a 15-minute walk from the station.
                                </p>
                            </div>
                        </div>

                        {{-- Parking --}}
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 mt-1">
                                <div class="h-10 w-10 rounded-full bg-green-50 flex items-center justify-center text-green-600">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-[var(--color-text-main)]">Parking & Loading</h3>
                                <p class="text-[var(--color-text-muted)] mt-1 leading-relaxed">
                                    Ample street parking is available around the building. For load-in, you can pull up directly to the building entrance. Please notify us in advance for heavy equipment so we can reserve a spot.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Image Grid --}}
                <div class="grid gap-4 grid-cols-2">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=600&q=80" alt="Building Exterior" class="rounded-2xl shadow-lg w-full h-64 object-cover">
                    <img src="https://images.unsplash.com/photo-1595846519845-68e298c2edd8?auto=format&fit=crop&w=600&q=80" alt="Nearby Metro" class="rounded-2xl shadow-lg w-full h-64 object-cover mt-8">
                </div>
            </div>
        </div>
    </section>

    {{-- Neighborhood --}}
    <section class="py-16 bg-[var(--color-surface-muted)]">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-[var(--color-text-main)] mb-8">In the Neighborhood</h2>
            <div class="grid md:grid-cols-3 gap-6">
                {{-- Hotel --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-[var(--color-border-subtle)]">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="p-2 rounded-lg bg-purple-50 text-purple-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <h3 class="font-bold text-[var(--color-text-main)]">Radisson Blu Hotel</h3>
                    </div>
                    <p class="text-sm text-[var(--color-text-muted)]">
                        5-star accommodation just a stone's throw away. Ideal for out-of-town talent or clients.
                    </p>
                </div>

                {{-- Coffee --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-[var(--color-border-subtle)]">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="p-2 rounded-lg bg-orange-50 text-orange-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8h1a4 4 0 010 8h-1M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z" /></svg>
                        </div>
                        <h3 class="font-bold text-[var(--color-text-main)]">Cafes & Dining</h3>
                    </div>
                    <p class="text-sm text-[var(--color-text-muted)]">
                        Multiple cafes and restaurants within walking distance (City Centre Mall) for crew lunch breaks.
                    </p>
                </div>

                {{-- Supplies --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-[var(--color-border-subtle)]">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="p-2 rounded-lg bg-blue-50 text-blue-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                        </div>
                        <h3 class="font-bold text-[var(--color-text-main)]">Convenience Stores</h3>
                    </div>
                    <p class="text-sm text-[var(--color-text-muted)]">
                        24/7 chemist and general store nearby for last-minute production supplies (batteries, tape, etc).
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
