@php
    $routeName = request()->route()?->getName();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <x-layout.footer />
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('newsletter-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const emailInput = form.querySelector('input[type="email"]');
                    const email = emailInput.value;
                    const button = form.querySelector('button');
                    const originalText = button.innerText;
                    
                    button.disabled = true;
                    button.innerText = 'Joining...';

                    axios.post('{{ route("subscribe.store") }}', {
                        email: email
                    })
                    .then(function (response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.data.message,
                            icon: 'success',
                            confirmButtonText: 'Great!',
                            confirmButtonColor: '#004aad'
                        });
                        emailInput.value = '';
                    })
                    .catch(function (error) {
                        let message = 'Something went wrong. Please try again.';
                        if (error.response && error.response.data && error.response.data.message) {
                            message = error.response.data.message;
                        }
                        
                        Swal.fire({
                            title: 'Error!',
                            text: message,
                            icon: 'error',
                            confirmButtonText: 'Okay',
                            confirmButtonColor: '#004aad'
                        });
                    })
                    .finally(function() {
                        button.disabled = false;
                        button.innerText = originalText;
                    });
                });
            }
        });
    </script>
</html>
