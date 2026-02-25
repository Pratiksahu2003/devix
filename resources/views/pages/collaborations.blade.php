@extends('layouts.app')

@section('title', 'Collaborations | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Partner with {{ config('company.brand') }}. We offer retainer models, priority booking, and co-production opportunities for agencies, brands, and high-volume creators." />
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-black pt-24 pb-32 lg:pt-32 lg:pb-40 text-white">
        <div class="absolute inset-0 z-0">
             <div class="absolute inset-0 bg-gradient-to-r from-black via-black/90 to-transparent z-10"></div>
             <img src="{{ asset('storage/studio/DSC01007.JPG') }}" alt="Studio Background" class="h-full w-full object-cover opacity-50">
        </div>
        
        <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-16 items-center">
                <div class="lg:col-span-7">
                    <div class="inline-flex items-center rounded-full bg-blue-500/10 border border-blue-500/20 px-4 py-1.5 text-sm font-medium text-blue-400 mb-8 backdrop-blur-sm">
                        <span class="flex h-2 w-2 rounded-full bg-blue-500 mr-2 animate-pulse"></span>
                        Partnerships & Retainers
                    </div>
                    <h1 class="text-5xl font-bold tracking-tight sm:text-6xl lg:text-7xl mb-8 leading-tight">
                        Let’s Build a <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-600">Creative Engine.</span>
                    </h1>
                    <p class="text-xl text-gray-400 leading-relaxed mb-10 max-w-2xl">
                        We don’t just rent space; we partner with brands and agencies to build sustainable content workflows. Unlock exclusive rates, priority access, and production support.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#contact" class="inline-flex items-center justify-center rounded-full bg-blue-600 px-8 py-4 text-base font-bold text-white shadow-[0_0_20px_rgba(37,99,235,0.4)] hover:bg-blue-700 hover:shadow-[0_0_30px_rgba(37,99,235,0.6)] transition-all duration-300 transform hover:-translate-y-1">
                            Start a Conversation
                        </a>
                        <a href="#models" class="inline-flex items-center justify-center rounded-full border border-white/20 bg-white/5 px-8 py-4 text-base font-bold text-white hover:bg-white/10 backdrop-blur-sm transition-all duration-300">
                            View Models
                        </a>
                    </div>
                </div>
                
                {{-- Hero Visual Grid --}}
                <div class="hidden lg:grid lg:col-span-5 grid-cols-2 gap-4">
                    <div class="space-y-4 pt-12">
                        <div class="rounded-2xl overflow-hidden shadow-2xl border border-white/10 transform hover:scale-105 transition duration-500">
                             <img src="{{ asset('storage/studio/DSC01003.JPG') }}" class="h-48 w-full object-cover">
                        </div>
                        <div class="rounded-2xl overflow-hidden shadow-2xl border border-white/10 transform hover:scale-105 transition duration-500">
                             <img src="{{ asset('storage/studio/DSC01008.JPG') }}" class="h-64 w-full object-cover">
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="rounded-2xl overflow-hidden shadow-2xl border border-white/10 transform hover:scale-105 transition duration-500">
                             <img src="{{ asset('storage/studio/DSC01009.JPG') }}" class="h-64 w-full object-cover">
                        </div>
                        <div class="rounded-2xl overflow-hidden shadow-2xl border border-white/10 transform hover:scale-105 transition duration-500">
                             <img src="{{ asset('storage/studio/DSC01010.JPG') }}" class="h-48 w-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Who We Work With --}}
    <section class="py-24 bg-gray-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Who We Collaborate With</h2>
                <p class="text-lg text-gray-600">We build custom relationships based on volume and production needs.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                {{-- Agencies --}}
                <div class="group bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="h-14 w-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-8 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Creative Agencies</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        For agencies needing a reliable "home base" for multiple clients. We offer white-label production support and simplified billing.
                    </p>
                    <div class="h-48 rounded-xl overflow-hidden">
                        <img src="{{ asset('storage/studio/DSC01002.JPG') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    </div>
                </div>

                {{-- D2C Brands --}}
                <div class="group bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="h-14 w-14 rounded-2xl bg-pink-50 text-pink-600 flex items-center justify-center mb-8 group-hover:bg-pink-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">D2C Brands</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Consistent imagery is vital for conversion. Lock in a monthly slot for new drops, social content, and campaign shoots.
                    </p>
                    <div class="h-48 rounded-xl overflow-hidden">
                        <img src="{{ asset('storage/studio/DSC01003.JPG') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    </div>
                </div>

                {{-- Production Houses --}}
                <div class="group bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="h-14 w-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-8 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Production Houses</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Need a secondary unit location or a specialized podcast set? We integrate seamlessly into your larger production logistics.
                    </p>
                    <div class="h-48 rounded-xl overflow-hidden">
                        <img src="{{ asset('storage/studio/DSC01012.JPG') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Partnership Models --}}
    <section id="models" class="py-24 bg-white overflow-hidden">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div class="space-y-12">
                    <div class="border-l-4 border-blue-600 pl-6">
                        <h2 class="text-4xl font-bold text-gray-900">Partnership Models</h2>
                        <p class="mt-4 text-lg text-gray-500">Flexible ways to work together.</p>
                    </div>
                    
                    <div class="space-y-8">
                        <div class="flex gap-6 group">
                            <div class="flex-shrink-0 mt-1">
                                <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-lg font-bold group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">1</div>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Retainer Blocks</h4>
                                <p class="text-gray-600 mt-2 leading-relaxed">
                                    Purchase a bank of 50+ hours at our lowest rate. Use them flexibly over 3 months. Perfect for regular content needs.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-6 group">
                            <div class="flex-shrink-0 mt-1">
                                <div class="h-10 w-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-lg font-bold group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">2</div>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 group-hover:text-purple-600 transition-colors">Volume Agreements</h4>
                                <p class="text-gray-600 mt-2 leading-relaxed">
                                    Committed to 4 shoots a month? We'll lock in your preferred dates and provide a dedicated account manager.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-6 group">
                            <div class="flex-shrink-0 mt-1">
                                <div class="h-10 w-10 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center text-lg font-bold group-hover:bg-pink-600 group-hover:text-white transition-colors duration-300">3</div>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 group-hover:text-pink-600 transition-colors">Referral Program</h4>
                                <p class="text-gray-600 mt-2 leading-relaxed">
                                    Are you a photographer or stylist? Bring your clients to {{ config('company.brand') }} and earn commission or credit on bookings.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-blue-100 to-purple-100 rounded-[2rem] transform rotate-2"></div>
                    <div class="relative rounded-[2rem] overflow-hidden shadow-2xl">
                        <img src="{{ asset('storage/studio/DSC01010.JPG') }}" alt="Meeting" class="w-full object-cover h-[600px]">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-8 left-8 right-8 text-white">
                            <p class="font-serif italic text-2xl">"The best studio partnership we've had. Consistent quality and zero friction."</p>
                            <div class="mt-4 flex items-center gap-4">
                                <div class="h-10 w-10 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center font-bold">JD</div>
                                <div>
                                    <p class="font-bold">John Doe</p>
                                    <p class="text-sm text-white/70">Creative Director, Agency X</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Form Section --}}
    <x-home.contact />
@endsection