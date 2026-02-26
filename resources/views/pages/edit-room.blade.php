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
            'src' => 'storage/studio/DSC01008.JPG', // Using wide angle studio shot as placeholder/context
        ];

        $galleryItems = [
             ['src' => 'storage/studio/DSC01008.JPG', 'alt' => 'Editing Workspace Context'],
             ['src' => 'storage/studio/DSC01009.JPG', 'alt' => 'Color Grading Environment'],
             ['src' => 'storage/studio/DSC01002.JPG', 'alt' => 'Podcast Editing Setup'],
        ];
    @endphp

    {{-- Hero Section --}}
    <div class="relative bg-black h-[70vh] min-h-[500px] overflow-hidden">
        <div class="absolute inset-0">
             <img src="{{ asset($hero['src']) }}" alt="{{ $hero['alt'] }}" class="h-full w-full object-cover opacity-50" />
             <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
        </div>
        <div class="relative h-full mx-auto max-w-6xl px-4 flex flex-col justify-center items-center text-center">
            <span class="inline-block rounded-full bg-indigo-600/20 border border-indigo-500/30 px-4 py-1.5 text-sm font-medium text-indigo-200 backdrop-blur-sm mb-6">
                Post-Production Suite
            </span>
            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl md:text-7xl drop-shadow-lg">
                Cut. Color. Deliver.
            </h1>
            <p class="mt-6 max-w-2xl text-lg sm:text-xl text-gray-200 leading-relaxed drop-shadow-md">
                A calm, focused edit space equipped with a Mac mini M2 Pro and calibrated 4K display.
                Finish your project before you leave the studio.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="#contact" class="rounded-full bg-white px-8 py-3.5 text-base font-semibold text-black transition hover:bg-gray-200 hover:scale-105 transform duration-200">
                    Book Edit Room
                </a>
                <a href="#specs" class="rounded-full border border-white/30 bg-white/10 px-8 py-3.5 text-base font-semibold text-white backdrop-blur-sm transition hover:bg-white/20">
                    View Specs
                </a>
            </div>
        </div>
    </div>

    {{-- Specs & Features --}}
    <section id="specs" class="bg-[var(--color-surface)] py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
             <div class="mb-16 md:text-center max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">Power meets Precision</h2>
                <p class="mt-4 text-lg text-[var(--color-text-muted)]">Hardware selected to keep your timeline moving without stutter.</p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                {{-- Spec 1 --}}
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-white p-8 transition hover:border-indigo-200 hover:shadow-sm group">
                    <div class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[var(--color-text-main)]">Mac mini M2 Pro</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)] leading-relaxed">High-performance chip capable of handling multicam streams, complex grades, and heavy renders with ease.</p>
                </div>

                {{-- Spec 2 --}}
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-white p-8 transition hover:border-indigo-200 hover:shadow-sm group">
                     <div class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[var(--color-text-main)]">Calibrated 4K Display</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)] leading-relaxed">Color-accurate monitoring for confidence in your grades, whether for web or broadcast delivery.</p>
                </div>

                {{-- Spec 3 --}}
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-white p-8 transition hover:border-indigo-200 hover:shadow-sm group">
                     <div class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" /></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[var(--color-text-main)]">Studio Monitors</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)] leading-relaxed">Clean, flat audio response for mixing dialogue, podcasts, and sound design without coloring the sound.</p>
                </div>

                {{-- Spec 4 --}}
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-white p-8 transition hover:border-indigo-200 hover:shadow-sm group">
                     <div class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[var(--color-text-main)]">High-Speed I/O</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)] leading-relaxed">Thunderbolt 4 ports for fast ingest from camera cards and seamless editing from external SSDs.</p>
                </div>

                 {{-- Spec 5 --}}
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-white p-8 transition hover:border-indigo-200 hover:shadow-sm group">
                     <div class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[var(--color-text-main)]">Ergonomic Setup</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)] leading-relaxed">Designed for long sessions with a comfortable chair, ample desk space, and proper ambient lighting.</p>
                </div>

                 {{-- Spec 6 --}}
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-white p-8 transition hover:border-indigo-200 hover:shadow-sm group">
                     <div class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[var(--color-text-main)]">24/7 Availability</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)] leading-relaxed">Book the room whenever inspiration strikes or deadlines loom. We work on your schedule.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Workflows Section --}}
    <section class="bg-[var(--color-surface-muted)] py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold tracking-tight text-[var(--color-text-main)] mb-10">Optimized Workflows</h2>
            <div class="grid gap-6 lg:grid-cols-3">
                <div class="relative overflow-hidden rounded-2xl bg-white p-8 shadow-sm">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-indigo-50 opacity-50 blur-xl"></div>
                    <h3 class="relative text-lg font-semibold text-[var(--color-text-main)]">On-Set Reviews</h3>
                    <p class="relative mt-3 text-sm text-[var(--color-text-muted)] leading-relaxed">
                        Check exposure, focus and continuity on a calibrated screen between setups, then carry those notes back to the floor for tighter, faster takes.
                    </p>
                </div>

                <div class="relative overflow-hidden rounded-2xl bg-white p-8 shadow-sm">
                     <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-blue-50 opacity-50 blur-xl"></div>
                    <h3 class="relative text-lg font-semibold text-[var(--color-text-main)]">Social Edits</h3>
                    <p class="relative mt-3 text-sm text-[var(--color-text-muted)] leading-relaxed">
                        Cut reels and shorts while the talent remains on set. You leave with approved cuts rather than to‑do lists that slow tomorrow’s deliverables.
                    </p>
                </div>

                <div class="relative overflow-hidden rounded-2xl bg-white p-8 shadow-sm">
                     <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-purple-50 opacity-50 blur-xl"></div>
                    <h3 class="relative text-lg font-semibold text-[var(--color-text-main)]">Podcast Assembly</h3>
                    <p class="relative mt-3 text-sm text-[var(--color-text-muted)] leading-relaxed">
                        Sync cameras and audio, trim pauses, lay simple grades and export previews before your guests even leave the studio.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Preview (Optional / Contextual) --}}
    <section class="bg-[var(--color-surface)] py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold tracking-tight text-[var(--color-text-main)] mb-8">Creative Environment</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($galleryItems as $item)
                    <div class="overflow-hidden rounded-xl bg-gray-100">
                        <img src="{{ asset($item['src']) }}" alt="{{ $item['alt'] }}" class="h-64 w-full object-cover hover:scale-105 transition duration-500">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
