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