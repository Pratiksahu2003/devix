<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('logo/fav/favicon.PNG') }}">

    <title>{{ $meta['title'] ?? config('dywix.brand_name') }}</title>
    <meta name="description" content="{{ $meta['description'] ?? '' }}">
    <meta name="robots" content="{{ $meta['robots'] ?? 'index, follow' }}">
    <link rel="canonical" href="{{ $meta['canonical'] ?? url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $meta['title'] ?? config('dywix.brand_name') }}">
    <meta property="og:description" content="{{ $meta['description'] ?? '' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $meta['canonical'] ?? url()->current() }}">
    <meta property="og:image" content="{{ $meta['og_image'] ?? asset(config('dywix.default_image')) }}">
    <meta property="og:image:alt" content="{{ $meta['title'] ?? config('dywix.brand_name') }}">
    <meta property="og:site_name" content="{{ config('dywix.brand_name') }}">
    <meta property="og:locale" content="en_IN">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $meta['title'] ?? config('dywix.brand_name') }}">
    <meta name="twitter:description" content="{{ $meta['description'] ?? '' }}">
    <meta name="twitter:image" content="{{ $meta['og_image'] ?? asset(config('dywix.default_image')) }}">
    <meta name="twitter:site" content="@{{ config('seo.defaults.twitter_handle', 'dywixstudio') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Cinzel:wght@400;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    </noscript>

    <!-- Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Schema -->
    @if(isset($schema))
        @include('seo.components.schema', ['schema' => $schema])
    @endif
</head>

<body class="min-h-screen flex flex-col bg-surface text-text-main font-sans">
    <div class="flex-1 flex flex-col">
        <x-layout.navbar />

        <!-- Main content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <x-layout.footer />
    </div>
</body>

</html>
