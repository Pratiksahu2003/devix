@props(['meta' => []])

@if(!empty($meta))
    <meta name="description" content="{{ $meta['description'] }}" />
    @if(!empty($meta['keywords']))
        <meta name="keywords" content="{{ $meta['keywords'] }}" />
    @endif
    <meta name="author" content="{{ $meta['author'] ?? config('company.brand') }}" />
    <meta name="publisher" content="{{ $meta['publisher'] ?? config('company.name') }}" />
    <meta name="robots" content="{{ $meta['robots'] ?? 'index,follow' }}" />
    <link rel="canonical" href="{{ $meta['canonical'] ?? url()->current() }}" />
    <link rel="alternate" hreflang="{{ $meta['alternate']['hreflang'] ?? 'en-in' }}" href="{{ $meta['alternate']['url'] ?? url()->current() }}" />

    @if(!empty($meta['geo']))
        <meta name="geo.region" content="{{ $meta['geo']['region'] ?? 'IN-DL' }}" />
        <meta name="geo.placename" content="{{ $meta['geo']['placename'] ?? 'Dwarka, Delhi' }}" />
        <meta name="geo.position" content="{{ $meta['geo']['position'] ?? '' }}" />
        <meta name="ICBM" content="{{ $meta['geo']['icbm'] ?? '' }}" />
    @endif

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $meta['og']['title'] }}" />
    <meta property="og:description" content="{{ $meta['og']['description'] }}" />
    <meta property="og:type" content="{{ $meta['og']['type'] ?? 'website' }}" />
    <meta property="og:url" content="{{ $meta['og']['url'] }}" />
    <meta property="og:image" content="{{ $meta['og']['image'] }}" />
    <meta property="og:image:alt" content="{{ $meta['og']['image_alt'] ?? $meta['og']['title'] }}" />
    <meta property="og:site_name" content="{{ $meta['og']['site_name'] ?? config('company.brand') }}" />
    <meta property="og:locale" content="{{ $meta['og']['locale'] ?? 'en_IN' }}" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="{{ $meta['twitter']['card'] ?? 'summary_large_image' }}" />
    <meta name="twitter:title" content="{{ $meta['twitter']['title'] }}" />
    <meta name="twitter:description" content="{{ $meta['twitter']['description'] }}" />
    <meta name="twitter:image" content="{{ $meta['twitter']['image'] }}" />
    @if(!empty($meta['twitter']['site']))
        <meta name="twitter:site" content="{{ $meta['twitter']['site'] }}" />
    @endif
@endif
