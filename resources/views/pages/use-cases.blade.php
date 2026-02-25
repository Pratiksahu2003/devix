@extends('layouts.app')

@section('title', 'Use Cases | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Discover how brands, creators, and agencies use {{ config('company.brand') }} for fashion shoots, product photography, podcasts, and corporate video production." />
@endsection

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-black text-white pt-20 pb-24 lg:pt-32 lg:pb-40">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('studio/DSC01009.JPG') }}" alt="Studio Background" class="h-full w-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
        </div>
        <div class="relative z-10 mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold tracking-tight sm:text-5xl lg:text-7xl">
                One Space. <br class="hidden sm:block" />
                <span class="text-[var(--color-brand-lens-blue)]">Infinite Possibilities.</span>
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-300 leading-relaxed">
                From high-end fashion editorials to efficient e-commerce workflows, see how {{ config('company.brand') }} adapts to your creative vision.
            </p>
        </div>
    </section>

    {{-- Use Case 1: Fashion --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-2 lg:gap-20 items-center">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-[4/5] lg:aspect-square group">
                    <img src="{{ asset('studio/DSC01002.JPG') }}" alt="Fashion Editorial" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                </div>
                <div>
                    <div class="inline-flex items-center rounded-full bg-pink-50 px-3 py-1 text-xs font-medium text-pink-700 mb-6">
                        Editorial & Commercial
                    </div>
                    <h2 class="text-3xl font-bold text-[var(--color-text-main)] sm:text-4xl mb-6">Fashion & Lookbooks</h2>
                    <p class="text-lg text-[var(--color-text-muted)] mb-8 leading-relaxed">
                        With a dedicated makeup room, garment steamers, and ample floor space for racks, our studio handles multi-look fashion days with ease. The high ceilings allow for complex lighting setups to create dramatic, magazine-quality editorials.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <div class="mt-1 h-5 w-5 rounded-full bg-[var(--color-brand-lens-blue)]/10 text-[var(--color-brand-lens-blue)] flex items-center justify-center">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span class="text-[var(--color-text-main)]">Private changing & makeup area for talent privacy.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1 h-5 w-5 rounded-full bg-[var(--color-brand-lens-blue)]/10 text-[var(--color-brand-lens-blue)] flex items-center justify-center">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span class="text-[var(--color-text-main)]">Textured walls and colored paper backdrops available.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1 h-5 w-5 rounded-full bg-[var(--color-brand-lens-blue)]/10 text-[var(--color-brand-lens-blue)] flex items-center justify-center">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span class="text-[var(--color-text-main)]">Tethering station support for instant client review.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Case 2: E-commerce (Reversed) --}}
    <section class="py-16 lg:py-24 bg-[var(--color-surface-muted)]">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-2 lg:gap-20 items-center">
                <div class="order-2 lg:order-1">
                    <div class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700 mb-6">
                        Catalog & Product
                    </div>
                    <h2 class="text-3xl font-bold text-[var(--color-text-main)] sm:text-4xl mb-6">E-commerce & Product</h2>
                    <p class="text-lg text-[var(--color-text-muted)] mb-8 leading-relaxed">
                        Consistency is key for catalogs. Our controlled lighting environment allows you to shoot hundreds of SKUs with identical exposure and color rendering. Perfect for flat lays, mannequins, or model-led product demos.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <div class="mt-1 h-5 w-5 rounded-full bg-[var(--color-brand-lens-blue)]/10 text-[var(--color-brand-lens-blue)] flex items-center justify-center">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span class="text-[var(--color-text-main)]">High-CRI lighting for accurate product color.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1 h-5 w-5 rounded-full bg-[var(--color-brand-lens-blue)]/10 text-[var(--color-brand-lens-blue)] flex items-center justify-center">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span class="text-[var(--color-text-main)]">Shooting tables and product risers available.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1 h-5 w-5 rounded-full bg-[var(--color-brand-lens-blue)]/10 text-[var(--color-brand-lens-blue)] flex items-center justify-center">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span class="text-[var(--color-text-main)]">Fast load-in for large volumes of inventory.</span>
                        </li>
                    </ul>
                </div>
                <div class="order-1 lg:order-2 relative rounded-3xl overflow-hidden shadow-2xl aspect-[4/5] lg:aspect-square group">
                    <img src="{{ asset('studio/DSC01007.JPG') }}" alt="Product Photography" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                </div>
            </div>
        </div>
    </section>

    {{-- Use Case 3: Podcast --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-2 lg:gap-20 items-center">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-[4/5] lg:aspect-square group">
                    <img src="{{ asset('studio/DSC01008.JPG') }}" alt="Podcast Studio" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                </div>
                <div>
                    <div class="inline-flex items-center rounded-full bg-purple-50 px-3 py-1 text-xs font-medium text-purple-700 mb-6">
                        Audio & Video
                    </div>
                    <h2 class="text-3xl font-bold text-[var(--color-text-main)] sm:text-4xl mb-6">Podcasts & Interviews</h2>
                    <p class="text-lg text-[var(--color-text-muted)] mb-8 leading-relaxed">
                        Plug and play recording for audio-first or video podcasts. Our treated acoustic corner kills reverb, while our RGB lighting allows you to brand the set instantly. Ideal for interview series, course creation, and YouTube talk shows.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <div class="mt-1 h-5 w-5 rounded-full bg-[var(--color-brand-lens-blue)]/10 text-[var(--color-brand-lens-blue)] flex items-center justify-center">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span class="text-[var(--color-text-main)]">4-person seating arrangement ready to go.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1 h-5 w-5 rounded-full bg-[var(--color-brand-lens-blue)]/10 text-[var(--color-brand-lens-blue)] flex items-center justify-center">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span class="text-[var(--color-text-main)]">Silent air conditioning for clean audio.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1 h-5 w-5 rounded-full bg-[var(--color-brand-lens-blue)]/10 text-[var(--color-brand-lens-blue)] flex items-center justify-center">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span class="text-[var(--color-text-main)]">Multi-camera angle setup space.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Grid for Others --}}
    <section class="py-16 lg:py-24 bg-[var(--color-surface)]">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">
                    More ways to create
                </h2>
                <p class="mt-4 text-lg text-[var(--color-text-muted)]">
                    Versatility is our middle name.
                </p>
            </div>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                {{-- Card 1 --}}
                <div class="group relative overflow-hidden rounded-2xl bg-white shadow-sm transition hover:shadow-md">
                    <div class="aspect-video bg-gray-200 overflow-hidden">
                        <img src="{{ asset('studio/DSC01003.JPG') }}" alt="Corporate" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-[var(--color-text-main)]">Corporate Headshots</h3>
                        <p class="mt-2 text-sm text-[var(--color-text-muted)]">Efficient flow for photographing entire teams. Grey/White/Black backgrounds available.</p>
                    </div>
                </div>
                {{-- Card 2 --}}
                <div class="group relative overflow-hidden rounded-2xl bg-white shadow-sm transition hover:shadow-md">
                    <div class="aspect-video bg-gray-200 overflow-hidden">
                        <img src="{{ asset('studio/DSC01010.JPG') }}" alt="Social Media" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-[var(--color-text-main)]">Content Sprints</h3>
                        <p class="mt-2 text-sm text-[var(--color-text-muted)]">Batch create a month’s worth of Reels and TikToks in a single session.</p>
                    </div>
                </div>
                {{-- Card 3 --}}
                <div class="group relative overflow-hidden rounded-2xl bg-white shadow-sm transition hover:shadow-md">
                    <div class="aspect-video bg-gray-200 overflow-hidden">
                        <img src="{{ asset('studio/DSC01012.JPG') }}" alt="Workshops" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-[var(--color-text-main)]">Workshops</h3>
                        <p class="mt-2 text-sm text-[var(--color-text-muted)]">Host photography classes or makeup masterclasses for small groups.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-[var(--color-brand-lens-blue)] py-16 text-center text-white">
        <div class="mx-auto max-w-4xl px-4">
            <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">
                Have a unique project in mind?
            </h2>
            <p class="mt-4 text-lg text-blue-100">
                We love a challenge. Reach out to discuss your specific requirements.
            </p>
            <div class="mt-8">
                <a href="{{ route('pages.contact') }}" class="inline-block rounded-full bg-white px-8 py-3 text-sm font-bold text-[var(--color-brand-lens-blue)] shadow-lg hover:bg-gray-50 transition">
                    Contact Us
                </a>
            </div>
        </div>
    </section>
@endsection
