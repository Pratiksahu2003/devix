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
    <meta name="theme-color" content="#004aad">

    @hasSection('seo_head')
        @yield('seo_head')
    @elseif (trim($__env->yieldContent('meta')))
        @php
        $pageTitle = trim($__env->yieldContent('title')) ?: $brand;
        $metaContent = trim($__env->yieldContent('meta'));
        $parsedMeta = seo_parse_meta_content($metaContent);
        $metaDescription = $parsedMeta['description'] ?: config('seo.defaults.site_description');
        $metaRobots = $parsedMeta['robots'];
        $currentUrl = url()->current();
        $ogFromPage = trim($__env->yieldContent('og_image'));
        $ogImage = $ogFromPage !== '' ? $ogFromPage : asset(config('company.logo'));
        $ogDefault = route('og.image', ['title' => $pageTitle, 'subtitle' => 'Delhi NCR • Photo · Video · Podcast']);
        $resolvedOgImage = $ogImage ?: $ogDefault;
        @endphp
        @yield('meta')
        <link rel="canonical" href="{{ $currentUrl }}">
        <link rel="alternate" hreflang="en-in" href="{{ $currentUrl }}">
        <meta name="author" content="{{ $brand }}">
        <meta name="publisher" content="{{ config('company.name') }}">
        @if (! str_contains($metaContent, 'name="robots"') && ! str_contains($metaContent, "name='robots'"))
            <meta name="robots" content="{{ $metaRobots }}">
        @endif
        @if (! str_contains($metaContent, 'name="description"') && ! str_contains($metaContent, "name='description'"))
            <meta name="description" content="{{ $metaDescription }}">
        @endif
        <meta property="og:title" content="{{ $pageTitle }}">
        <meta property="og:description" content="{{ $metaDescription }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ $currentUrl }}">
        <meta property="og:image" content="{{ $resolvedOgImage }}">
        <meta property="og:image:alt" content="{{ $pageTitle }}">
        <meta property="og:site_name" content="{{ $brand }}">
        <meta property="og:locale" content="en_IN">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $pageTitle }}">
        <meta name="twitter:description" content="{{ $metaDescription }}">
        <meta name="twitter:image" content="{{ $resolvedOgImage }}">
        <meta name="twitter:site" content="@{{ config('seo.defaults.twitter_handle', 'dywixstudio') }}">
    @else
        <meta name="description" content="{{ $brand }} is a 24×7 rental photography, videography, and podcast studio in Delhi NCR with dedicated sets, makeup room, and edit space under one roof.">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="author" content="{{ $brand }}">
        <meta name="robots" content="index,follow">
        @php
        $pageTitle = $brand;
        $currentUrl = url()->current();
        $ogDefault = route('og.image', ['title' => $pageTitle, 'subtitle' => 'Delhi NCR • Photo · Video · Podcast']);
        @endphp
        <meta property="og:title" content="{{ $pageTitle }}">
        <meta property="og:description" content="Book a 24×7 podcast & content studio in Delhi NCR for photo, video and audio.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ $currentUrl }}">
        <meta property="og:image" content="{{ $ogDefault }}">
        <meta property="og:image:alt" content="{{ $pageTitle }}">
        <meta property="og:site_name" content="{{ $brand }}">
        <meta property="og:locale" content="en_IN">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $pageTitle }}">
        <meta name="twitter:description" content="Book a 24×7 podcast & content studio in Delhi NCR for photo, video and audio.">
        <meta name="twitter:image" content="{{ $ogDefault }}">
        <meta name="twitter:site" content="@{{ config('seo.defaults.twitter_handle', 'dywixstudio') }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Cinzel:wght@400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17989742944"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-17989742944');
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5147720230554161"
     crossorigin="anonymous"></script>
</head>

<body class="min-h-screen flex flex-col bg-surface text-text-main">
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
                    .then(function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.data.message,
                            icon: 'success',
                            confirmButtonText: 'Great!',
                            confirmButtonColor: '#004aad'
                        });
                        emailInput.value = '';
                    })
                    .catch(function(error) {
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