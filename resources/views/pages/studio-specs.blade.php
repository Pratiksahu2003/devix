@extends('layouts.app')

@section('title', 'Technical Specifications | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Detailed technical specifications for {{ config('company.brand') }}: floor plan, lighting inventory, audio gear, power rating, and amenities for professional productions." />
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-black text-white" x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 100)">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/50 to-black z-10"></div>
            <img 
                src="https://images.unsplash.com/photo-1598550476439-6847785fcea6?auto=format&fit=crop&w=1920&q=80" 
                alt="Studio Lighting Grid" 
                class="h-full w-full object-cover opacity-50 transition-transform duration-[3s] ease-out scale-105"
                :class="{ 'scale-100': shown }"
            >
        </div>
        
        <div class="relative z-20 mx-auto max-w-7xl px-4 py-32 sm:px-6 lg:py-48 text-center">
            <p 
                class="mb-6 text-sm font-bold uppercase tracking-[0.2em] text-[var(--color-brand-lens-blue)] transition-all duration-1000 delay-300 transform translate-y-4 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                Technical Rider 2024
            </p>
            <h1 
                class="text-5xl font-bold tracking-tight sm:text-7xl lg:text-8xl transition-all duration-1000 delay-500 transform translate-y-8 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                Precision.<br />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-100 to-gray-500">Performance.</span>
            </h1>
            <p 
                class="mx-auto mt-8 max-w-2xl text-xl text-gray-400 leading-relaxed transition-all duration-1000 delay-700 transform translate-y-8 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                Engineered for professional workflows. Every joule of light, every inch of space, optimized for your vision.
            </p>
        </div>
    </section>

    {{-- Bento Grid Stats --}}
    <section class="py-24 bg-black text-white" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Stat 1 --}}
                <div 
                    class="group relative overflow-hidden rounded-3xl bg-gray-900 p-8 transition-all duration-700 transform translate-y-12 opacity-0"
                    :class="{ 'translate-y-0 opacity-100': shown }"
                    style="transition-delay: 0ms;"
                >
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-800/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                    <p class="relative text-sm font-medium text-gray-400">Total Floor Area</p>
                    <p class="relative mt-2 text-5xl font-bold tracking-tight">1,200<span class="text-2xl text-gray-500 ml-1">sqft</span></p>
                    <div class="relative mt-4 h-1 w-12 bg-[var(--color-brand-lens-blue)] rounded-full"></div>
                </div>

                {{-- Stat 2 --}}
                <div 
                    class="group relative overflow-hidden rounded-3xl bg-gray-900 p-8 transition-all duration-700 transform translate-y-12 opacity-0"
                    :class="{ 'translate-y-0 opacity-100': shown }"
                    style="transition-delay: 150ms;"
                >
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-800/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                    <p class="relative text-sm font-medium text-gray-400">Ceiling Clearance</p>
                    <p class="relative mt-2 text-5xl font-bold tracking-tight">12<span class="text-2xl text-gray-500 ml-1">ft</span></p>
                    <div class="relative mt-4 h-1 w-12 bg-purple-500 rounded-full"></div>
                </div>

                {{-- Stat 3 --}}
                <div 
                    class="group relative overflow-hidden rounded-3xl bg-gray-900 p-8 transition-all duration-700 transform translate-y-12 opacity-0"
                    :class="{ 'translate-y-0 opacity-100': shown }"
                    style="transition-delay: 300ms;"
                >
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-800/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                    <p class="relative text-sm font-medium text-gray-400">Power Rating</p>
                    <p class="relative mt-2 text-5xl font-bold tracking-tight">63<span class="text-2xl text-gray-500 ml-1">Amp</span></p>
                    <div class="relative mt-4 h-1 w-12 bg-green-500 rounded-full"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Lighting Ecosystem --}}
    <section class="py-32 bg-white overflow-hidden">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true">
                    <h2 
                        class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl transition-all duration-1000 transform -translate-x-12 opacity-0"
                        :class="{ 'translate-x-0 opacity-100': shown }"
                    >
                        Lighting.<br />
                        <span class="text-gray-400">Mastered.</span>
                    </h2>
                    <p 
                        class="mt-6 text-xl text-gray-500 leading-relaxed transition-all duration-1000 delay-200 transform translate-y-4 opacity-0"
                        :class="{ 'translate-y-0 opacity-100': shown }"
                    >
                        We’ve standardized on the Godox ecosystem for seamless integration. High-speed sync for freezing motion, or high-CRI continuous light for cinematic video. It’s all here.
                    </p>

                    <div class="mt-12 space-y-8">
                        {{-- Item 1 --}}
                        <div 
                            class="flex gap-6 transition-all duration-700 delay-300 transform translate-y-8 opacity-0"
                            :class="{ 'translate-y-0 opacity-100': shown }"
                        >
                            <div class="flex-shrink-0">
                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-black text-white">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">High-Speed Sync</h3>
                                <p class="mt-2 text-gray-500">
                                    3x Godox QT1200IIIm strobes capable of 1/8000s sync speeds. Freeze water droplets, dance movement, or hair flips with absolute sharpness.
                                </p>
                            </div>
                        </div>

                        {{-- Item 2 --}}
                        <div 
                            class="flex gap-6 transition-all duration-700 delay-500 transform translate-y-8 opacity-0"
                            :class="{ 'translate-y-0 opacity-100': shown }"
                        >
                            <div class="flex-shrink-0">
                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-black text-white">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Color Accuracy</h3>
                                <p class="mt-2 text-gray-500">
                                    Godox SL200W II and Amaran 200x continuous lights with TLCI 96+. Skin tones look natural, and product colors render true to life.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div 
                    class="relative" 
                    x-data="{ shown: false }" 
                    x-intersect.threshold.0.2="shown = true"
                >
                    <div 
                        class="aspect-square rounded-3xl overflow-hidden bg-gray-100 shadow-2xl transition-all duration-1000 transform translate-x-12 opacity-0"
                        :class="{ 'translate-x-0 opacity-100': shown }"
                    >
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80" alt="Lighting Gear" class="h-full w-full object-cover">
                    </div>
                    {{-- Floating Card --}}
                    <div 
                        class="absolute -bottom-8 -left-8 bg-white p-6 rounded-2xl shadow-xl border border-gray-100 max-w-xs transition-all duration-1000 delay-300 transform translate-y-12 opacity-0"
                        :class="{ 'translate-y-0 opacity-100': shown }"
                    >
                        <p class="text-sm font-bold text-gray-900">Included Modifiers</p>
                        <ul class="mt-3 space-y-2 text-xs text-gray-500">
                            <li class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                120cm Parabolic Softbox
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                2x 35x160cm Stripboxes + Grids
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                Snoot, Barn Doors, Gels
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Audio & Grip Parallax --}}
    <section class="py-32 bg-gray-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12">
                {{-- Card 1 --}}
                <div 
                    class="group relative overflow-hidden rounded-[2rem] bg-white shadow-lg transition-all duration-500 hover:shadow-2xl"
                    x-data="{ shown: false }" 
                    x-intersect.threshold.0.1="shown = true"
                    :class="{ 'opacity-0 translate-y-12': !shown, 'opacity-100 translate-y-0': shown }"
                    style="transition-duration: 800ms;"
                >
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1590602847861-f357a9332bbc?auto=format&fit=crop&w=800&q=80" alt="Audio Gear" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                    </div>
                    <div class="p-8">
                        <p class="text-xs font-bold uppercase tracking-wider text-purple-600">Audio</p>
                        <h3 class="mt-2 text-2xl font-bold text-gray-900">Broadcast-Grade Sound</h3>
                        <p class="mt-4 text-gray-500 leading-relaxed">
                            The podcast corner features 4x Shure SM7B dynamic microphones paired with the RodeCaster Pro II. Acoustically treated walls ensure dry, crisp vocals ready for minimal post-processing.
                        </p>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div 
                    class="group relative overflow-hidden rounded-[2rem] bg-white shadow-lg transition-all duration-500 hover:shadow-2xl"
                    x-data="{ shown: false }" 
                    x-intersect.threshold.0.1="shown = true"
                    :class="{ 'opacity-0 translate-y-12': !shown, 'opacity-100 translate-y-0': shown }"
                    style="transition-duration: 800ms; transition-delay: 200ms;"
                >
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=800&q=80" alt="Grip Gear" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                    </div>
                    <div class="p-8">
                        <p class="text-xs font-bold uppercase tracking-wider text-[var(--color-brand-lens-blue)]">Grip</p>
                        <h3 class="mt-2 text-2xl font-bold text-gray-900">Solid Support</h3>
                        <p class="mt-4 text-gray-500 leading-relaxed">
                            Heavy-duty C-stands, boom arms, and sandbags keep your rig safe. We stock Apple boxes (full set), A-clamps, and super clamps for versatile mounting options anywhere on the grid.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Detailed Inventory List --}}
    <section class="py-24 bg-white" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-12">Full Inventory List</h2>
            
            <div class="grid md:grid-cols-2 gap-8 text-left">
                <div 
                    class="space-y-8 transition-all duration-700 opacity-0 transform -translate-x-8"
                    :class="{ 'translate-x-0 opacity-100': shown }"
                >
                    <div>
                        <h4 class="font-bold text-lg border-b border-gray-200 pb-2 mb-4">Lighting</h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex justify-between"><span>Godox QT1200IIIm</span> <span class="text-gray-400">3x</span></li>
                            <li class="flex justify-between"><span>Godox AD600 Pro</span> <span class="text-gray-400">2x</span></li>
                            <li class="flex justify-between"><span>Godox SL200W II</span> <span class="text-gray-400">2x</span></li>
                            <li class="flex justify-between"><span>Amaran 200x Bi-Color</span> <span class="text-gray-400">2x</span></li>
                            <li class="flex justify-between"><span>Godox Optical Snoot</span> <span class="text-gray-400">1x</span></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg border-b border-gray-200 pb-2 mb-4">Modifiers</h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex justify-between"><span>120cm Octabox</span> <span class="text-gray-400">1x</span></li>
                            <li class="flex justify-between"><span>35x160cm Stripbox</span> <span class="text-gray-400">2x</span></li>
                            <li class="flex justify-between"><span>Beauty Dish (White)</span> <span class="text-gray-400">1x</span></li>
                            <li class="flex justify-between"><span>5-in-1 Reflectors</span> <span class="text-gray-400">2x</span></li>
                        </ul>
                    </div>
                </div>

                <div 
                    class="space-y-8 transition-all duration-700 opacity-0 transform translate-x-8"
                    :class="{ 'translate-x-0 opacity-100': shown }"
                >
                    <div>
                        <h4 class="font-bold text-lg border-b border-gray-200 pb-2 mb-4">Grip & Support</h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex justify-between"><span>C-Stands w/ Arms</span> <span class="text-gray-400">6x</span></li>
                            <li class="flex justify-between"><span>Heavy Duty Boom</span> <span class="text-gray-400">2x</span></li>
                            <li class="flex justify-between"><span>Apple Box Set</span> <span class="text-gray-400">4x</span></li>
                            <li class="flex justify-between"><span>Sandbags (10kg)</span> <span class="text-gray-400">10x</span></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg border-b border-gray-200 pb-2 mb-4">Amenities</h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex justify-between"><span>Garment Steamer</span> <span class="text-gray-400">1x</span></li>
                            <li class="flex justify-between"><span>Clothing Rack</span> <span class="text-gray-400">2x</span></li>
                            <li class="flex justify-between"><span>Makeup Mirror</span> <span class="text-gray-400">2x</span></li>
                            <li class="flex justify-between"><span>Bluetooth Speaker</span> <span class="text-gray-400">1x</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="mt-16">
                <button class="inline-flex items-center rounded-full bg-black px-8 py-4 text-sm font-bold text-white shadow-xl hover:bg-gray-800 transition transform hover:-translate-y-1">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                    Download PDF Technical Rider
                </button>
            </div>
        </div>
    </section>
@endsection
