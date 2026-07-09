@php
    $serviceId = strtolower($page['service_id'] ?? '');
    
    // Resolve the service if null
    $serviceData = $service;
    if (empty($serviceData) && !empty($serviceId)) {
        $serviceData = app(\App\Services\SeoPageRepository::class)->getServiceById($serviceId);
    }
@endphp

<!-- Hero Section (Full Bleed) -->
<section class="relative w-full bg-cover bg-center text-white py-12 md:py-20 px-6 md:px-12 overflow-hidden" 
         style="background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.85)), url('{{ asset('storage/studio/DSC01008.JPG') }}');">
    
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        <!-- Left Column: Copy & Stats -->
        <div class="lg:col-span-8 space-y-6">
            <!-- Breadcrumbs -->
            <nav class="flex items-center text-xs md:text-sm text-gray-300/80 space-x-2" aria-label="Breadcrumb">
                <a href="/" class="hover:underline hover:text-white transition">Home</a>
                <span class="text-gray-500">&gt;</span>
                <span class="text-gray-400">Resources</span>
                <span class="text-gray-500">&gt;</span>
                <span class="text-white font-medium truncate">{{ $serviceData['name'] ?? ($page['h1'] ?? '') }}</span>
            </nav>

            <!-- Pill Badge -->
            <div>
                <span class="inline-block px-3 py-1 bg-white/10 border border-white/20 text-[10px] md:text-xs font-semibold tracking-wider text-gray-200 uppercase rounded-md">
                    {{ strtoupper($serviceData['category'] ?? 'Professional') }} STUDIO · {{ strtoupper($location['name'] ?? 'Delhi NCR') }}
                </span>
            </div>

            <!-- H1 Page Title -->
            <h1 class="text-3xl md:text-5xl font-sans font-bold leading-tight tracking-tight text-white">
                {{ $page['h1'] ?? '' }}
            </h1>

            <!-- Description -->
            <p class="text-sm md:text-base text-gray-300 leading-relaxed max-w-3xl">
                {{ $page['intro'] ?? '' }}
            </p>

            <!-- Stats grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-2xl pt-4">
                <!-- Stat 1 -->
                <div class="border border-white/10 bg-black/40 rounded-lg p-3 text-center">
                    <div class="text-xl md:text-2xl font-bold text-white font-sans">24/7</div>
                    <div class="text-[9px] tracking-widest text-gray-400 uppercase mt-1">Studio Access</div>
                </div>
                <!-- Stat 2 -->
                <div class="border border-white/10 bg-black/40 rounded-lg p-3 text-center">
                    <div class="text-xl md:text-2xl font-bold text-white font-sans">10+</div>
                    <div class="text-[9px] tracking-widest text-gray-400 uppercase mt-1">Pro Services</div>
                </div>
                <!-- Stat 3 -->
                <div class="border border-white/10 bg-black/40 rounded-lg p-3 text-center">
                    <div class="text-xl md:text-2xl font-bold text-white font-sans">500+</div>
                    <div class="text-[9px] tracking-widest text-gray-400 uppercase mt-1">Projects Done</div>
                </div>
                <!-- Stat 4 -->
                <div class="border border-white/10 bg-black/40 rounded-lg p-3 text-center">
                    <div class="text-xl md:text-2xl font-bold text-white font-sans">Dwarka</div>
                    <div class="text-[9px] tracking-widest text-gray-400 uppercase mt-1">Sector 13 Studio</div>
                </div>
            </div>
        </div>

        <!-- Right Column: Buttons -->
        <div class="lg:col-span-4 flex flex-wrap gap-3 lg:justify-end items-center">
            <a href="/contact" class="px-6 py-3 bg-white text-black font-semibold rounded-md shadow-md hover:bg-gray-100 transition duration-200 text-center font-sans">
                Book Now
            </a>
            <a href="#packages" class="px-6 py-3 border border-white/40 text-white font-semibold rounded-md hover:bg-white/10 transition duration-200 text-center font-sans">
                Pricing
            </a>
            <a href="tel:{{ config('dywix.phone') }}" class="px-6 py-3 border border-white/40 text-white font-semibold rounded-md hover:bg-white/10 transition duration-200 text-center font-sans whitespace-nowrap">
                {{ config('dywix.phone', '+91-9540467000') }}
            </a>
        </div>
    </div>
</section>
