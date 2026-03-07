@extends('layouts.app')

@section('title', 'Help & frequently Asked Questions | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Frequently asked questions about {{ config('company.brand') }}. Booking policies, equipment details, studio rules, and amenities." />
@endsection

@section('content')
    {{-- Hero --}}
    <section class="bg-[var(--color-surface)] py-16 lg:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-4xl px-4 text-center">
            <h1 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">
                Help Center – {{ config('company.short_name') }}
            </h1>
            <p class="mt-2 text-sm font-medium text-[var(--color-text-muted)]">
                Last updated: March 2026
            </p>
            <p class="mt-4 text-lg text-[var(--color-text-muted)]">
                Everything you need to know about shooting at {{ config('company.brand') }}.
            </p>
         
        </div>
    </section>

    {{-- Welcome & About --}}
    <section class="py-12 lg:py-16 border-b border-[var(--color-border-subtle)] bg-white">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <p class="text-[var(--color-text-muted)] leading-relaxed">
                Welcome to the {{ config('company.brand') }} Help Center. This page helps you quickly find answers about our services, studio bookings, equipment usage, and platform support.
            </p>
            <p class="mt-4 text-[var(--color-text-muted)] leading-relaxed">
                At {{ config('company.short_name') }}, our mission is to provide creators, brands, photographers, and influencers with a professional and accessible content creation environment. Whether you are planning a <strong class="text-[var(--color-text-main)]">podcast recording, photography session, video shoot, influencer collaboration, or brand campaign</strong>, this help page will guide you through the most important information.
            </p>
            <p class="mt-4 text-[var(--color-text-muted)]">
                If you cannot find what you need, our support team is always ready to assist you.
            </p>

            <h2 class="mt-10 text-xl font-bold text-[var(--color-text-main)]">About {{ config('company.short_name') }}</h2>
            <p class="mt-3 text-[var(--color-text-muted)] leading-relaxed">
                {{ config('company.short_name') }} is a digital platform and creative studio initiative operated by {{ config('company.name') }}, designed to support modern content creators, businesses, and professionals looking for high-quality production facilities.
            </p>
            <p class="mt-3 text-[var(--color-text-muted)]">Our services include:</p>
            <ul class="mt-2 list-disc list-inside space-y-1 text-[var(--color-text-muted)]">
                <li>Photography studio rental</li>
                <li>Podcast studio setup</li>
                <li>Professional video shoots</li>
                <li>Personal branding photography</li>
                <li>Influencer collaboration opportunities</li>
                <li>Creative production support</li>
            </ul>
            <p class="mt-4 text-[var(--color-text-muted)] leading-relaxed">
                The {{ config('company.short_name') }} platform allows you to explore services, understand studio capabilities, and connect with a professional environment designed for modern content creation.
            </p>

            <h2 class="mt-10 text-xl font-bold text-[var(--color-text-main)]">How Can We Help You?</h2>
            <p class="mt-3 text-[var(--color-text-muted)]">
                Below are the most common areas where users need assistance when using {{ config('company.short_name') }}.
            </p>
            <div class="mt-6 space-y-6">
                <div class="rounded-xl border border-[var(--color-border-subtle)] p-5 bg-[var(--color-surface)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">1. Studio Booking Assistance</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">If you are planning to book the {{ config('company.short_name') }} studio, you may have questions about availability, pricing, or booking procedures. Our studio can be used for photography sessions, podcast recordings, product shoots, influencer content creation, brand advertisement videos, and personal branding shoots. Before your booking, review the studio features and confirm your preferred schedule. Our team can guide you through the process and answer questions about availability.</p>
                </div>
                <div class="rounded-xl border border-[var(--color-border-subtle)] p-5 bg-[var(--color-surface)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">2. Equipment and Studio Facilities</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">{{ config('company.short_name') }} studio is designed to support creators with a professional production environment. Depending on your booking plan, the studio may include basic lighting setup, studio backgrounds, grip equipment, professional podcast setup, and a recording environment for content creation. Additional equipment or customized setups may be available—discuss your production needs with our team in advance for the best setup.</p>
                </div>
                <div class="rounded-xl border border-[var(--color-border-subtle)] p-5 bg-[var(--color-surface)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">3. Preparing for Your Studio Session</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">We recommend: <strong class="text-[var(--color-text-main)]">Plan your shoot in advance</strong>—define your concept, script, or visual idea before arriving. <strong class="text-[var(--color-text-main)]">Bring required props or products</strong>—if your shoot involves brand products or personal items, have them ready. <strong class="text-[var(--color-text-main)]">Coordinate with your team</strong>—if multiple people are involved, make sure everyone knows the schedule. <strong class="text-[var(--color-text-main)]">Arrive on time</strong>—timely arrival helps your session run smoothly. Proper preparation helps you make the most of your studio booking.</p>
                </div>
                <div class="rounded-xl border border-[var(--color-border-subtle)] p-5 bg-[var(--color-surface)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">4. Influencer and Creator Support</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">{{ config('company.short_name') }} aims to support creators building their presence in the digital space. Our platform encourages collaboration between influencers, brands, content creators, photographers, and videographers. If you are a creator looking to produce high-quality content or collaborate with professionals, {{ config('company.short_name') }} provides a creative environment to bring your ideas to life.</p>
                </div>
                <div class="rounded-xl border border-[var(--color-border-subtle)] p-5 bg-[var(--color-surface)]">
                    <h3 class="font-semibold text-[var(--color-text-main)]">5. Payments and Service Queries</h3>
                    <p class="mt-2 text-sm text-[var(--color-text-muted)]">For questions about pricing, service packages, or booking confirmation, our support team can assist. Payment structures may vary depending on studio duration, equipment requirements, production complexity, and additional services requested. We recommend confirming details with our team before your scheduled session for a smooth experience.</p>
                </div>
            </div>
        </div>
    </section>

    @php
        $faqCategories = [
            'About ' . config('company.short_name') => [
                ['q' => 'What is ' . config('company.short_name') . '?', 'a' => config('company.short_name') . ' is a creative studio platform operated by ' . config('company.name') . ' that offers professional spaces and services for photography, podcasting, and video production.'],
                ['q' => 'Who can use the ' . config('company.short_name') . ' studio?', 'a' => 'The ' . config('company.short_name') . ' studio is designed for content creators, influencers, businesses, photographers, podcasters, and individuals looking for professional content production.'],
                ['q' => 'Do I need professional experience to book the studio?', 'a' => 'No. Both beginners and professionals can use the ' . config('company.short_name') . ' studio. Our environment is designed to support creators at every level.'],
                ['q' => 'What type of shoots can be done at ' . config('company.short_name') . '?', 'a' => config('company.short_name') . ' studio can be used for photography sessions, podcast recordings, product shoots, personal branding shoots, and digital content creation.'],
                ['q' => 'How can I contact the ' . config('company.short_name') . ' support team?', 'a' => 'You can reach our team through the contact information on our website, or call ' . config('company.phone.intl') . ' or email ' . config('company.email') . '.'],
            ],
            'Booking & Rates' => [
                ['q' => 'What is the minimum booking time?', 'a' => 'Our minimum booking duration is 3 hours. This ensures you have enough time for load-in, setup, shooting, and load-out without rushing.'],
                ['q' => 'How do I confirm a booking?', 'a' => 'A booking is confirmed only after we receive a 50% advance payment. Tentative holds are valid for 24 hours.'],
                ['q' => 'Can I extend my slot on the day?', 'a' => 'Yes, extensions are possible subject to availability. Extra hours are charged at the standard hourly rate.'],
                ['q' => 'Do you offer student discounts?', 'a' => 'Yes! We support emerging talent. Students with a valid ID get a 10% discount on weekday bookings.'],
            ],
            'Studio Facilities' => [
                ['q' => 'Is there a makeup room?', 'a' => 'Absolutely. We have a dedicated makeup and styling area with Hollywood mirrors, garment steamers, and private changing space.'],
                ['q' => 'Is the studio soundproof?', 'a' => 'Our podcast corner is acoustically treated for clean audio. The main floor is quiet but not fully soundproof (not a sound stage), though it works great for interviews and dialogue.'],
                ['q' => 'Is there parking available?', 'a' => 'Yes, there is ample street parking around the building. You can pull up to the entrance for easy loading and unloading.'],
                ['q' => 'Do you have Wi-Fi?', 'a' => 'Yes, we have a high-speed 1Gbps fiber connection, perfect for tethering and live streaming.'],
            ],
            'Equipment' => [
                ['q' => 'What lighting gear is included?', 'a' => 'Every booking includes our core lighting package: 3x Godox strobes/continuous lights, softboxes, stands, and basic grip. See our Studio Specs page for the full list.'],
                ['q' => 'Can I bring my own equipment?', 'a' => 'Of course. You are welcome to bring your own cameras, lenses, and specialized lights. There is no corkage fee for bringing your own gear.'],
                ['q' => 'Do you rent cameras?', 'a' => 'We have Sony A7IV and FX3 bodies available for rent. Please request these when making your booking.'],
            ],
            'Rules & Policies' => [
                ['q' => 'What is your cancellation policy?', 'a' => 'Cancellations made 48 hours prior receive a full refund. Cancellations within 24-48 hours incur a 50% fee. Less than 24 hours is non-refundable.'],
                ['q' => 'Can we bring food and drinks?', 'a' => 'Light snacks and drinks are allowed in the lounge area. Please avoid eating on the cyclorama or near equipment.'],
                ['q' => 'Is smoking allowed?', 'a' => 'Smoking is strictly prohibited inside the studio premises to protect our gear and safety.'],
            ]
        ];

        // Flatten for JSON-LD
        $allfrequently Asked Questions = [];
        foreach ($faqCategories as $cat => $qs) {
            foreach ($qs as $item) {
                $allfrequently Asked Questions[] = $item;
            }
        }
        
        $faqLd = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($allfrequently Asked Questions)->map(function ($item) {
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
    @endphp

    {{-- FAQ Accordions --}}
    <section class="py-16 lg:py-24 bg-white" x-data="{ activeGroup: 'About {{ addslashes(config('company.short_name')) }}', filter: '' }" @search-faq.window="filter = $event.detail.toLowerCase()">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-12">
                {{-- Sidebar Navigation --}}
                <div class="lg:col-span-3 mb-8 lg:mb-0">
                    <nav class="space-y-1 sticky top-24">
                        @foreach ($faqCategories as $category => $items)
                            <button
                                @click="activeGroup = '{{ $category }}'; filter = ''"
                                class="w-full text-left px-4 py-3 rounded-xl text-sm font-medium transition-colors"
                                :class="activeGroup === '{{ $category }}' && !filter ? 'bg-[var(--color-brand-lens-blue)] text-white shadow-md' : 'text-[var(--color-text-muted)] hover:bg-gray-50'"
                            >
                                {{ $category }}
                            </button>
                        @endforeach
                    </nav>
                </div>

                {{-- Content Area --}}
                <div class="lg:col-span-9 space-y-8">
                    @foreach ($faqCategories as $category => $items)
                        <div x-show="!filter && activeGroup === '{{ $category }}'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            <h2 class="text-2xl font-bold text-[var(--color-text-main)] mb-6">{{ $category }}</h2>
                            <div class="space-y-4">
                                @foreach ($items as $index => $item)
                                    <div x-data="{ expanded: false }" class="rounded-2xl border border-[var(--color-border-subtle)] bg-white overflow-hidden">
                                        <button @click="expanded = !expanded" class="flex w-full items-center justify-between px-6 py-4 text-left">
                                            <span class="font-medium text-[var(--color-text-main)]">{{ $item['q'] }}</span>
                                            <span class="ml-6 flex h-7 w-7 items-center justify-center rounded-full bg-gray-50 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': expanded }">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                            </span>
                                        </button>
                                        <div x-show="expanded" x-collapse>
                                            <div class="px-6 pb-4 pt-0 text-sm text-[var(--color-text-muted)] leading-relaxed">
                                                {{ $item['a'] }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    {{-- Search Results --}}
                    <div x-show="filter" x-cloak>
                        <h2 class="text-xl font-bold text-[var(--color-text-main)] mb-6">Search Results</h2>
                        <div class="space-y-4">
                            @foreach ($allfrequently Asked Questions as $item)
                                <div 
                                    x-show="'{{ strtolower($item['q']) }}'.includes(filter) || '{{ strtolower($item['a']) }}'.includes(filter)"
                                    class="rounded-2xl border border-[var(--color-border-subtle)] bg-white overflow-hidden"
                                >
                                    <div class="px-6 py-4">
                                        <p class="font-medium text-[var(--color-text-main)]">{{ $item['q'] }}</p>
                                        <p class="mt-2 text-sm text-[var(--color-text-muted)]">{{ $item['a'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div x-show="$el.parentElement.children.length === 0" class="text-center py-12 text-gray-500">
                                No questions found matching your search.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Commitment to Creators --}}
    <section class="py-12 lg:py-16 border-b border-[var(--color-border-subtle)] bg-white">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-bold text-[var(--color-text-main)]">Our Commitment to Creators</h2>
            <p class="mt-4 text-[var(--color-text-muted)] leading-relaxed">
                At {{ config('company.short_name') }}, we believe that every creator deserves access to a professional environment where ideas can turn into impactful content. We continuously work to improve our services, studio infrastructure, and digital platform so that creators, brands, and professionals can produce content with confidence and ease.
            </p>
            <p class="mt-4 text-[var(--color-text-muted)]">
                Whether you are recording your first podcast or producing a full brand campaign, {{ config('company.short_name') }} aims to be a space where creativity and professionalism come together.
            </p>
            <p class="mt-8 font-semibold text-[var(--color-text-main)]">Thank you for choosing {{ config('company.short_name') }}.</p>
        </div>
    </section>

    {{-- Still need help? / Contact Support --}}
    <section class="bg-[var(--color-surface-muted)] py-16 text-center">
        <div class="mx-auto max-w-3xl px-4">
            <h2 class="text-2xl font-bold text-[var(--color-text-main)]">Contact Support</h2>
            <p class="mt-4 text-[var(--color-text-muted)]">
                If your question is not answered on this page, our support team will be happy to assist you.
            </p>
            <p class="mt-4 text-[var(--color-text-muted)] font-medium">
                {{ config('company.short_name') }} Studio – {{ config('company.address.locality') }}
            </p>
            <p class="mt-2 text-[var(--color-text-muted)]">
                Phone: <a href="tel:{{ config('company.phone.raw') }}" class="text-[var(--color-brand-lens-blue)] hover:underline">{{ config('company.phone.intl') }}</a><br>
                Email: <a href="mailto:{{ config('company.email') }}" class="text-[var(--color-brand-lens-blue)] hover:underline">{{ config('company.email') }}</a>
            </p>
            <p class="mt-4 text-sm text-[var(--color-text-muted)]">
                Our team strives to respond to inquiries as quickly as possible and help ensure a smooth experience for every creator using the {{ config('company.short_name') }} platform.
            </p>
            <div class="mt-8">
                <a href="{{ route('pages.contact') }}" class="inline-flex items-center rounded-full bg-[var(--color-brand-lens-blue)] px-6 py-3 text-sm font-bold text-white shadow-md hover:bg-blue-700 transition">
                    Contact Support
                </a>
            </div>
        </div>
    </section>

    <script type="application/ld+json">{!! json_encode($faqLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection
