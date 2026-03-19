@extends('layouts.app')

@section('title', 'Help Center | Book Podcast Studio in Delhi – Dywix Support & FAQs')

@section('meta')
    <meta name="description" content="Get answers about booking a podcast studio in Delhi. Explore pricing, equipment, and services at Dywix content studio in Dwarka. Start creating today.">
@endsection

@section('content')
<div class="min-h-screen bg-[#F8F9FC] font-sans text-slate-800 pb-20">
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-b from-[#F2F0FF] to-[#F8F9FC] pt-24 pb-14 px-4 shadow-sm border-b border-gray-100">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-3xl md:text-5xl font-bold text-[#2D335A] mb-4">Help Center – Dywix Podcast Studio in Delhi</h1>
            <p class="text-[18px] text-[#555C7A] mb-6 font-medium">Find Answers About Booking, Pricing & Studio Services</p>
            
            <p class="text-[15px] text-[#646A85] mb-8 max-w-3xl mx-auto leading-relaxed">
                Looking for a podcast studio in Delhi that’s easy to book and fully equipped? You’re in the right place.<br>
                Welcome to the Dywix Help Center—your complete guide to understanding how our content creation studio in Dwarka works. Whether you're planning your first podcast or shooting reels for your brand, this page answers all your questions in a simple and clear way.
            </p>

            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <a href="{{ route('pages.booking') }}" class="px-8 py-3 bg-[#635BFF] hover:bg-[#5249ea] text-white font-medium rounded-lg shadow-sm transition text-sm">Book Studio</a>
                <a href="{{ route('pages.contact') }}" class="px-8 py-3 bg-white border border-gray-200 text-[#3A4363] hover:bg-gray-50 font-medium rounded-lg shadow-sm transition text-sm">Contact Support</a>
            </div>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 pt-10">
        
        {{-- Quick Help Categories --}}
        <section>
            <h2 class="text-center text-2xl font-bold text-[#2D335A] mb-8">Quick Help Categories</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Category Cards --}}
                <a href="{{ route('pages.booking') }}" class="block p-5 bg-white border border-gray-200 rounded-xl hover:shadow-md transition">
                    <div class="flex items-center mb-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[#F2F0FF] mr-4 text-[#635BFF] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="font-bold text-[16px] text-[#3A4363]">Booking the Studio</h3>
                    </div>
                    <p class="text-[14px] text-gray-500 leading-relaxed ml-14">Learn how to book a podcast studio in Dwarka Delhi in just a few clicks. Understand time slots, availability, and how to secure your session without hassle.</p>
                </a>

                <a href="{{ route('pages.pricing') }}" class="block p-5 bg-white border border-gray-200 rounded-xl hover:shadow-md transition">
                    <div class="flex items-center mb-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[#F2F0FF] mr-4 text-[#635BFF] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="font-bold text-[16px] text-[#3A4363]">Pricing & Packages</h3>
                    </div>
                    <p class="text-[14px] text-gray-500 leading-relaxed ml-14">Explore our transparent pricing designed for creators looking for an affordable podcast studio in Delhi without compromising on quality.</p>
                </a>

                <a href="{{ route('pages.studio-specs') }}" class="block p-5 bg-white border border-gray-200 rounded-xl hover:shadow-md transition">
                    <div class="flex items-center mb-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[#F2F0FF] mr-4 text-[#635BFF] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="font-bold text-[16px] text-[#3A4363]">Studio Setup</h3>
                    </div>
                    <p class="text-[14px] text-gray-500 leading-relaxed ml-14">Get insights into our plug-and-play podcast studio setup, including microphones, lighting, and camera systems.</p>
                </a>

                <a href="{{ route('pages.services') }}" class="block p-5 bg-white border border-gray-200 rounded-xl hover:shadow-md transition">
                    <div class="flex items-center mb-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[#F2F0FF] mr-4 text-[#635BFF] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="font-bold text-[16px] text-[#3A4363]">Services Offered</h3>
                    </div>
                    <p class="text-[14px] text-gray-500 leading-relaxed ml-14">Discover everything you can create at Dywix—from podcasts to Instagram reels shooting in Delhi and brand videos.</p>
                </a>

                <a href="{{ route('pages.location') }}" class="block p-5 bg-white border border-gray-200 rounded-xl hover:shadow-md transition">
                    <div class="flex items-center mb-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[#F2F0FF] mr-4 text-[#635BFF] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <h3 class="font-bold text-[16px] text-[#3A4363]">Location & Accessibility</h3>
                    </div>
                    <p class="text-[14px] text-gray-500 leading-relaxed ml-14">Find directions to our Dwarka-based content studio and learn about parking and accessibility.</p>
                </a>

                <a href="{{ route('pages.contact') }}" class="block p-5 bg-white border border-gray-200 rounded-xl hover:shadow-md transition">
                    <div class="flex items-center mb-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[#F2F0FF] mr-4 text-[#635BFF] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="font-bold text-[16px] text-[#3A4363]">Support & Assistance</h3>
                    </div>
                    <p class="text-[14px] text-gray-500 leading-relaxed ml-14">Need help? Our team is always ready to guide you before, during, and after your session.</p>
                </a>
            </div>
        </section>

        {{-- Frequently Asked Questions --}}
        <section x-data="{ active: 0 }">
            <div class="relative flex items-center mb-6">
                <div class="flex-grow border-t border-gray-200"></div>
                <h2 class="flex-shrink-0 mx-4 text-[#2D335A] font-bold text-xl">Frequently Asked Questions</h2>
                <div class="flex-grow border-t border-gray-200"></div>
            </div>

            <div class="space-y-3">
                @php
                    $faqs = [
                        [
                            'q' => 'What is Dywix Studio?', 
                            'a' => 'Dywix is a modern and fully equipped video podcast studio in Delhi, built for creators, influencers, and brands who want high-quality content without investing in expensive gear.<br><br>Our studio offers a professional environment where you can record podcasts, shoot videos, and create engaging content effortlessly.'
                        ],
                        [
                            'q' => 'How can I book a podcast studio in Delhi at Dywix?', 
                            'a' => 'Booking is simple and beginner-friendly.<br><br>Just visit our website, choose your preferred time slot, and confirm your session. If you\'re looking for a quick and easy studio booking in Dwarka, Dywix ensures a smooth experience from start to finish.'
                        ],
                        [
                            'q' => 'What are the pricing plans?', 
                            'a' => 'We offer flexible pricing options so that every creator can get started:<br><ul class="list-disc pl-5 mt-2 space-y-1"><li>Hourly plans for short sessions</li><li>Full-day packages for bulk content creation</li><li>Premium access for brands and agencies</li></ul><br>Our goal is to provide a budget-friendly podcast studio in Delhi without compromising on quality.'
                        ],
                        [
                            'q' => 'What equipment is available in the studio?', 
                            'a' => 'Dywix provides everything you need for professional recording:<br><ul class="list-disc pl-5 mt-2 space-y-1"><li>High-quality microphones</li><li>Multi-camera video setup</li><li>Studio lighting</li><li>Soundproof recording environment</li></ul><br>This makes it one of the best choices for a professional podcast recording studio in Delhi.'
                        ],
                        [
                            'q' => 'Do I need technical skills to use the studio?', 
                            'a' => 'Not at all. Dywix is designed as a plug-and-play podcast studio, which means you don’t need any technical knowledge.<br><br>Our team helps you with setup so you can focus entirely on your content.'
                        ],
                        [
                            'q' => 'Can I shoot reels and brand videos?', 
                            'a' => 'Yes. Dywix is more than just a podcast studio.<br><br>You can create:<br><ul class="list-disc pl-5 mt-2 space-y-1"><li>Instagram reels</li><li>YouTube videos</li><li>Product shoots</li><li>Personal branding content</li></ul><br>It’s a complete content creation studio in Delhi for creators and businesses.'
                        ],
                        [
                            'q' => 'Where is Dywix located?', 
                            'a' => 'Dywix is located in Dwarka, making it easily accessible for creators across Delhi NCR. If you\'re searching for a podcast studio near Dwarka Delhi, Dywix is a convenient choice.'
                        ],
                        [
                            'q' => 'Can I reschedule my booking?', 
                            'a' => 'Yes, we understand that plans can change. You can reschedule your session based on availability by contacting our support team in advance.'
                        ],
                    ];
                @endphp
                @foreach($faqs as $index => $faq)
                <div class="border border-gray-200 rounded-lg bg-white overflow-hidden shadow-sm">
                    <button @click="active = active === {{ $index }} ? null : {{ $index }}" class="flex items-center justify-between w-full px-5 py-5 text-left">
                        <div class="flex items-center">
                            {{-- Icon when open --}}
                            <div x-show="active === {{ $index }}" class="flex items-center justify-center w-6 h-6 rounded bg-[#635BFF] mr-3 text-white flex-shrink-0">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4zM4 11h12v2H4v-2zM4 15h8v2H4v-2z"></path></svg>
                            </div>
                            {{-- Icon when closed --}}
                            <div x-show="active !== {{ $index }}" class="flex items-center justify-center w-6 h-6 rounded-full bg-white border-2 border-gray-400 mr-3 text-[#2D335A] flex-shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <span class="font-semibold text-[16px] text-[#3A4363]">{{ $faq['q'] }}</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 transform transition-transform duration-200" :class="{ 'rotate-180': active === {{ $index }} }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="active === {{ $index }}" x-collapse>
                        <div class="px-5 pb-6 pt-1 text-[15px] text-gray-600 ml-9 border-t border-gray-100 mt-2 pt-4">
                            {!! $faq['a'] !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Popular Help Topics --}}
        <section>
            <div class="relative flex items-center mb-6">
                <div class="flex-grow border-t border-gray-200"></div>
                <h2 class="flex-shrink-0 mx-4 text-[#2D335A] font-bold text-xl">Popular Help Topics</h2>
                <div class="flex-grow border-t border-gray-200"></div>
            </div>

            <p class="text-gray-500 mb-4 px-2 text-[15px]">If you're exploring more, here are some helpful topics:</p>
            <div class="space-y-4 px-2">
                @php
                    $topics = [
                        ['title' => 'How to start a podcast in Delhi', 'url' => route('blog.index')],
                        ['title' => 'Cost of podcast studio rental in Dwarka', 'url' => route('pages.pricing')],
                        ['title' => 'Best setup for video podcast recording', 'url' => route('pages.studio-specs')],
                        ['title' => 'Affordable studio for reels shooting in Delhi', 'url' => route('pages.videography')],
                        ['title' => 'Tips for beginner content creators', 'url' => route('blog.index')],
                    ];
                @endphp
                @foreach($topics as $topic)
                <div class="flex items-center border-b border-gray-100 pb-3 last:border-0 last:pb-0 group">
                    <svg class="w-4 h-4 text-[#635BFF] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                    <a href="{{ $topic['url'] }}" class="text-[#635BFF] font-medium text-[15px] hover:underline">{{ $topic['title'] }}</a>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Pro Tips --}}
        <section>
            <div class="relative flex items-center mb-6">
                <div class="flex-grow border-t border-gray-200"></div>
                <h2 class="flex-shrink-0 mx-4 text-[#2D335A] font-bold text-xl">Pro Tips for Creators</h2>
                <div class="flex-grow border-t border-gray-200"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                {{-- Tip 1 --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center justify-center w-8 h-8 rounded bg-[#F2F0FF] mr-3 text-[#635BFF]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="font-bold text-[#3A4363] text-[16px]">Before Your Session</h3>
                    </div>
                    <p class="text-[#555C7A] text-[14px] leading-relaxed">Plan your content in advance so you can make the most of your studio time. A clear idea helps you record faster and better.</p>
                </div>
                
                {{-- Tip 2 --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center justify-center w-8 h-8 rounded bg-[#F2F0FF] mr-3 text-[#635BFF]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="font-bold text-[#3A4363] text-[16px]">During Recording</h3>
                    </div>
                    <p class="text-[#555C7A] text-[14px] leading-relaxed">Speak naturally and maintain eye contact with the camera. This improves engagement and makes your content more relatable.</p>
                </div>

                {{-- Tip 3 --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center justify-center w-8 h-8 rounded bg-[#F2F0FF] mr-3 text-[#635BFF]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </div>
                        <h3 class="font-bold text-[#3A4363] text-[16px]">After Recording</h3>
                    </div>
                    <p class="text-[#555C7A] text-[14px] leading-relaxed">Repurpose your content into short clips, reels, and social media posts. This helps you maximize reach and grow your audience.</p>
                </div>
            </div>
        </section>

        {{-- Need More Help --}}
        <section class="text-center pt-2">
            <div class="relative flex items-center mb-6">
                <div class="flex-grow border-t border-gray-200"></div>
                <h2 class="flex-shrink-0 mx-4 text-[#2D335A] font-bold text-xl">Need More Help?</h2>
                <div class="flex-grow border-t border-gray-200"></div>
            </div>
            
            <p class="text-[#555C7A] font-medium text-[15px] mb-8 max-w-2xl mx-auto leading-relaxed">
                Still have questions about booking or services?<br>
                Our team is here to help you every step of the way. Whether you're new to content creation or a professional creator, Dywix ensures a smooth and stress-free experience.<br><br>
                Contact our support team today and start your journey with a trusted podcast studio in Delhi.
            </p>
            
            <div class="max-w-2xl mx-auto grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8 text-left">
                <div class="flex items-center p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <a href="mailto:{{ config('company.email') }}" class="text-[#3A4363] font-medium text-[15px] hover:text-[#635BFF] transition">{{ config('company.email') }}</a>
                </div>
                <div class="flex items-center p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    <a href="tel:{{ config('company.phone.raw') }}" class="text-[#3A4363] font-medium text-[15px] hover:text-[#635BFF] transition">{{ config('company.phone.intl') }}</a>
                </div>
            </div>

            <a href="{{ route('pages.contact') }}" class="inline-block px-10 py-3 bg-[#635BFF] hover:bg-[#5249ea] text-white font-semibold rounded-lg shadow-sm transition">
                Contact Support
            </a>
        </section>

    </div>
</div>
@endsection
