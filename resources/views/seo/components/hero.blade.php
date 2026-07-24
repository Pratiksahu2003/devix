@php
    $serviceId = strtolower($page['service_id'] ?? '');
    
    // Categorize
    $category = 'default';
    if (str_contains($serviceId, 'podcast')) {
        $category = 'podcast';
    } elseif (str_contains($serviceId, 'video') || str_contains($serviceId, 'commercial') || str_contains($serviceId, 'green-screen')) {
        $category = 'video';
    } elseif (str_contains($serviceId, 'photography') || str_contains($serviceId, 'photo')) {
        $category = 'photography';
    } elseif (str_contains($serviceId, 'youtube') || str_contains($serviceId, 'influencer') || str_contains($serviceId, 'reel') || str_contains($serviceId, 'creator')) {
        $category = 'creator';
    }
    
    // Resolve the service if null
    $serviceData = $service;
    if (empty($serviceData) && !empty($serviceId)) {
        $serviceData = app(\App\Services\SeoPageRepository::class)->getServiceById($serviceId);
    }
@endphp

<style>
    @keyframes float-slow {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-8px) rotate(1deg); }
    }
    @keyframes pulse-soft {
        0%, 100% { opacity: 0.2; transform: scale(1); }
        50% { opacity: 0.35; transform: scale(1.03); }
    }
    @keyframes soundwave-1 {
        0%, 100% { height: 16px; }
        50% { height: 36px; }
    }
    @keyframes soundwave-2 {
        0%, 100% { height: 28px; }
        50% { height: 12px; }
    }
    @keyframes soundwave-3 {
        0%, 100% { height: 42px; }
        50% { height: 20px; }
    }
    @keyframes rotate-lens {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .animate-float-slow {
        animation: float-slow 6s ease-in-out infinite;
    }
    .animate-pulse-soft {
        animation: pulse-soft 4s ease-in-out infinite;
    }
    .wave-bar-1 { animation: soundwave-1 1.2s ease-in-out infinite; }
    .wave-bar-2 { animation: soundwave-2 0.8s ease-in-out infinite; }
    .wave-bar-3 { animation: soundwave-3 1.5s ease-in-out infinite; }
    .animate-lens-spin {
        animation: rotate-lens 40s linear infinite;
        transform-origin: center;
    }
</style>

<!-- Hero Section (Full Bleed) -->
<section class="relative w-full bg-cover bg-center text-white py-6 md:py-10 px-6 md:px-12 overflow-hidden border-b border-white/5" 
         style="background-image: linear-gradient(rgba(10, 30, 63, 0.88), rgba(5, 17, 38, 0.94)), url('{{ asset('storage/dywix/IMG_4029.jpg') }}');">
    
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-center">
        <!-- Left Column: Copy & Stats -->
        <div class="lg:col-span-8 space-y-3.5">
            <!-- Breadcrumbs -->
            <nav class="flex items-center text-xs text-gray-300/80 space-x-1.5" aria-label="Breadcrumb">
                <a href="/" class="hover:underline hover:text-white transition">Home</a>
                <span class="text-gray-500 text-[10px]">&gt;</span>
                <span class="text-gray-400">Resources</span>
                <span class="text-gray-500 text-[10px]">&gt;</span>
                <span class="text-white font-medium truncate">{{ $serviceData['name'] ?? ($page['h1'] ?? '') }}</span>
            </nav>

            <!-- Pill Badge -->
            <div>
                <span class="inline-block px-2.5 py-0.5 bg-white/10 border border-white/20 text-[9px] font-semibold tracking-wider text-gray-200 uppercase rounded">
                    {{ strtoupper($serviceData['category'] ?? 'Professional') }} STUDIO · {{ strtoupper($location['name'] ?? 'Delhi NCR') }}
                </span>
            </div>

            <!-- H1 Page Title -->
            <h1 class="text-2xl md:text-4xl font-sans font-bold leading-tight tracking-tight text-white">
                {{ $page['h1'] ?? '' }}
            </h1>

            <!-- Description -->
            <p class="text-xs md:text-sm text-gray-300 leading-relaxed max-w-2xl">
                {{ $page['intro'] ?? '' }}
            </p>

            <!-- Action Buttons Stacked/Inline -->
            <div class="flex flex-wrap gap-2.5 pt-1">
                <a href="/contact" class="px-5 py-2 bg-white text-black font-semibold rounded shadow hover:bg-gray-150 transition duration-200 text-center font-sans text-xs md:text-sm">
                    Book Now
                </a>
                <a href="#packages" class="px-5 py-2 border border-white/40 text-white font-semibold rounded hover:bg-white/10 transition duration-200 text-center font-sans text-xs md:text-sm">
                    Pricing
                </a>
                <a href="tel:{{ config('dywix.phone') }}" class="px-5 py-2 border border-white/40 text-white font-semibold rounded hover:bg-white/10 transition duration-200 text-center font-sans text-xs md:text-sm whitespace-nowrap">
                    {{ config('dywix.phone', '+91-9540467000') }}
                </a>
            </div>

            <!-- Stats grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 max-w-2xl pt-2">
                <!-- Stat 1 -->
                <div class="border border-white/10 bg-black/40 rounded py-1.5 px-2 text-center">
                    <div class="text-base md:text-lg font-bold text-white font-sans">24/7</div>
                    <div class="text-[8px] tracking-widest text-gray-400 uppercase mt-0.5">Studio Access</div>
                </div>
                <!-- Stat 2 -->
                <div class="border border-white/10 bg-black/40 rounded py-1.5 px-2 text-center">
                    <div class="text-base md:text-lg font-bold text-white font-sans">10+</div>
                    <div class="text-[8px] tracking-widest text-gray-400 uppercase mt-0.5">Pro Services</div>
                </div>
                <!-- Stat 3 -->
                <div class="border border-white/10 bg-black/40 rounded py-1.5 px-2 text-center">
                    <div class="text-base md:text-lg font-bold text-white font-sans">500+</div>
                    <div class="text-[8px] tracking-widest text-gray-400 uppercase mt-0.5">Projects Done</div>
                </div>
                <!-- Stat 4 -->
                <div class="border border-white/10 bg-black/40 rounded py-1.5 px-2 text-center">
                    <div class="text-base md:text-lg font-bold text-white font-sans">Dwarka</div>
                    <div class="text-[8px] tracking-widest text-gray-400 uppercase mt-0.5">Sector 13 Studio</div>
                </div>
            </div>
        </div>

        <!-- Right Column: Animated dynamic SVGs -->
        <div class="lg:col-span-4 flex justify-center items-center w-full min-h-[180px]">
            <!-- Glassmorphic graphic container -->
            <div class="relative w-full max-w-[200px] aspect-square rounded-2xl bg-white/[0.03] border border-white/10 shadow-inner flex items-center justify-center p-4 overflow-hidden animate-float-slow group">
                <div class="absolute inset-0 bg-gradient-to-tr from-[#0c234b]/30 to-white/[0.02] pointer-events-none"></div>

                @if($category === 'podcast')
                    <!-- PODCAST SVG ILLUSTRATION -->
                    <svg class="w-full h-full text-white drop-shadow-xl" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Soundwaves pulsing in background -->
                        <g opacity="0.3" class="stroke-red-500" stroke-width="2" stroke-linecap="round">
                            <line x1="45" y1="100" x2="45" y2="100" class="wave-bar-1" />
                            <line x1="60" y1="100" x2="60" y2="100" class="wave-bar-2" />
                            <line x1="75" y1="100" x2="75" y2="100" class="wave-bar-3" />
                            <!-- Right side waves -->
                            <line x1="125" y1="100" x2="125" y2="100" class="wave-bar-3" />
                            <line x1="140" y1="100" x2="140" y2="100" class="wave-bar-2" />
                            <line x1="155" y1="100" x2="155" y2="100" class="wave-bar-1" />
                        </g>

                        <!-- Mic glow gradient -->
                        <defs>
                            <radialGradient id="mic-glow" cx="50%" cy="50%" r="50%">
                                <stop offset="0%" stop-color="#ef4444" stop-opacity="0.3"/>
                                <stop offset="100%" stop-color="#ef4444" stop-opacity="0"/>
                            </radialGradient>
                            <linearGradient id="gold-metal" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#ffe6a3"/>
                                <stop offset="50%" stop-color="#c89b3c"/>
                                <stop offset="100%" stop-color="#8c651b"/>
                            </linearGradient>
                        </defs>
                        <circle cx="100" cy="90" r="45" fill="url(#mic-glow)" />

                        <!-- Mic stand -->
                        <path d="M100 130V170" stroke="url(#gold-metal)" stroke-width="6" stroke-linecap="round"/>
                        <path d="M80 170H120" stroke="url(#gold-metal)" stroke-width="8" stroke-linecap="round"/>
                        <path d="M75 95C75 118.5 83.5 130 100 130C116.5 130 125 118.5 125 95" stroke="url(#gold-metal)" stroke-width="6" stroke-linecap="round"/>

                        <!-- Mic Capsule -->
                        <rect x="86" y="55" width="28" height="50" rx="14" fill="#1e293b" stroke="url(#gold-metal)" stroke-width="4"/>
                        <!-- Mesh pattern -->
                        <line x1="90" y1="65" x2="110" y2="65" stroke="url(#gold-metal)" stroke-width="2"/>
                        <line x1="90" y1="73" x2="110" y2="73" stroke="url(#gold-metal)" stroke-width="2"/>
                        <line x1="90" y1="81" x2="110" y2="81" stroke="url(#gold-metal)" stroke-width="2"/>
                        <line x1="100" y1="55" x2="100" y2="85" stroke="url(#gold-metal)" stroke-width="2" opacity="0.5"/>

                        <!-- Headphones overlaying the mic -->
                        <path d="M55 95C55 55 70 45 100 45C130 45 145 55 145 95" stroke="#ffffff" stroke-width="5" stroke-linecap="round" opacity="0.9"/>
                        <!-- Left Ear Cup -->
                        <rect x="48" y="85" width="14" height="24" rx="5" fill="url(#gold-metal)" />
                        <!-- Right Ear Cup -->
                        <rect x="138" y="85" width="14" height="24" rx="5" fill="url(#gold-metal)" />
                    </svg>

                @elseif($category === 'video')
                    <!-- VIDEO PRODUCTION SVG ILLUSTRATION -->
                    <svg class="w-full h-full text-white drop-shadow-xl" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Spotlight beams -->
                        <defs>
                            <linearGradient id="spotlight-left" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#3b82f6" stop-opacity="0.4" />
                                <stop offset="100%" stop-color="#3b82f6" stop-opacity="0" />
                            </linearGradient>
                            <linearGradient id="spotlight-right" x1="100%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#c89b3c" stop-opacity="0.3" />
                                <stop offset="100%" stop-color="#c89b3c" stop-opacity="0" />
                            </linearGradient>
                            <linearGradient id="lens-shimmer" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#3b82f6"/>
                                <stop offset="100%" stop-color="#1d4ed8"/>
                            </linearGradient>
                        </defs>
                        
                        <path d="M30 40 L80 100 L20 100 Z" fill="url(#spotlight-left)" opacity="0.7"/>
                        <path d="M170 40 L120 100 L180 100 Z" fill="url(#spotlight-right)" opacity="0.5"/>

                        <!-- Camera Body -->
                        <rect x="65" y="75" width="60" height="42" rx="6" fill="#1e293b" stroke="#ffffff" stroke-width="4" />
                        <rect x="73" y="83" width="16" height="12" rx="2" fill="#3b82f6" opacity="0.8" />
                        
                        <!-- Top handle -->
                        <path d="M75 75V67H105V75" stroke="#ffffff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        
                        <!-- Camera Lens -->
                        <path d="M125 82 L145 72 V110 L125 100 Z" fill="#121824" stroke="#ffffff" stroke-width="4" stroke-linejoin="round"/>
                        <circle cx="145" cy="91" r="8" fill="url(#lens-shimmer)" stroke="#ffffff" stroke-width="2" />

                        <!-- Large Matte Box/Lens Details -->
                        <rect x="117" y="80" width="8" height="22" fill="#c89b3c" rx="1"/>

                        <!-- Dual Reels/Tapes on top (Classic cinema look) -->
                        <circle cx="75" cy="55" r="16" fill="#121824" stroke="#ffffff" stroke-width="3" />
                        <circle cx="105" cy="55" r="16" fill="#121824" stroke="#ffffff" stroke-width="3" />
                        <circle cx="75" cy="55" r="5" fill="#c89b3c" />
                        <circle cx="105" cy="55" r="5" fill="#c89b3c" />

                        <!-- Heavy Duty Tripod -->
                        <path d="M95 117 L75 165" stroke="#ffffff" stroke-width="4" stroke-linecap="round"/>
                        <path d="M95 117 L95 170" stroke="#ffffff" stroke-width="4" stroke-linecap="round"/>
                        <path d="M95 117 L115 165" stroke="#ffffff" stroke-width="4" stroke-linecap="round"/>
                        <path d="M85 130 H105" stroke="#c89b3c" stroke-width="3"/>
                    </svg>

                @elseif($category === 'photography')
                    <!-- PHOTOGRAPHY SVG ILLUSTRATION -->
                    <svg class="w-full h-full text-white drop-shadow-xl" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="lens-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#1e293b"/>
                                <stop offset="100%" stop-color="#0f172a"/>
                            </linearGradient>
                            <radialGradient id="aperture-glow" cx="50%" cy="50%" r="40%">
                                <stop offset="0%" stop-color="#c89b3c" stop-opacity="0.8"/>
                                <stop offset="60%" stop-color="#3b82f6" stop-opacity="0.3"/>
                                <stop offset="100%" stop-color="#000000" stop-opacity="0"/>
                            </radialGradient>
                            <linearGradient id="gold-metallic" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#ffe6a3"/>
                                <stop offset="100%" stop-color="#c89b3c"/>
                            </linearGradient>
                        </defs>

                        <!-- Softbox flash reflection background -->
                        <path d="M25 45 L75 35 L60 80 Z" fill="#ffffff" opacity="0.1" />
                        <circle cx="150" cy="50" r="30" fill="#ffe6a3" opacity="0.1" filter="blur(10px)"/>

                        <!-- DSLR Camera Body -->
                        <rect x="40" y="65" width="120" height="78" rx="10" fill="url(#lens-grad)" stroke="#ffffff" stroke-width="4" />
                        <!-- Pentaprism top housing -->
                        <path d="M75 65 L88 47 H112 L125 65 Z" fill="url(#lens-grad)" stroke="#ffffff" stroke-width="4" stroke-linejoin="round" />
                        
                        <!-- Red brand ring / Mode dial details -->
                        <rect x="52" y="57" width="14" height="8" rx="1" fill="#ef4444" />
                        <circle cx="140" cy="55" r="7" fill="#334155" stroke="#ffffff" stroke-width="2" />

                        <!-- Big Lens Barrel -->
                        <circle cx="100" cy="104" r="38" fill="#1e293b" stroke="#ffffff" stroke-width="4" />
                        <circle cx="100" cy="104" r="30" fill="url(#aperture-glow)" />

                        <!-- Aperture Blades -->
                        <g stroke="url(#gold-metallic)" stroke-width="2.5" class="animate-lens-spin">
                            <line x1="100" y1="74" x2="118" y2="88" />
                            <line x1="118" y1="88" x2="124" y2="112" />
                            <line x1="124" y1="112" x2="110" y2="130" />
                            <line x1="110" y1="130" x2="86" y2="124" />
                            <line x1="86" y1="124" x2="76" y2="100" />
                            <line x1="76" y1="100" x2="88" y2="78" />
                            <line x1="88" y1="78" x2="100" y2="74" />
                        </g>

                        <!-- Lens Shimmer/Reflection -->
                        <path d="M82 92 C88 80, 112 80, 118 92" stroke="#ffffff" stroke-width="3" stroke-linecap="round" opacity="0.6"/>
                    </svg>

                @elseif($category === 'creator')
                    <!-- CREATOR/REELS/SHORTS SVG ILLUSTRATION -->
                    <svg class="w-full h-full text-white drop-shadow-xl" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <radialGradient id="ring-glow" cx="50%" cy="50%" r="50%">
                                <stop offset="70%" stop-color="#ec4899" stop-opacity="0.15" />
                                <stop offset="85%" stop-color="#a855f7" stop-opacity="0.25" />
                                <stop offset="100%" stop-color="#3b82f6" stop-opacity="0" />
                            </radialGradient>
                            <linearGradient id="ring-neon" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#ec4899" />
                                <stop offset="50%" stop-color="#a855f7" />
                                <stop offset="100%" stop-color="#3b82f6" />
                            </linearGradient>
                        </defs>

                        <!-- Radial Ring Light Glow background -->
                        <circle cx="100" cy="85" r="70" fill="url(#ring-glow)" />

                        <!-- Ring Light Neon Loop -->
                        <circle cx="100" cy="85" r="54" stroke="url(#ring-neon)" stroke-width="12" stroke-linecap="round" />
                        <circle cx="100" cy="85" r="54" stroke="#ffffff" stroke-width="2" stroke-dasharray="10 6" opacity="0.8" />

                        <!-- Phone Stand holding smartphone -->
                        <path d="M100 139 V175" stroke="#ffffff" stroke-width="4" />
                        <path d="M85 175 H115" stroke="#ffffff" stroke-width="6" />

                        <!-- Smartphone Body (Vertical Layout for Reels/Shorts) -->
                        <rect x="82" y="65" width="36" height="68" rx="6" fill="#1e293b" stroke="#ffffff" stroke-width="3" />
                        <!-- Screen preview -->
                        <rect x="86" y="70" width="28" height="50" rx="3" fill="#0f172a" />

                        <!-- Creator UI Elements on phone screen -->
                        <circle cx="100" cy="95" r="10" fill="#ec4899" opacity="0.8" />
                        <polygon points="97,91 105,95 97,99" fill="#ffffff" />
                        <circle cx="90" cy="75" r="2" fill="#ef4444" /> <!-- Red recording dot -->
                        <rect x="94" y="74" width="12" height="2" rx="1" fill="#ffffff" opacity="0.5" />

                        <!-- Likes/Hearts Floating up -->
                        <path d="M60 70 C57 65, 52 65, 50 68 C48 71, 52 77, 60 82 C68 77, 72 71, 70 68 C68 65, 63 65, 60 70 Z" fill="#ec4899" opacity="0.9" class="animate-float-slow" />
                        <path d="M142 85 C139.5 81, 135 81, 133 83.5 C131 86, 135 91, 142 95 C149 91, 153 86, 151 83.5 C149 81, 144.5 81, 142 85 Z" fill="#3b82f6" opacity="0.8" class="animate-float-slow" style="animation-delay: 1.5s;" />
                    </svg>

                @else
                    <!-- DEFAULT / GEOMETRIC AUDIO WAVE ILLUSTRATION -->
                    <svg class="w-full h-full text-white drop-shadow-xl" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="bg-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#004aad"/>
                                <stop offset="100%" stop-color="#c89b3c"/>
                            </linearGradient>
                            <radialGradient id="radial-glow" cx="50%" cy="50%" r="50%">
                                <stop offset="0%" stop-color="#004aad" stop-opacity="0.4"/>
                                <stop offset="100%" stop-color="#000000" stop-opacity="0"/>
                            </radialGradient>
                        </defs>

                        <circle cx="100" cy="100" r="70" fill="url(#radial-glow)" />

                        <!-- Glowing Hexagon Grid -->
                        <polygon points="100,40 152,70 152,130 100,160 48,130 48,70" stroke="url(#bg-grad)" stroke-width="4" stroke-linejoin="round" opacity="0.8" />
                        <polygon points="100,52 141,76 141,124 100,148 59,124 59,76" stroke="#ffffff" stroke-width="1.5" opacity="0.3" />

                        <!-- Play / Wave core -->
                        <circle cx="100" cy="100" r="28" fill="#1e293b" stroke="#ffffff" stroke-width="3" />
                        <polygon points="94,88 114,100 94,112" fill="url(#bg-grad)" />

                        <!-- Orbiting particles -->
                        <circle cx="68" cy="76" r="5" fill="#c89b3c" />
                        <circle cx="132" cy="124" r="6" fill="#004aad" />
                        <circle cx="100" cy="154" r="4" fill="#ffffff" />
                    </svg>
                @endif
            </div>
        </div>
    </div>
</section>
