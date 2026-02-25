@extends('layouts.app')

@section('title', 'Help & FAQs | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Frequently asked questions about {{ config('company.brand') }}. Booking policies, equipment details, studio rules, and amenities." />
@endsection

@section('content')
    {{-- Hero --}}
    <section class="bg-[var(--color-surface)] py-16 lg:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-4xl px-4 text-center">
            <h1 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">
                How can we help?
            </h1>
            <p class="mt-4 text-lg text-[var(--color-text-muted)]">
                Everything you need to know about shooting at {{ config('company.brand') }}.
            </p>
            
            {{-- Search Bar (Functional with Alpine) --}}
            <div class="mx-auto mt-8 max-w-xl" x-data="{ query: '' }">
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        x-model="query"
                        @input="$dispatch('search-faq', query)"
                        class="block w-full rounded-full border-0 py-4 pl-12 pr-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[var(--color-brand-lens-blue)] sm:text-sm sm:leading-6" 
                        placeholder="Search for keywords like 'parking', 'wifi', or 'cancel'..."
                    >
                </div>
            </div>
        </div>
    </section>

    @php
        $faqCategories = [
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
        $allFaqs = [];
        foreach ($faqCategories as $cat => $qs) {
            foreach ($qs as $item) {
                $allFaqs[] = $item;
            }
        }
        
        $faqLd = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($allFaqs)->map(function ($item) {
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
    <section class="py-16 lg:py-24 bg-white" x-data="{ activeGroup: 'Booking & Rates', filter: '' }" @search-faq.window="filter = $event.detail.toLowerCase()">
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
                            @foreach ($allFaqs as $item)
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

    {{-- Still need help? --}}
    <section class="bg-[var(--color-surface-muted)] py-16 text-center">
        <div class="mx-auto max-w-3xl px-4">
            <h2 class="text-2xl font-bold text-[var(--color-text-main)]">Still have questions?</h2>
            <p class="mt-4 text-[var(--color-text-muted)]">
                Can't find the answer you're looking for? Chat with our team directly.
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
