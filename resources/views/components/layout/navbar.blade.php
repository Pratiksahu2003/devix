<div x-data="{ mobileOpen: false, activeMega: null }">
    <header
        class="sticky top-0 z-40 border-b border-gray-100 bg-white/90 backdrop-blur-xl transition-all duration-300"
        x-data="{ scrolled: false }"
        @scroll.window="scrolled = (window.pageYOffset > 10)"
        :class="{ 'shadow-sm': scrolled }"
    >
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between gap-4">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 transition hover:opacity-80">
                    <img src="{{ asset(config('company.logo')) }}" alt="{{ config('company.brand') }}" class="h-16 w-auto object-contain" />
                </a>

                {{-- Desktop Nav --}}
                <nav class="hidden md:flex items-center gap-1">
                    @php
                        $navItems = [
                            [
                                'label' => 'Photography',
                                'key' => 'photography',
                                'route' => 'pages.photography',
                            ],
                            [
                                'label' => 'Videography',
                                'key' => 'videography',
                                'route' => 'pages.videography',
                            ],
                            [
                                'label' => 'Podcast',
                                'key' => 'podcast',
                                'route' => 'pages.podcast',
                            ],
                            [
                                'label' => 'Edit Room',
                                'key' => 'edit-room',
                                'route' => 'pages.edit-room',
                            ],
                            [
                                'label' => 'Services',
                                'key' => 'services',
                                'route' => 'pages.services',
                            ],
                        ];
                    @endphp

                    @foreach ($navItems as $item)
                        <div
                            x-data
                            @mouseenter="activeMega = '{{ $item['key'] }}'"
                            @mouseleave="activeMega = (activeMega === '{{ $item['key'] }}' ? null : activeMega)"
                            class="relative"
                        >
                            <a
                                href="{{ route($item['route']) }}"
                                class="relative inline-flex items-center rounded-full px-4 py-2 text-sm font-medium text-gray-600 transition-all hover:bg-gray-100 hover:text-black"
                                :class="activeMega === '{{ $item['key'] }}' ? 'bg-gray-100 text-black' : ''"
                            >
                                {{ $item['label'] }}
                            </a>

                            {{-- Mega Menu Dropdown --}}
                            @if(in_array($item['key'], ['photography', 'videography', 'podcast', 'edit-room']))
                            <div
                                x-cloak
                                x-show="activeMega === '{{ $item['key'] }}'"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-2"
                                class="absolute left-1/2 top-full mt-2 w-[600px] -translate-x-1/2 pt-2"
                            >
                                <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white p-1 shadow-xl ring-1 ring-black/5">
                                    <div class="grid grid-cols-12 gap-1">
                                        {{-- Main Links --}}
                                        <div class="col-span-7 space-y-1 p-3">
                                            <p class="mb-2 px-2 text-[10px] uppercase tracking-wider text-gray-400 font-bold">
                                                Quick Access
                                            </p>
                                            <a href="{{ route('pages.photography') }}" class="group flex items-center gap-3 rounded-xl p-2 transition hover:bg-gray-50">
                                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-600 group-hover:bg-blue-50 group-hover:text-blue-600 transition-colors">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                                </div>
                                                <div>
                                                    <p class="text-xs font-bold text-gray-900">Photography</p>
                                                    <p class="text-[10px] text-gray-500">Professional flash &amp; strobes</p>
                                                </div>
                                            </a>
                                            <a href="{{ route('pages.videography') }}" class="group flex items-center gap-3 rounded-xl p-2 transition hover:bg-gray-50">
                                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-600 group-hover:bg-blue-50 group-hover:text-blue-600 transition-colors">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                                                </div>
                                                <div>
                                                    <p class="text-xs font-bold text-gray-900">Videography</p>
                                                    <p class="text-[10px] text-gray-500">Continuous lighting setup</p>
                                                </div>
                                            </a>
                                            <a href="{{ route('pages.podcast') }}" class="group flex items-center gap-3 rounded-xl p-2 transition hover:bg-gray-50">
                                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-600 group-hover:bg-blue-50 group-hover:text-blue-600 transition-colors">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" /></svg>
                                                </div>
                                                <div>
                                                    <p class="text-xs font-bold text-gray-900">Podcast</p>
                                                    <p class="text-[10px] text-gray-500">Audio &amp; video recording</p>
                                                </div>
                                            </a>
                                        </div>

                                        {{-- Featured / CTA --}}
                                        <div class="col-span-5 flex flex-col justify-between rounded-xl bg-gray-50 p-4 border border-gray-100">
                                            <div>
                                                <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Featured</p>
                                                <p class="mt-1 text-xs font-medium leading-relaxed text-gray-600">
                                                    Need a custom setup for a large production?
                                                </p>
                                            </div>
                                            <a href="{{ route('pages.contact') }}" class="mt-3 inline-flex w-full items-center justify-center rounded-lg bg-white px-3 py-2 text-xs font-bold text-black shadow-sm ring-1 ring-gray-200 transition hover:bg-gray-50">
                                                Contact Team
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    @endforeach
                </nav>

                {{-- Right Actions --}}
                <div class="flex items-center gap-2">
                    <a
                        href="{{ route('pages.pricing') }}"
                        class="hidden rounded-full px-4 py-2 text-sm font-medium text-gray-600 transition hover:text-black sm:block"
                    >
                        Pricing
                    </a>

                    <a
                        href="{{ route('pages.contact') }}"
                        class="inline-flex items-center rounded-full bg-black px-5 py-2 text-sm font-bold text-white shadow-lg transition-transform hover:scale-105 hover:bg-gray-800 active:scale-95"
                    >
                        Book Now
                    </a>

                    {{-- Mobile Menu Toggle --}}
                    <button
                        type="button"
                        class="ml-1 inline-flex h-9 w-9 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 transition hover:bg-gray-50 hover:text-black md:hidden"
                        @click="mobileOpen = !mobileOpen"
                        aria-label="Toggle navigation"
                    >
                        <span class="block h-3.5 w-4 overflow-hidden relative">
                            <span class="absolute block h-0.5 w-full bg-current transition-all duration-300" :class="mobileOpen ? 'top-1.5 rotate-45' : 'top-0'"></span>
                            <span class="absolute block h-0.5 w-full bg-current transition-all duration-300 top-1.5" :class="mobileOpen ? 'opacity-0' : 'opacity-100'"></span>
                            <span class="absolute block h-0.5 w-full bg-current transition-all duration-300" :class="mobileOpen ? 'top-1.5 -rotate-45' : 'top-3'"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    {{-- Mobile Menu --}}
    <div
        x-cloak
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="fixed inset-x-0 top-16 z-30 border-b border-gray-100 bg-white shadow-xl md:hidden"
    >
        <div class="mx-auto max-w-7xl px-4 py-4 space-y-1">
            @foreach ([
                ['label' => 'Home', 'route' => 'home'],
                ['label' => 'Photography', 'route' => 'pages.photography'],
                ['label' => 'Videography', 'route' => 'pages.videography'],
                ['label' => 'Podcast', 'route' => 'pages.podcast'],
                ['label' => 'Edit Room', 'route' => 'pages.edit-room'],
                ['label' => 'Services', 'route' => 'pages.services'],
                ['label' => 'Pricing', 'route' => 'pages.pricing'],
                ['label' => 'About', 'route' => 'pages.about'],
                ['label' => 'Contact', 'route' => 'pages.contact'],
            ] as $link)
                <a
                    href="{{ route($link['route']) }}"
                    class="block rounded-lg px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-black transition-colors"
                    @click="mobileOpen = false"
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</div>