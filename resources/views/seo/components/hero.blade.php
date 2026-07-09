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

    // Default equipment lists if empty
    $equipment = (!empty($serviceData) && is_array($serviceData) && !empty($serviceData['equipment'])) ? $serviceData['equipment'] : [];
    if (empty($equipment)) {
        if ($category === 'podcast') {
            $equipment = ['Broadcast Microphones (Shure/Rode)', 'Multi-Camera Video Recording', 'Acoustic Sound Treatment', 'Focusrite Audio Interface'];
        } elseif ($category === 'video') {
            $equipment = ['4K Cinema Camera System', 'Aputure LED Light Kit', '12ft Green Screen Cyc Wall', 'Wireless Microphone Set'];
        } elseif ($category === 'photography') {
            $equipment = ['High-Res Full Frame Sensor', 'Profoto Studio Strobes', 'Multi-Color Backdrops', 'Makeup & Staging Areas'];
        } elseif ($category === 'creator') {
            $equipment = ['Vertical Camera/Phone Rigs', 'Dimmable RGB Ring Lights', 'Neon & Aesthetic Backdrops', 'Wireless Audio Receivers'];
        } else {
            $equipment = ['Professional Gear Rental', 'Acoustically Isolated Space', 'Expert On-Site Engineer', 'Flexible Booking Slots'];
        }
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

<section class="relative bg-gradient-to-br from-[#0a1e3f] via-[#051126] to-[#010610] text-white rounded-3xl p-6 md:p-10 shadow-2xl overflow-hidden border border-white/5 reveal-up is-visible">
    <!-- Backlight glows -->
    <div class="absolute -top-12 -right-12 w-96 h-96 bg-brand-gold-accent opacity-15 rounded-full blur-3xl pointer-events-none animate-pulse-soft"></div>
    <div class="absolute -bottom-12 -left-12 w-96 h-96 bg-brand-lens-blue opacity-15 rounded-full blur-3xl pointer-events-none animate-pulse-soft" style="animation-delay: 2s;"></div>

    <div class="relative grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        <!-- Content Column -->
        <div class="lg:col-span-7 space-y-6">
            <!-- Badge -->
            <div class="flex flex-wrap gap-2">
                @if($category === 'podcast')
                    <span class="inline-flex items-center px-3 py-1 bg-red-500/10 border border-red-500/30 text-red-400 rounded-full text-xs font-semibold uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm10 8a1 1 0 10-2 0v1a5 5 0 11-10 0v-1a1 1 0 10-2 0v1a7 7 0 1014 0v-1z"></path></svg>
                        Podcast Recording
                    </span>
                @elseif($category === 'video')
                    <span class="inline-flex items-center px-3 py-1 bg-blue-500/10 border border-blue-500/30 text-blue-400 rounded-full text-xs font-semibold uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zm12.553 2.236A1 1 0 0014 9v2a1 1 0 00.553.894l2 1A1 1 0 0018 12V8a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                        Video Production
                    </span>
                @elseif($category === 'photography')
                    <span class="inline-flex items-center px-3 py-1 bg-amber-500/10 border border-amber-500/30 text-amber-400 rounded-full text-xs font-semibold uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.12-1.12A1 1 0 0011.878 3H8.122a1 1 0 00-.707.293L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
                        Professional Photography
                    </span>
                @elseif($category === 'creator')
                    <span class="inline-flex items-center px-3 py-1 bg-purple-500/10 border border-purple-500/30 text-purple-400 rounded-full text-xs font-semibold uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                        Creator & Social Media Studio
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 bg-brand-gold-accent/20 border border-brand-gold-accent/40 text-brand-gold-accent rounded-full text-xs font-semibold uppercase tracking-wider">
                        DyWix Premium Studio
                    </span>
                @endif

                <span class="inline-block px-3 py-1 bg-white/5 border border-white/10 text-gray-300 rounded-full text-xs font-semibold">
                    Dwarka, Delhi NCR
                </span>
            </div>

            <!-- Title -->
            <h1 class="text-3xl md:text-5xl font-serif leading-tight font-bold tracking-tight text-white">
                {{ $page['h1'] ?? '' }}
            </h1>

            <!-- Description -->
            <p class="text-base md:text-lg text-gray-300 leading-relaxed max-w-2xl">
                Ready-to-use professional environment in {{ $location['name'] ?? 'Dwarka' }} featuring premium acoustic isolation, high-end production cameras, and dedicated engineer assistance to elevate your visual content.
            </p>

            <!-- Amenities/Equipment list (Rich Info) -->
            <div class="pt-2">
                <p class="text-xs uppercase font-bold tracking-widest text-brand-gold-accent mb-3">Included Setup & Gear highlights</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach(array_slice($equipment, 0, 4) as $equip)
                        <div class="flex items-center space-x-3 bg-white/5 border border-white/[0.03] rounded-xl p-3 hover:bg-white/[0.08] transition duration-200">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-brand-gold-accent/25 border border-brand-gold-accent/40 text-brand-gold-accent flex items-center justify-center font-bold text-xs">
                                ✓
                            </span>
                            <span class="text-sm font-medium text-gray-200">{{ $equip }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <a href="/contact" class="px-8 py-4 bg-brand-gold-accent hover:bg-[#b0852d] text-white font-bold rounded-xl shadow-lg shadow-brand-gold-accent/10 hover:shadow-brand-gold-accent/25 transition-all duration-300 text-center transform hover:-translate-y-0.5">
                    Book Studio Session
                </a>
                <a href="{{ config('dywix.whatsapp_link') }}" target="_blank" rel="noopener" class="px-8 py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl shadow-lg shadow-emerald-950/20 transition-all duration-300 text-center flex items-center justify-center space-x-2 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 text-white fill-current mr-1" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.458L0 24zm6.59-4.846c1.6.95 3.182 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.963C16.59 1.981 14.119.957 11.49.957c-5.442 0-9.87 4.372-9.874 9.802-.001 1.78.47 3.517 1.365 5.097L1.916 21.8l6.136-1.611zM17.91 14.92c-.32-.16-1.89-.93-2.184-1.04-.294-.11-.51-.16-.72.16-.21.32-.82 1.04-1.002 1.25-.18.21-.36.24-.68.08-.32-.16-1.35-.5-2.56-1.59-.95-.85-1.6-1.9-1.78-2.22-.18-.32-.02-.49.14-.65.15-.14.32-.37.48-.56.16-.18.21-.32.32-.53.11-.21.05-.4-.03-.56-.08-.16-.72-1.74-.99-2.38-.26-.64-.52-.55-.72-.56l-.61-.01c-.21 0-.55.08-.84.4-.29.32-1.12 1.1-1.12 2.68 0 1.58 1.15 3.11 1.31 3.32.16.21 2.26 3.45 5.47 4.84.76.33 1.36.53 1.83.68.77.24 1.47.21 2.03.13.62-.09 1.89-.77 2.15-1.52.26-.75.26-1.4.18-1.52-.08-.12-.29-.18-.61-.34z"/></svg>
                    <span>WhatsApp Booking</span>
                </a>
            </div>
        </div>

        <!-- SVG Illustration Column -->
        <div class="lg:col-span-5 flex justify-center items-center w-full min-h-[300px]">
            <!-- Glassmorphic graphic container -->
            <div class="relative w-full max-w-[360px] aspect-square rounded-3xl bg-white/[0.03] border border-white/10 shadow-inner flex items-center justify-center p-6 overflow-hidden animate-float-slow group">
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

