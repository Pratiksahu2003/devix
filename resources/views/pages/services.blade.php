@extends('layouts.app')

@section('title', 'Studio Services | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Professional photography, videography, podcast recording, live streaming, video editing, advertisement production, and studio rental at DyWix Studio in Dwarka Sector-13, New Delhi." />
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-black h-[70vh] min-h-[600px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img 
                src="{{ asset('storage/room/IMG_0780.jpeg') }}" 
                class="h-full w-full object-cover opacity-50 animate-pan-slow" 
                alt="Studio Background"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/40 to-black"></div>
        </div>
        
        <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center" x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 100)">
            <p 
                class="text-[var(--color-brand-lens-blue)] font-bold tracking-[0.2em] uppercase text-sm mb-6 transition-all duration-1000 transform translate-y-4 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                Creative Studio Services
            </p>
            <h1 
                class="text-5xl md:text-7xl font-bold tracking-tight mb-8 text-white transition-all duration-1000 delay-200 transform translate-y-8 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                Professional Content Creation Services <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-[var(--color-brand-lens-blue)] to-blue-400">at DyWix Studio</span>
            </h1>
            <p 
                class="text-xl text-gray-300 max-w-3xl mx-auto mb-12 font-light transition-all duration-1000 delay-500 transform translate-y-8 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                Welcome to DyWix Studio, a modern content creation space located in Dwarka Sector-13, New Delhi, offering a wide range of professional creative services for creators, brands, influencers, and businesses.
            </p>
            
            <div 
                class="flex flex-col sm:flex-row justify-center gap-5 transition-all duration-1000 delay-700 transform translate-y-8 opacity-0"
                :class="{ 'translate-y-0 opacity-100': shown }"
            >
                <a href="#services" class="rounded-full bg-white text-black px-8 py-4 font-bold hover:bg-gray-100 transition transform hover:scale-105 duration-200">Explore Services</a>
                <a href="{{ route('pages.booking') }}" class="rounded-full border border-white/30 bg-white/10 px-8 py-4 text-white font-bold hover:bg-white/20 transition backdrop-blur-md transform hover:scale-105 duration-200">Book Now</a>
            </div>
        </div>
    </section>

    {{-- Intro Card --}}
    <section class="py-16 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="p-10 rounded-[2rem] bg-gray-50 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }">
                    <h2 class="text-2xl font-bold text-[var(--color-text-main)] mb-6">Our Studio</h2>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">Our studio is designed to support the complete content production process — from concept and shooting to recording and post-production.</p>
                </div>
                <div class="p-10 rounded-[2rem] bg-gray-50 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 100ms;">
                    <h2 class="text-2xl font-bold text-[var(--color-text-main)] mb-6">What We Offer</h2>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">At DyWix, we provide professional photography, videography, podcast recording, live streaming, video editing, advertisement production, and studio rental services. Whether you are producing content for social media, YouTube, advertising campaigns, or brand storytelling, our studio offers the environment, equipment, and expertise needed to deliver high-quality results.</p>
                </div>
            </div>
            <div class="mt-8 p-10 rounded-[2rem] bg-[var(--color-brand-lens-blue)]/5 border border-blue-100" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 200ms;">
                <p class="text-[var(--color-text-main)] text-lg leading-relaxed text-center">DyWix is built to be more than just a studio — it is a creative production hub where ideas turn into powerful visual content.</p>
            </div>
        </div>
    </section>

    {{-- Services Cards --}}
    <section class="py-24 bg-gray-50" id="services">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true">
                <h2 class="text-4xl font-bold text-[var(--color-text-main)]">Our Professional Services</h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Professional Photography Services --}}
                <div class="group p-10 rounded-[2rem] bg-white border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }">
                    <div class="h-16 w-16 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center mb-8 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 10v4a1 1 0 01-1 1h-2" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Professional Photography Services</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mb-6">DyWix offers professional photography services in Delhi for individuals, models, brands, and businesses looking for high-quality visual content. Our photography setup includes professional lighting, versatile backdrops, and a comfortable studio environment to capture stunning images.</p>
                    <p class="text-[var(--color-text-muted)] font-medium mb-2">Our photography services include:</p>
                    <ul class="text-[var(--color-text-muted)] space-y-2 list-disc list-inside">
                        <li>Model portfolio photography</li>
                        <li>Fashion and editorial photography</li>
                        <li>Product photography for e-commerce brands</li>
                        <li>Maternity and lifestyle shoots</li>
                        <li>Corporate photography</li>
                        <li>Kid portfolio shoots</li>
                    </ul>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mt-6">Our photography sessions are designed to create images that are visually striking, professionally composed, and suitable for digital platforms, marketing campaigns, and portfolios.</p>
                </div>

                {{-- Videography and Video Production --}}
                <div class="group p-10 rounded-[2rem] bg-white border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 50ms;">
                    <div class="h-16 w-16 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center mb-8 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Videography and Video Production</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mb-6">Video content is one of the most powerful tools for storytelling and marketing. DyWix provides professional videography services in Delhi, helping creators and businesses produce engaging video content.</p>
                    <p class="text-[var(--color-text-muted)] font-medium mb-2">Our videography services support:</p>
                    <ul class="text-[var(--color-text-muted)] space-y-2 list-disc list-inside">
                        <li>YouTube video production</li>
                        <li>Brand promotional videos</li>
                        <li>Social media video content</li>
                        <li>Product videos for e-commerce</li>
                        <li>Corporate video production</li>
                        <li>Influencer content creation</li>
                    </ul>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mt-6">With professional cameras, lighting systems, and versatile shooting setups, DyWix enables clients to produce high-quality videos that capture attention and communicate messages effectively.</p>
                </div>

                {{-- Podcast Recording Studio --}}
                <div class="group p-10 rounded-[2rem] bg-white border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 100ms;">
                    <div class="h-16 w-16 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center mb-8 group-hover:bg-pink-600 group-hover:text-white transition-colors duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 013-3V4a3 3 0 116 0v1a3 3 0 013 3z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Podcast Recording Studio</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mb-6">DyWix also offers a fully equipped podcast studio in Delhi, designed for creators who want to produce professional podcasts without worrying about technical setup.</p>
                    <p class="text-[var(--color-text-muted)] font-medium mb-2">Our podcast studio supports:</p>
                    <ul class="text-[var(--color-text-muted)] space-y-2 list-disc list-inside">
                        <li>Audio podcast recording</li>
                        <li>Video podcasts for YouTube</li>
                        <li>Interview shows and discussions</li>
                        <li>Panel conversations and talk shows</li>
                        <li>Business and educational podcasts</li>
                    </ul>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mt-6">The studio includes professional microphones, multi-camera recording options, and a comfortable podcast setup, ensuring that your podcast content looks and sounds professional.</p>
                </div>

                {{-- Advertisement Video Production --}}
                <div class="group p-10 rounded-[2rem] bg-white border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 150ms;">
                    <div class="h-16 w-16 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center mb-8 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Advertisement Video Production</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mb-6">For brands and businesses looking to promote their products or services, DyWix provides advertisement video production services.</p>
                    <p class="text-[var(--color-text-muted)] font-medium mb-2">Our team helps produce:</p>
                    <ul class="text-[var(--color-text-muted)] space-y-2 list-disc list-inside">
                        <li>promotional brand videos</li>
                        <li>product advertisements</li>
                        <li>digital marketing videos</li>
                        <li>social media promotional content</li>
                        <li>commercial video campaigns</li>
                    </ul>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mt-6">Professional advertisement videos help businesses communicate their message clearly and build a strong presence across digital platforms.</p>
                </div>

                {{-- Live Streaming Services --}}
                <div class="group p-10 rounded-[2rem] bg-white border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 200ms;">
                    <div class="h-16 w-16 rounded-2xl bg-cyan-100 text-cyan-600 flex items-center justify-center mb-8 group-hover:bg-cyan-600 group-hover:text-white transition-colors duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Live Streaming Services</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mb-6">DyWix also offers live streaming solutions for events, discussions, and digital broadcasts. Our studio infrastructure allows creators and organizations to stream content online with stable video and audio quality.</p>
                    <p class="text-[var(--color-text-muted)] font-medium mb-2">Live streaming services are ideal for:</p>
                    <ul class="text-[var(--color-text-muted)] space-y-2 list-disc list-inside">
                        <li>podcast broadcasts</li>
                        <li>interviews and talk shows</li>
                        <li>product launches</li>
                        <li>webinars and online discussions</li>
                        <li>influencer events and digital campaigns</li>
                    </ul>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mt-6">With the right technical setup, DyWix helps ensure your live content reaches your audience smoothly and professionally.</p>
                </div>

                {{-- Professional Video Editing and Post-Production --}}
                <div class="group p-10 rounded-[2rem] bg-white border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 250ms;">
                    <div class="h-16 w-16 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-8 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Professional Video Editing and Post-Production</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mb-6">Creating high-quality content doesn't stop at filming. Post-production plays a crucial role in shaping the final result. DyWix offers video editing and post-production services, helping creators refine their footage into polished visual content.</p>
                    <p class="text-[var(--color-text-muted)] font-medium mb-2">Our editing services include:</p>
                    <ul class="text-[var(--color-text-muted)] space-y-2 list-disc list-inside">
                        <li>video editing and content assembly</li>
                        <li>color correction and color grading</li>
                        <li>audio optimization</li>
                        <li>social media content formatting</li>
                        <li>editing for YouTube videos and digital campaigns</li>
                    </ul>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mt-6">Through professional editing, your content becomes more engaging, visually appealing, and ready for distribution across platforms.</p>
                </div>

                {{-- Studio Rental for Creators and Production Teams --}}
                <div class="group p-10 rounded-[2rem] bg-white border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 300ms;">
                    <div class="h-16 w-16 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center mb-8 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">Studio Rental for Creators and Production Teams</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mb-6">DyWix also provides studio rental services in Delhi, allowing creators and production teams to use our professional space for their own projects.</p>
                    <p class="text-[var(--color-text-muted)] font-medium mb-2">Our studio rental service is ideal for:</p>
                    <ul class="text-[var(--color-text-muted)] space-y-2 list-disc list-inside">
                        <li>photography shoots</li>
                        <li>videography projects</li>
                        <li>podcast recording</li>
                        <li>influencer collaborations</li>
                        <li>brand campaigns</li>
                        <li>creative content production</li>
                    </ul>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mt-6">The studio environment includes professional lighting setups, versatile shooting areas, and creator-friendly facilities to support smooth production workflows.</p>
                </div>

                {{-- A Complete Content Creation Studio --}}
                <div class="group p-10 rounded-[2rem] bg-white border-2 border-[var(--color-brand-lens-blue)]/30 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 md:col-span-2" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 350ms;">
                    <div class="h-16 w-16 rounded-2xl bg-[var(--color-brand-lens-blue)]/20 text-[var(--color-brand-lens-blue)] flex items-center justify-center mb-8 group-hover:bg-[var(--color-brand-lens-blue)] group-hover:text-white transition-colors duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-main)] mb-4">A Complete Content Creation Studio</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mb-6">What makes DyWix unique is that it offers multiple production services in one location. Creators can shoot, record, edit, and finalize their content within the same studio environment.</p>
                    <p class="text-[var(--color-text-muted)] font-medium mb-2">At DyWix, you can:</p>
                    <ul class="text-[var(--color-text-muted)] space-y-2 list-disc list-inside mb-6">
                        <li>capture professional photos</li>
                        <li>shoot high-quality videos</li>
                        <li>record podcasts</li>
                        <li>edit your content</li>
                        <li>produce advertisements</li>
                        <li>collaborate with other creators</li>
                    </ul>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">This integrated approach makes DyWix a complete creative studio for modern digital content production.</p>
                </div>

               
            </div>
        </div>
    </section>

    {{-- Start Creating with DyWix CTA --}}
    <section class="py-24 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="p-10 rounded-[2rem] bg-gray-50 border border-gray-100 shadow-sm" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }">
                    <h2 class="text-2xl font-bold text-[var(--color-text-main)] mb-6">Start Creating with DyWix</h2>
                    <p class="text-[var(--color-text-muted)] leading-relaxed">If you are looking for professional photography, videography, podcast recording, editing services, or studio rental in Delhi, DyWix provides the perfect environment to bring your ideas to life.</p>
                </div>
                <div class="p-10 rounded-[2rem] bg-[var(--color-brand-lens-blue)]/10 border border-blue-100 shadow-sm" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }" style="transition-delay: 100ms;">
                    <p class="text-[var(--color-text-main)] leading-relaxed">From content creators and influencers to brands and businesses, DyWix supports a wide range of creative projects with professional infrastructure and flexible services.</p>
                    <p class="text-[var(--color-text-main)] leading-relaxed mt-4 font-medium">Join the growing community of creators who choose DyWix Studio in Dwarka, New Delhi for high-quality content production.</p>
                    <a href="{{ route('pages.booking') }}" class="inline-block mt-6 rounded-full bg-[var(--color-brand-lens-blue)] text-white px-8 py-4 font-bold hover:bg-blue-700 transition transform hover:scale-105 duration-200">Book Now</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Frequently Asked Questions --}}
    <section class="py-24 bg-gray-50" id="faq" x-data="{ active: null }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" x-data="{ shown: false }" x-intersect.threshold.0.2="shown = true">
                <h2 class="text-4xl font-bold text-[var(--color-text-main)]">
                    Frequently Asked Questions
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-data="{ shown: false }" x-intersect.threshold.0.1="shown = true" :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }">
                <div class="rounded-2xl border border-gray-200 overflow-hidden hover:border-blue-200 transition-colors duration-300 bg-white shadow-sm">
                    <button @click="active = (active === 1 ? null : 1)" class="flex w-full items-center justify-between p-6 text-left font-bold text-lg text-[var(--color-text-main)] hover:bg-gray-50 transition-colors">
                        <span>What services does DyWix Studio offer?</span>
                        <svg class="h-6 w-6 transform transition-transform duration-300 shrink-0" :class="active === 1 ? 'rotate-180 text-blue-600' : 'text-gray-400'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="active === 1" x-collapse class="p-6 pt-0 text-base text-[var(--color-text-muted)] leading-relaxed">
                        DyWix offers photography, videography, podcast recording, live streaming, video editing, advertisement production, and studio rental services.
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-200 overflow-hidden hover:border-blue-200 transition-colors duration-300 bg-white shadow-sm">
                    <button @click="active = (active === 2 ? null : 2)" class="flex w-full items-center justify-between p-6 text-left font-bold text-lg text-[var(--color-text-main)] hover:bg-gray-50 transition-colors">
                        <span>Who can use DyWix Studio services?</span>
                        <svg class="h-6 w-6 transform transition-transform duration-300 shrink-0" :class="active === 2 ? 'rotate-180 text-blue-600' : 'text-gray-400'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="active === 2" x-collapse class="p-6 pt-0 text-base text-[var(--color-text-muted)] leading-relaxed">
                        The studio is suitable for influencers, YouTubers, brands, photographers, videographers, marketing agencies, and businesses.
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-200 overflow-hidden hover:border-blue-200 transition-colors duration-300 bg-white shadow-sm">
                    <button @click="active = (active === 3 ? null : 3)" class="flex w-full items-center justify-between p-6 text-left font-bold text-lg text-[var(--color-text-main)] hover:bg-gray-50 transition-colors">
                        <span>Is the studio available for rent?</span>
                        <svg class="h-6 w-6 transform transition-transform duration-300 shrink-0" :class="active === 3 ? 'rotate-180 text-blue-600' : 'text-gray-400'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="active === 3" x-collapse class="p-6 pt-0 text-base text-[var(--color-text-muted)] leading-relaxed">
                        Yes, DyWix offers a professional studio for rent that can be used for photography, videography, podcasts, and content production.
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-200 overflow-hidden hover:border-blue-200 transition-colors duration-300 bg-white shadow-sm">
                    <button @click="active = (active === 4 ? null : 4)" class="flex w-full items-center justify-between p-6 text-left font-bold text-lg text-[var(--color-text-main)] hover:bg-gray-50 transition-colors">
                        <span>Where is DyWix Studio located?</span>
                        <svg class="h-6 w-6 transform transition-transform duration-300 shrink-0" :class="active === 4 ? 'rotate-180 text-blue-600' : 'text-gray-400'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="active === 4" x-collapse class="p-6 pt-0 text-base text-[var(--color-text-muted)] leading-relaxed">
                        DyWix Studio is located in Dwarka Sector-13, New Delhi, making it accessible for creators across Delhi NCR.
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
