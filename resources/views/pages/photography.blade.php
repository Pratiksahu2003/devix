@extends('layouts.app')

@section('title', 'Photography Studio on Rent in Delhi NCR | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="{{ config('company.brand') }} offers a fully equipped photography studio on rent in Delhi NCR with professional lighting, multiple backdrops, makeup room, and props for portraits, fashion, product and corporate shoots." />
@endsection

@section('content')
    @php
        $faq = [
            [
                'q' => 'Where is ' . config('company.brand') . ' Photography Studio located?',
                'a' => config('company.brand') . ' Photography Studio is located in Dwarka Sector 13, New Delhi, making it easily accessible from major areas of Delhi NCR, including Janakpuri, West Delhi, and Gurugram. The studio location is convenient for photographers, content creators, brands, and influencers looking for a professional studio space in Delhi.',
            ],
            [
                'q' => 'What services are available at ' . config('company.brand') . ' Studio?',
                'a' => config('company.brand') . ' Studio offers a wide range of creative services including fashion photography, product photography, model portfolio shoots, commercial photography, podcast recording, video production, and social media content creation. The studio is designed to support both photography and video production projects.',
            ],
            [
                'q' => 'Can I rent ' . config('company.brand') . ' Studio for my own photoshoot or video shoot?',
                'a' => 'Yes, ' . config('company.brand') . ' Studio is available for studio rental. Photographers, videographers, influencers, brands, and creators can book the studio for photoshoots, video shoots, podcasts, and commercial productions. The studio can be booked for hourly, half-day, or full-day sessions depending on your project requirements.',
            ],
            [
                'q' => 'What equipment is available at ' . config('company.brand') . ' Photography Studio?',
                'a' => config('company.brand') . ' Studio is equipped with professional cameras, studio lighting setups, audio equipment, and creative backdrops suitable for photography, videography, and podcast recording. The studio provides the essential tools needed to produce high-quality professional content.',
            ],
        ];
        
        $faqLd = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($faq)->map(function ($item) {
                return [
                    '@type' => 'Question',
                    'name' => $item['q'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $item['a'],
                    ],
                ];
            })->toArray(),
        ];

        $hero = [
            'alt' => 'Photography studio makeup room with lighted mirror',
            'src' => 'storage/studio/DSC01010.JPG',
        ];

        $galleryItems = [
           
        ];
    @endphp

    <script type="application/ld+json">{!! json_encode($faqLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>

    {{-- Hero Section - Full Cinematic --}}
    <section class="group relative min-h-[75vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset($hero['src']) }}" alt="{{ $hero['alt'] }}" class="h-full w-full object-cover object-center scale-100 transition-transform duration-[8s] ease-out group-hover:scale-105" />
            <div class="absolute inset-0 bg-slate-950/50"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/95 via-slate-950/40 to-slate-950/70"></div>
        </div>
        <div class="relative z-10 w-full max-w-4xl mx-auto px-6 sm:px-8 text-center">
            <p class="text-amber-400 text-xs font-bold tracking-[0.35em] uppercase mb-6">Photography Studio · Delhi NCR</p>
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.05] tracking-tight">
                Professional Photo &amp; Podcast Studio
            </h1>
            <p class="mt-2 text-xl text-slate-300 font-light">Dwarka, Delhi</p>
            <p class="mt-4 text-slate-400 max-w-xl mx-auto">
                Pro gear, versatile sets &amp; 24/7 access. All under one roof.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="#contact" class="inline-flex items-center justify-center gap-2 rounded-full bg-amber-500 px-10 py-4 text-base font-bold text-slate-950 transition-all duration-300 hover:bg-amber-400 hover:scale-105">
                    Book Studio Now
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
                <a href="#services" class="inline-flex items-center justify-center rounded-full border-2 border-white/50 bg-white/5 backdrop-blur-sm px-10 py-4 text-base font-semibold text-white transition-all duration-300 hover:bg-white/15 hover:border-white/80">
                    View Services
                </a>
            </div>
            <div class="mt-10 flex justify-center gap-8 text-center">
                <div><span class="block text-3xl font-bold text-white">24/7</span><span class="text-sm text-slate-500">Access</span></div>
                <div><span class="block text-3xl font-bold text-white">Pro</span><span class="text-sm text-slate-500">Gear</span></div>
                <div><span class="block text-3xl font-bold text-white">Dwarka</span><span class="text-sm text-slate-500">Sector 13</span></div>
            </div>
        </div>
     
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-slate-50 to-transparent pointer-events-none z-[1]"></div>
    </section>

    {{-- Stats Strip --}}
    <section class="relative z-10 -mt-8">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="rounded-2xl bg-white p-4 shadow-lg shadow-slate-200/50 border border-slate-100 text-center">
                    <span class="text-2xl font-bold text-slate-900">24/7</span>
                    <p class="text-sm text-slate-600 mt-1">Studio Access</p>
                </div>
                <div class="rounded-2xl bg-white p-4 shadow-lg shadow-slate-200/50 border border-slate-100 text-center">
                    <span class="text-2xl font-bold text-slate-900">Pro</span>
                    <p class="text-sm text-slate-600 mt-1">Equipment Included</p>
                </div>
                <div class="rounded-2xl bg-white p-4 shadow-lg shadow-slate-200/50 border border-slate-100 text-center">
                    <span class="text-2xl font-bold text-slate-900">Dwarka</span>
                    <p class="text-sm text-slate-600 mt-1">Sector 13, Delhi</p>
                </div>
                <div class="rounded-2xl bg-white p-4 shadow-lg shadow-slate-200/50 border border-slate-100 text-center">
                    <span class="text-2xl font-bold text-slate-900">Multi</span>
                    <p class="text-sm text-slate-600 mt-1">Format Ready</p>
                </div>
            </div>
        </div>
    </section>

    {{-- A Creative Studio Built for Modern Content Creators --}}
    <section class="bg-slate-50 py-12 border-t border-slate-200">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold text-slate-900 text-center mb-8">A Creative Studio Built for Modern Content Creators</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="rounded-2xl bg-white p-6 shadow-lg shadow-slate-200/50 border border-slate-100 hover:shadow-xl transition-shadow">
                    <div class="h-12 w-12 rounded-xl bg-slate-900 text-white flex items-center justify-center mb-5">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <p class="text-slate-600 leading-relaxed mb-4">The digital era demands high-quality content, and {{ config('company.brand') }} Studio is designed to help creators produce professional visuals with ease.</p>
                    <p class="text-slate-600 leading-relaxed">At {{ config('company.brand') }}, we provide a complete content creation environment where photographers, videographers, podcasters, influencers, and brands can bring their ideas to life.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-lg shadow-slate-200/50 border border-slate-100 hover:shadow-xl transition-shadow">
                    <div class="h-12 w-12 rounded-xl bg-slate-900 text-white flex items-center justify-center mb-5">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <p class="text-slate-600 leading-relaxed mb-4">From fashion photography and product shoots to podcast recording and commercial video production, our studio supports a wide range of creative projects.</p>
                    <p class="text-slate-600 leading-relaxed">Whether you are shooting for social media, advertising campaigns, brand promotions, or personal portfolios, {{ config('company.brand') }} Studio offers the perfect space to create.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Photography Studio Services --}}
    <section id="services" class="bg-white py-12 border-t border-slate-200">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold text-slate-900 text-center mb-4">Our Photography Studio Services</h2>
            <p class="text-slate-600 text-center max-w-2xl mx-auto mb-8">{{ config('company.brand') }} Studio offers multiple creative services tailored to different production needs.</p>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="group rounded-2xl bg-white p-6 border border-slate-200 shadow-sm hover:shadow-xl hover:border-slate-300 hover:-translate-y-1 transition-all duration-300">
                    <div class="h-14 w-14 rounded-2xl bg-slate-100 flex items-center justify-center mb-5 group-hover:bg-slate-900 transition-colors">
                        <svg class="h-7 w-7 text-slate-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 text-lg">Fashion Photography</h3>
                    <p class="mt-3 text-slate-600 text-sm leading-relaxed">Our studio is ideal for fashion shoots, lookbooks, model portfolios, and editorial photography. With professional lighting setups and multiple backdrop options, photographers can create stunning fashion visuals.</p>
                </div>
                <div class="group rounded-2xl bg-white p-6 border border-slate-200 shadow-sm hover:shadow-xl hover:border-slate-300 hover:-translate-y-1 transition-all duration-300">
                    <div class="h-14 w-14 rounded-2xl bg-slate-100 flex items-center justify-center mb-5 group-hover:bg-slate-900 transition-colors">
                        <svg class="h-7 w-7 text-slate-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8 4-8-4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 text-lg">Product Photography</h3>
                    <p class="mt-3 text-slate-600 text-sm leading-relaxed">High-quality product images are essential for e-commerce and brand marketing. {{ config('company.brand') }} Studio provides the perfect environment for product photography, catalog shoots, and commercial product campaigns.</p>
                </div>
                <div class="group rounded-2xl bg-white p-6 border border-slate-200 shadow-sm hover:shadow-xl hover:border-slate-300 hover:-translate-y-1 transition-all duration-300">
                    <div class="h-14 w-14 rounded-2xl bg-slate-100 flex items-center justify-center mb-5 group-hover:bg-slate-900 transition-colors">
                        <svg class="h-7 w-7 text-slate-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 text-lg">Model Portfolio Shoots</h3>
                    <p class="mt-3 text-slate-600 text-sm leading-relaxed">Aspiring models and actors can build their professional portfolios at {{ config('company.brand') }} Studio with high-quality photography and professional lighting setups.</p>
                </div>
                <div class="group rounded-2xl bg-white p-6 border border-slate-200 shadow-sm hover:shadow-xl hover:border-slate-300 hover:-translate-y-1 transition-all duration-300">
                    <div class="h-14 w-14 rounded-2xl bg-slate-100 flex items-center justify-center mb-5 group-hover:bg-slate-900 transition-colors">
                        <svg class="h-7 w-7 text-slate-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 text-lg">Commercial Photography</h3>
                    <p class="mt-3 text-slate-600 text-sm leading-relaxed">Businesses and brands can use our studio for advertising campaigns, marketing shoots, corporate portraits, and brand visuals.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Video & Podcast Cards --}}
    <section class="bg-slate-50 py-12 border-t border-slate-200">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="grid md:grid-cols-2 gap-4">
                {{-- Video Production Card --}}
                <div class="rounded-2xl bg-white p-6 shadow-lg shadow-slate-200/50 border border-slate-100 hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="h-14 w-14 rounded-2xl bg-slate-900 text-white flex items-center justify-center flex-shrink-0">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900">Professional Video Production Studio</h2>
                    </div>
                    <p class="text-slate-600 leading-relaxed mb-5">{{ config('company.brand') }} Studio is not just a photography space — it is also a professional video production studio.</p>
                    <p class="text-slate-600 text-sm font-medium mb-3">We support video projects such as:</p>
                    <ul class="space-y-2 mb-5">
                        @foreach(['Brand advertisement videos', 'Promotional content', 'Corporate video shoots', 'YouTube videos', 'Social media content production'] as $item)
                            <li class="flex items-center gap-2 text-slate-600 text-sm"><span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <p class="text-slate-600 leading-relaxed text-sm">Our studio setup allows creators to produce high-quality video content with cinematic lighting and professional equipment.</p>
                </div>
                {{-- Podcast Card --}}
                <div class="rounded-2xl bg-white p-6 shadow-lg shadow-slate-200/50 border border-slate-100 hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="h-14 w-14 rounded-2xl bg-slate-900 text-white flex items-center justify-center flex-shrink-0">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v0h14z" /></svg>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900">Podcast Studio Setup</h2>
                    </div>
                    <p class="text-slate-600 leading-relaxed mb-5">Podcasting is growing rapidly, and {{ config('company.brand') }} Studio offers a fully equipped podcast recording studio in Delhi.</p>
                    <p class="text-slate-600 text-sm font-medium mb-3">Our podcast studio features:</p>
                    <ul class="space-y-2 mb-5">
                        @foreach(['Professional microphones', 'Multi-camera recording setup', 'Acoustic treatment for clear sound', 'Video podcast recording', 'Interview-style setups'] as $item)
                            <li class="flex items-center gap-2 text-slate-600 text-sm"><span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <p class="text-slate-600 leading-relaxed text-sm">Creators, influencers, and businesses can record professional podcasts, interviews, and video podcasts with high-quality audio and video production.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- High-End Studio Equipment --}}
    <section class="bg-slate-50 py-12 border-t border-slate-200">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold text-slate-900 text-center mb-4">High-End Studio Equipment</h2>
            <p class="text-slate-600 text-center max-w-2xl mx-auto mb-8">{{ config('company.brand') }} Studio is equipped with industry-grade production tools used in professional content creation.</p>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="group rounded-2xl bg-white p-6 border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="h-12 w-12 rounded-xl bg-slate-100 flex items-center justify-center mb-4 group-hover:bg-slate-900 transition-colors">
                        <svg class="h-6 w-6 text-slate-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H20a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V9z" /></svg>
                    </div>
                    <h3 class="font-bold text-slate-900">Cameras</h3>
                    <p class="text-slate-600 text-sm mt-2">Professional cinema cameras capable of capturing high-quality photo and video content.</p>
                </div>
                <div class="group rounded-2xl bg-white p-6 border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="h-12 w-12 rounded-xl bg-slate-100 flex items-center justify-center mb-4 group-hover:bg-slate-900 transition-colors">
                        <svg class="h-6 w-6 text-slate-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
                    </div>
                    <h3 class="font-bold text-slate-900">Lighting</h3>
                    <p class="text-slate-600 text-sm mt-2">Advanced lighting setups designed for studio photography and cinematic video production.</p>
                </div>
                <div class="group rounded-2xl bg-white p-6 border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="h-12 w-12 rounded-xl bg-slate-100 flex items-center justify-center mb-4 group-hover:bg-slate-900 transition-colors">
                        <svg class="h-6 w-6 text-slate-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" /></svg>
                    </div>
                    <h3 class="font-bold text-slate-900">Audio Systems</h3>
                    <p class="text-slate-600 text-sm mt-2">Professional audio equipment to ensure crystal-clear sound for podcasts, interviews, and video shoots.</p>
                </div>
                <div class="group rounded-2xl bg-white p-6 border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="h-12 w-12 rounded-xl bg-slate-100 flex items-center justify-center mb-4 group-hover:bg-slate-900 transition-colors">
                        <svg class="h-6 w-6 text-slate-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="font-bold text-slate-900">Lenses & Accessories</h3>
                    <p class="text-slate-600 text-sm mt-2">Premium lenses and creative tools that allow photographers and videographers to experiment with different visual styles.</p>
                </div>
            </div>
            <p class="text-slate-600 leading-relaxed text-center mt-8">This professional setup ensures that creators can produce high-quality commercial-grade content.</p>
        </div>
    </section>

    {{-- Gallery Preview - Image Cards --}}
    <section class="bg-white py-12 border-t border-slate-200">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Shot at Our Studio</h2>
                    <p class="mt-2 text-slate-600">Real results from recent bookings. See what's possible.</p>
                </div>
                <a href="{{ url('/gallery') }}" class="inline-flex items-center font-semibold text-slate-900 hover:text-slate-700 gap-2 group">
                    View Full Gallery
                    <svg class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-4">
                @foreach($galleryItems as $item)
                    <div class="group relative overflow-hidden rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 aspect-[4/5]">
                        <img src="{{ asset($item['src']) }}" alt="{{ $item['alt'] }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-5">
                            <span class="text-white font-semibold">{{ $item['alt'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Studio Space & Infrastructure - Card --}}
    <section class="bg-white py-12 border-t border-slate-200">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="rounded-2xl bg-slate-50 p-6 md:p-8 border border-slate-200 shadow-sm">
                <div class="flex items-center gap-4 mb-6">
                    <div class="h-14 w-14 rounded-2xl bg-slate-900 text-white flex items-center justify-center flex-shrink-0">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Studio Space & Infrastructure</h2>
                </div>
                <p class="text-slate-600 leading-relaxed mb-6">{{ config('company.brand') }} Studio is designed to provide a comfortable and professional production environment.</p>
                <p class="text-slate-600 font-medium mb-4">Key studio features include:</p>
                <div class="grid sm:grid-cols-2 gap-3 mb-6">
                    @foreach(['Spacious shooting area', 'High ceilings for lighting rigs', 'Multiple backdrop options', 'Professional lighting setups', 'Dedicated podcast recording space', 'Power supply for heavy production equipment'] as $feature)
                        <div class="flex items-center gap-2 text-slate-600"><span class="h-2 w-2 rounded-full bg-slate-400 flex-shrink-0"></span>{{ $feature }}</div>
                    @endforeach
                </div>
                <p class="text-slate-600 leading-relaxed">The studio is designed to support professional photography, video production, and creative projects of all scales.</p>
            </div>
        </div>
    </section>

    {{-- Convenient Location - Card --}}
    <section class="bg-slate-50 py-12 border-t border-slate-200">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="rounded-2xl bg-white p-6 md:p-8 border border-slate-200 shadow-lg shadow-slate-200/50 hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-4 mb-6">
                    <div class="h-14 w-14 rounded-2xl bg-slate-900 text-white flex items-center justify-center flex-shrink-0">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Convenient Location in Dwarka, New Delhi</h2>
                </div>
                <p class="text-slate-600 leading-relaxed mb-6">{{ config('company.brand') }} Studio is located in Dwarka Sector 13, New Delhi, making it easily accessible from major areas of Delhi NCR.</p>
                <p class="text-slate-600 font-medium mb-4">The studio is conveniently located near:</p>
                <div class="flex flex-wrap gap-3 mb-6">
                    @foreach(['Janakpuri', 'West Delhi', 'Gurugram', 'IGI Airport'] as $area)
                        <span class="inline-flex items-center px-4 py-2 rounded-xl bg-slate-100 text-slate-700 text-sm font-medium">{{ $area }}</span>
                    @endforeach
                </div>
                <p class="text-slate-600 leading-relaxed mb-6">This central location allows photographers, creators, and brands across Delhi NCR to easily access the studio for shoots and recordings.</p>
                <a href="{{ route('pages.location') }}" class="inline-flex items-center font-semibold text-slate-900 hover:text-slate-700 gap-2 px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 transition-colors">
                    View location &amp; access
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Why Choose - Cards --}}
    <section class="bg-white py-12 border-t border-slate-200">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold text-slate-900 text-center mb-4">Why Choose {{ config('company.brand') }} Studio</h2>
            <p class="text-slate-600 text-center max-w-2xl mx-auto mb-8">There are many studios in Delhi, but {{ config('company.brand') }} stands out because of its creator-focused environment and professional infrastructure.</p>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="rounded-2xl bg-slate-50 p-6 border border-slate-200 hover:shadow-lg hover:border-slate-300 transition-all duration-300">
                    <div class="h-12 w-12 rounded-xl bg-slate-900 text-white flex items-center justify-center mb-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    </div>
                    <h3 class="font-bold text-slate-900">Professional Production Setup</h3>
                    <p class="text-slate-600 text-sm mt-2">Our studio provides high-quality equipment and lighting setups designed for professional photography and videography.</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-6 border border-slate-200 hover:shadow-lg hover:border-slate-300 transition-all duration-300">
                    <div class="h-12 w-12 rounded-xl bg-slate-900 text-white flex items-center justify-center mb-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z" /></svg>
                    </div>
                    <h3 class="font-bold text-slate-900">Multi-Purpose Creative Space</h3>
                    <p class="text-slate-600 text-sm mt-2">{{ config('company.brand') }} Studio supports photography, videography, podcasts, product shoots, and advertising campaigns.</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-6 border border-slate-200 hover:shadow-lg hover:border-slate-300 transition-all duration-300">
                    <div class="h-12 w-12 rounded-xl bg-slate-900 text-white flex items-center justify-center mb-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h3 class="font-bold text-slate-900">Ideal for Creators & Brands</h3>
                    <p class="text-slate-600 text-sm mt-2">Whether you are a photographer, influencer, YouTuber, startup, or brand, we provide the perfect space for high-quality content.</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-6 border border-slate-200 hover:shadow-lg hover:border-slate-300 transition-all duration-300">
                    <div class="h-12 w-12 rounded-xl bg-slate-900 text-white flex items-center justify-center mb-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="font-bold text-slate-900">Modern Content Studio</h3>
                    <p class="text-slate-600 text-sm mt-2">Built to support the modern creator economy, helping creators produce professional content for digital platforms.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Book Your Studio Session - CTA Card --}}
    <section class="bg-slate-50 py-12 border-t border-slate-200">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <div class="rounded-2xl bg-slate-900 p-6 md:p-8 text-center text-white shadow-2xl">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">Book Your Studio Session</h2>
                <p class="text-slate-300 leading-relaxed mb-4 max-w-2xl mx-auto">If you are looking for a professional photography studio in Delhi NCR, {{ config('company.brand') }} Studio is the perfect place to bring your creative ideas to life.</p>
                <p class="text-slate-300 leading-relaxed mb-4 max-w-2xl mx-auto">Our studio is available for photography shoots, video production, podcast recording, and content creation projects. Book for hourly sessions, half-day shoots, or full-day production projects.</p>
                <p class="text-slate-200 font-medium mb-8">Create stunning content, build your brand, and bring your vision to life at {{ config('company.brand') }} Studio.</p>
                <a href="#contact" class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-10 py-4 text-base font-bold text-slate-900 shadow-lg transition-all duration-300 hover:bg-slate-100 hover:scale-105">
                    Book Studio Now
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Gallery - Shot at Our Studio --}}
    <section class="bg-white py-12 border-t border-slate-200">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Shot at Our Studio</h2>
                    <p class="mt-2 text-slate-600">Real results from recent bookings. See what's possible.</p>
                </div>
                <a href="{{ url('/gallery') }}" class="inline-flex items-center font-semibold text-slate-900 hover:text-slate-700 gap-2 group">
                    View Full Gallery
                    <svg class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($galleryItems as $item)
                    <div class="group rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 aspect-[4/5]">
                        <img src="{{ asset($item['src']) }}" alt="{{ $item['alt'] }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-5">
                            <span class="text-white font-semibold">{{ $item['alt'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- DyWix Studio – Where Creativity Meets Professional Production - Card --}}
    <section class="bg-slate-50 py-12 border-t border-slate-200">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <div class="rounded-2xl bg-white p-6 md:p-8 border border-slate-200 shadow-lg shadow-slate-200/50">
                <h2 class="text-2xl font-bold text-slate-900 mb-4">{{ config('company.brand') }} – Where Creativity Meets Professional Production</h2>
                <p class="text-slate-600 leading-relaxed mb-4">{{ config('company.brand') }} Studio is more than just a photography space — it is a creative environment designed for creators, brands, and storytellers.</p>
                <p class="text-slate-600 leading-relaxed mb-4">From fashion shoots and product photography to podcast recordings and commercial video production, our studio provides the tools and space needed to produce high-quality content.</p>
                <p class="text-slate-600 leading-relaxed">If you are ready to create professional content, {{ config('company.brand') }} Studio is ready for you.</p>
            </div>
        </div>
    </section>

    {{-- Frequently Asked Questions (FAQs) --}}
    <section class="bg-slate-50 py-10 border-t border-slate-200">
        <div class="mx-auto max-w-3xl px-4 sm:px-6">
            <h2 class="text-2xl font-bold text-slate-900 text-center mb-8">Frequently Asked Questions (FAQs)</h2>
            <div class="space-y-4" x-data="{ active: null }">
                @foreach($faq as $index => $item)
                    <div class="overflow-hidden rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                        <button 
                            @click="active = active === {{ $index }} ? null : {{ $index }}"
                            class="flex w-full items-center justify-between px-6 py-5 text-left font-medium text-slate-900 hover:bg-slate-50 transition"
                        >
                            <span class="text-base pr-4">{{ $index + 1 }}. {{ $item['q'] }}</span>
                            <span :class="active === {{ $index }} ? 'rotate-180 text-slate-600' : 'text-slate-400'" class="flex-shrink-0 transition-transform duration-200">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </span>
                        </button>
                        <div 
                            x-show="active === {{ $index }}" 
                            x-collapse
                            class="border-t border-slate-100 bg-slate-50/50 px-6 py-5 text-slate-600 leading-relaxed"
                        >
                            {{ $item['a'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
