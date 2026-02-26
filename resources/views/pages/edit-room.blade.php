@extends('layouts.app')

@section('title', 'Edit Room on Rent in Delhi NCR | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Rent a professional edit room in Delhi NCR with Mac mini M2 Pro, calibrated 4K display, and high-speed storage. Perfect for on-set reviews, social cuts, and podcast assembly." />
@endsection

@section('content')
    @php
        $hero = [
            'alt' => 'Professional video editing suite with Mac mini M2 Pro',
            'src' => 'storage/room/IMG_0769.jpeg',
        ];

        $galleryItems = [
             ['src' => 'storage/room/IMG_0770.jpeg', 'alt' => 'Editing Desk Setup'],
             ['src' => 'storage/room/IMG_0771.jpeg', 'alt' => 'Comfortable Seating'],
             ['src' => 'storage/room/IMG_0772.jpeg', 'alt' => 'Calibrated Display'],
             ['src' => 'storage/room/IMG_0773.jpeg', 'alt' => 'Ambient Lighting'],
             ['src' => 'storage/room/IMG_0774.jpeg', 'alt' => 'Workspace Detail'],
             ['src' => 'storage/room/IMG_0775.jpeg', 'alt' => 'Studio Environment'],
        ];
    @endphp

    {{-- Hero Section --}}
    <div class="relative bg-black h-[80vh] min-h-[600px] overflow-hidden group">
        <div class="absolute inset-0 transition-transform duration-1000 group-hover:scale-105">
             <img src="{{ asset($hero['src']) }}" alt="{{ $hero['alt'] }}" class="h-full w-full object-cover opacity-60" />
             <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
             <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-transparent"></div>
        </div>
        <div class="relative h-full mx-auto max-w-6xl px-4 flex flex-col justify-center items-center text-center">
            <div class="animate-fade-in-up">
                <span class="inline-block rounded-full bg-indigo-500/20 border border-indigo-500/30 px-6 py-2 text-sm font-medium text-indigo-200 backdrop-blur-md mb-8">
                    <span class="mr-2">●</span> Available for Immediate Booking
                </span>
                <h1 class="text-5xl font-bold tracking-tight text-white sm:text-7xl md:text-8xl drop-shadow-2xl">
                    Post.<br/>Production.
                </h1>
                <p class="mt-8 max-w-2xl text-xl text-gray-200 leading-relaxed drop-shadow-lg mx-auto font-light">
                    A dedicated, acoustically treated suite with <span class="text-white font-medium">Mac mini M2 Pro</span> power. 
                    Review, cut, and grade without leaving the studio.
                </p>
            </div>
            <div class="mt-12 flex flex-col sm:flex-row gap-5 animate-fade-in-up delay-100">
                <a href="#contact" class="rounded-full bg-white px-10 py-4 text-lg font-semibold text-black transition hover:bg-gray-100 hover:scale-105 transform duration-200 shadow-xl shadow-white/10">
                    Book Suite Now
                </a>
                <a href="#specs" class="rounded-full border border-white/20 bg-white/5 px-10 py-4 text-lg font-semibold text-white backdrop-blur-md transition hover:bg-white/10 hover:border-white/40">
                    Technical Specs
                </a>
            </div>
        </div>
    </div>

    {{-- Specs & Features --}}
    <section id="specs" class="bg-[var(--color-surface)] py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
             <div class="mb-20 md:text-center max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-5xl mb-6">Built for Speed</h2>
                <p class="text-xl text-[var(--color-text-muted)] leading-relaxed">Every component is selected to keep your creative flow uninterrupted, from ingest to final export.</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                {{-- Spec 1 --}}
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 p-8 transition-all hover:bg-white hover:shadow-xl border border-transparent hover:border-indigo-100">
                    <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-3">Mac mini M2 Pro</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">12-core CPU, 19-core GPU. Crushes 4K multicam streams and complex color grades without dropping a frame.</p>
                </div>

                {{-- Spec 2 --}}
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 p-8 transition-all hover:bg-white hover:shadow-xl border border-transparent hover:border-indigo-100">
                     <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-3">Calibrated 4K</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">100% sRGB / Rec.709 coverage. Trust what you see on screen for web, social, and broadcast delivery.</p>
                </div>

                {{-- Spec 3 --}}
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 p-8 transition-all hover:bg-white hover:shadow-xl border border-transparent hover:border-indigo-100">
                     <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-3">Reference Audio</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">Flat response studio monitors for critical listening. Clean up dialogue and balance mixes with confidence.</p>
                </div>

                {{-- Spec 4 --}}
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 p-8 transition-all hover:bg-white hover:shadow-xl border border-transparent hover:border-indigo-100">
                     <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-3">Thunderbolt 4</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">40Gb/s transfer speeds. Offload camera cards instantly and edit directly from high-speed external SSDs.</p>
                </div>

                 {{-- Spec 5 --}}
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 p-8 transition-all hover:bg-white hover:shadow-xl border border-transparent hover:border-indigo-100">
                     <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-3">Ergonomic Suite</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">Herman Miller style seating, adjustable ambient lighting, and acoustic treatment for long, fatigue-free sessions.</p>
                </div>

                 {{-- Spec 6 --}}
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 p-8 transition-all hover:bg-white hover:shadow-xl border border-transparent hover:border-indigo-100">
                     <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-3">24/7 Access</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">Deadlines don't sleep, and neither do we. Book the suite whenever you need to get the job done.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Workflows Section --}}
    <section class="bg-[var(--color-surface-muted)] py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <h2 class="text-4xl font-bold tracking-tight text-[var(--color-text-main)] mb-16 text-center">Seamless Integration</h2>
            <div class="grid gap-8 lg:grid-cols-3">
                <div class="relative overflow-hidden rounded-3xl bg-white p-10 shadow-sm transition hover:shadow-xl">
                    <div class="absolute top-0 right-0 -mt-8 -mr-8 h-32 w-32 rounded-full bg-indigo-100 opacity-50 blur-2xl"></div>
                    <h3 class="relative text-2xl font-bold text-[var(--color-text-main)] mb-4">On-Set Reviews</h3>
                    <p class="relative text-[var(--color-text-muted)] leading-relaxed">
                        Don't guess on the small screen. Check exposure, focus and continuity on a calibrated 4K display between setups, then carry those notes back to the floor for tighter, faster takes.
                    </p>
                </div>

                <div class="relative overflow-hidden rounded-3xl bg-white p-10 shadow-sm transition hover:shadow-xl">
                     <div class="absolute top-0 right-0 -mt-8 -mr-8 h-32 w-32 rounded-full bg-blue-100 opacity-50 blur-2xl"></div>
                    <h3 class="relative text-2xl font-bold text-[var(--color-text-main)] mb-4">Instant Dailies</h3>
                    <p class="relative text-[var(--color-text-muted)] leading-relaxed">
                        Offload footage securely and organize projects while the shoot is still happening. Walk away with verified backups and organized bins, ready for the edit.
                    </p>
                </div>

                <div class="relative overflow-hidden rounded-3xl bg-white p-10 shadow-sm transition hover:shadow-xl">
                     <div class="absolute top-0 right-0 -mt-8 -mr-8 h-32 w-32 rounded-full bg-purple-100 opacity-50 blur-2xl"></div>
                    <h3 class="relative text-2xl font-bold text-[var(--color-text-main)] mb-4">Podcast Finish</h3>
                    <p class="relative text-[var(--color-text-muted)] leading-relaxed">
                        Sync multicam angles and audio, trim pauses, lay simple grades, and export preview cuts before your guests even leave the building.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Preview --}}
    <section class="bg-[var(--color-surface)] py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-12 gap-6">
                <div>
                    <h2 class="text-4xl font-bold tracking-tight text-[var(--color-text-main)]">The Suite</h2>
                    <p class="mt-4 text-xl text-[var(--color-text-muted)]">A quiet, focused environment designed for creative professionals.</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($galleryItems as $item)
                    <div class="group relative overflow-hidden rounded-2xl bg-gray-100 aspect-[4/3] cursor-pointer shadow-sm hover:shadow-xl transition-all duration-300">
                        <img 
                            src="{{ asset($item['src']) }}" 
                            alt="{{ $item['alt'] }}" 
                            class="h-full w-full object-cover transition duration-700 group-hover:scale-110"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 transition duration-300 group-hover:opacity-100 flex items-end p-8">
                            <span class="text-white font-medium text-lg translate-y-4 transition duration-300 group-hover:translate-y-0">{{ $item['alt'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
