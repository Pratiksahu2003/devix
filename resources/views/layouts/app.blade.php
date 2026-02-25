@php
    $routeName = request()->route()?->getName();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="{{ asset('logo/fav/favicon.PNG') }}">
        @php $brand = config('company.brand'); @endphp
        <title>@yield('title', $brand)</title>

        @if (trim($__env->yieldContent('meta')))
            @yield('meta')
        @else
            <meta name="description"
                content="{{ $brand }} is a 24×7 rental photography, videography, and podcast studio in Delhi NCR with dedicated sets, makeup room, and edit space under one roof.">
        @endif
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="author" content="{{ $brand }}">
        <meta name="theme-color" content="#004aad">
        <meta name="robots" content="index,follow">

        {{-- Open Graph / Twitter cards --}}
        @php
            $pageTitle = trim($__env->yieldContent('title')) ?: $brand;
            $pageDescription = trim($__env->yieldContent('meta')) ? '' : $brand.' is a 24×7 rental photography, videography, and podcast studio in Delhi NCR with dedicated sets, makeup room, and edit space under one roof.';
            $currentUrl = url()->current();
            $ogFromPage = trim($__env->yieldContent('og_image'));
            $ogImage = $ogFromPage !== '' ? $ogFromPage : asset(config('company.logo'));
            $ogDefault = route('og.image', ['title' => $pageTitle, 'subtitle' => 'Delhi NCR • Photo · Video · Podcast']);
        @endphp
        <meta property="og:title" content="{{ $pageTitle }}">
        <meta property="og:description" content="{{ $pageDescription ?: 'Book a 24×7 podcast & content studio in Delhi NCR for photo, video and audio.' }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ $currentUrl }}">
        <meta property="og:image" content="{{ $ogImage ?: $ogDefault }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $pageTitle }}">
        <meta name="twitter:description" content="{{ $pageDescription ?: 'Book a 24×7 podcast & content studio in Delhi NCR for photo, video and audio.' }}">
        <meta name="twitter:image" content="{{ $ogImage ?: $ogDefault }}">

        {{-- E-E-A-T: Organization / LocalBusiness / Website JSON-LD --}}
        @php
            $org = [
                '@context' => 'https://schema.org',
                '@type' => 'Organization',
                'name' => $brand,
                'url' => config('app.url', url('/')),
                'logo' => $ogImage,
                'sameAs' => [
                    'https://www.instagram.com/',
                    'https://www.facebook.com/',
                ],
            ];

            $business = [
                '@context' => 'https://schema.org',
                '@type' => 'LocalBusiness',
                'name' => $brand,
                'url' => config('app.url', url('/')),
                'image' => $ogImage,
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => implode(', ', array_filter(config('company.address.lines', []))),
                    'addressLocality' => config('company.address.locality', 'Delhi NCR'),
                    'addressRegion' => config('company.address.region', 'Delhi'),
                    'postalCode' => config('company.address.postal_code', ''),
                    'addressCountry' => config('company.address.country', 'IN'),
                ],
                'openingHoursSpecification' => [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'],
                    'opens' => '00:00',
                    'closes' => '23:59',
                ],
                'areaServed' => 'Delhi NCR',
                'priceRange' => '₹₹',
                'telephone' => config('company.phone.intl', '+91-0000000000'),
                'email' => config('company.email'),
                'parentOrganization' => [
                    '@type' => 'Organization',
                    'name' => config('company.name'),
                ],
            ];

            $website = [
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => $brand,
                'url' => config('app.url', url('/')),
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => config('app.url', url('/')) . '/search?q={query}',
                    'query-input' => 'required name=query',
                ],
            ];
        @endphp
        <script type="application/ld+json">{!! json_encode($org, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
        <script type="application/ld+json">{!! json_encode($business, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
        <script type="application/ld+json">{!! json_encode($website, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>

        {{-- Breadcrumbs JSON-LD --}}
        @php
            $breadcrumbsMap = [
                'home' => ['label' => 'Home', 'url' => route('home')],
                'pages.photography' => ['label' => 'Photography Studio', 'url' => route('pages.photography')],
                'pages.videography' => ['label' => 'Videography Studio', 'url' => route('pages.videography')],
                'pages.podcast' => ['label' => 'Podcast Studio', 'url' => route('pages.podcast')],
                'pages.edit-room' => ['label' => 'Edit Room', 'url' => route('pages.edit-room')],
                'pages.services' => ['label' => 'Services', 'url' => route('pages.services')],
                'pages.pricing' => ['label' => 'Pricing', 'url' => route('pages.pricing')],
                'pages.about' => ['label' => 'About', 'url' => route('pages.about')],
                'pages.contact' => ['label' => 'Contact', 'url' => route('pages.contact')],
            ];

            $trail = [];
            if ($routeName && isset($breadcrumbsMap[$routeName]) && $routeName !== 'home') {
                $trail[] = ['name' => 'Home', 'item' => route('home')];
                $trail[] = ['name' => $breadcrumbsMap[$routeName]['label'], 'item' => $breadcrumbsMap[$routeName]['url']];
            }
            if (! empty($trail)) {
                $breadcrumbLd = [
                    '@context' => 'https://schema.org',
                    '@type' => 'BreadcrumbList',
                    'itemListElement' => collect($trail)->values()->map(function ($t, $idx) {
                        return [
                            '@type' => 'ListItem',
                            'position' => $idx + 1,
                            'name' => $t['name'],
                            'item' => $t['item'],
                        ];
                    })->toArray(),
                ];
            }
        @endphp
        @isset($breadcrumbLd)
            <script type="application/ld+json">{!! json_encode($breadcrumbLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
        @endisset

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen flex flex-col bg-[var(--color-surface)] text-[var(--color-text-main)]">
        <div class="flex-1 flex flex-col">
            <x-layout.navbar />

            {{-- Main content --}}
            <main class="flex-1">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="border-t border-white/10 bg-black text-gray-400">
                <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
                    <div class="grid gap-12 text-sm sm:grid-cols-2 md:grid-cols-4">
                        <div class="space-y-6">
                            <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-white">
                                Customer Service
                            </h3>
                            <ul class="space-y-3 text-[13px]">
                                <li>
                                    <a href="tel:{{ config('company.phone.raw') }}" class="hover:text-white transition-colors">
                                        {{ config('company.phone.intl') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:{{ config('company.email') }}" class="hover:text-white transition-colors">
                                        {{ config('company.email') }}
                                    </a>
                                </li>
                                <li class="leading-relaxed">
                                    {{ implode(', ', array_filter(config('company.address.lines', []))) }}
                                </li>
                                <li>
                                    {{ config('company.address.landmark') }}
                                </li>
                                <li><a href="{{ route('pages.help') }}" class="hover:text-white transition-colors">Help &amp; FAQs</a></li>
                                <li><a href="{{ route('pages.pricing') }}" class="hover:text-white transition-colors">Studio rates</a></li>
                                <li><a href="{{ route('pages.booking') }}" class="hover:text-white transition-colors">Make a booking</a></li>
                                <li><a href="{{ route('pages.location') }}" class="hover:text-white transition-colors">Location &amp; access</a></li>
                            </ul>
                        </div>

                        <div class="space-y-6">
                            <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-white">
                                Quick Links
                            </h3>
                            <ul class="space-y-3 text-[13px]">
                                <li><a href="{{ route('pages.services') }}" class="hover:text-white transition-colors">Our services</a></li>
                                <li><a href="{{ route('pages.pricing') }}" class="hover:text-white transition-colors">Pricing plans</a></li>
                                <li><a href="{{ route('pages.about') }}" class="hover:text-white transition-colors">About studio</a></li>
                                <li><a href="{{ route('pages.contact') }}" class="hover:text-white transition-colors">Contact us</a></li>
                                <li><a href="{{ route('pages.gallery') }}" class="hover:text-white transition-colors">Gallery</a></li>
                            </ul>
                        </div>

                        <div class="space-y-6">
                            <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-white">
                                About
                            </h3>
                            <ul class="space-y-3 text-[13px]">
                                <li><a href="{{ route('pages.about') }}" class="hover:text-white transition-colors">Who we are</a></li>
                                <li><a href="{{ route('pages.studio-specs') }}" class="hover:text-white transition-colors">Studio specs</a></li>
                                <li><a href="{{ route('pages.use-cases') }}" class="hover:text-white transition-colors">Use cases</a></li>
                                <li><a href="{{ route('pages.collaborations') }}" class="hover:text-white transition-colors">Collaborations</a></li>
                            </ul>
                        </div>

                        <div class="space-y-6">
                            <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-white">
                                Stay in frame
                            </h3>
                            <p class="text-[13px] leading-relaxed">
                                Be the first to know about new sets, equipment upgrades, and studio offers.
                            </p>
                            <form class="mt-2 flex gap-2">
                                <input
                                    type="email"
                                    class="h-10 flex-1 rounded-lg border border-white/20 bg-white/5 px-4 text-xs text-white placeholder-gray-500 focus:border-[var(--color-brand-lens-blue)] focus:outline-none focus:ring-1 focus:ring-[var(--color-brand-lens-blue)]"
                                    placeholder="Email address"
                                >
                                <button
                                    type="submit"
                                    class="inline-flex h-10 items-center rounded-lg bg-[var(--color-brand-lens-blue)] px-4 text-xs font-bold text-white transition hover:bg-blue-600"
                                >
                                    Join
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="mt-16 flex flex-col gap-4 border-t border-white/10 pt-8 text-[11px] text-gray-600 sm:flex-row sm:items-center sm:justify-between">
                        <p>© {{ date('Y') }} DyWix.Com & Studio space powered by Suganta International. All rights reserved.</p>
                        <div class="flex flex-wrap items-center gap-6">
                            <a href="{{ route('pages.privacy') }}" class="hover:text-white transition-colors">Privacy</a>
                            <a href="{{ route('pages.terms') }}" class="hover:text-white transition-colors">Terms</a>
                            <a href="{{ route('pages.accessibility') }}" class="hover:text-white transition-colors">Accessibility</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
