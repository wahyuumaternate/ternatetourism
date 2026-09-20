<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $pageTitle = trim($__env->yieldContent('title')) ?: __('wt.brand') . ' — ' . __('wt.tagline');
        $pageDescription = trim($__env->yieldContent('description')) ?: __('wt.hero_sub');
        $pageImage = trim($__env->yieldContent('og_image')) ?: asset('assets/front/gamalama-1600.webp');
    @endphp
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ __('wt.brand') }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:image" content="{{ $pageImage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="geo.region" content="ID-MU">
    <meta name="geo.placename" content="Ternate">

    <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;1,500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @stack('head')
    @vite(['resources/css/front.css', 'resources/js/front.js'])
</head>

<body class="min-h-screen overflow-x-clip">
    <div class="pointer-events-none fixed inset-x-0 top-0 z-[60] h-0.5 origin-left bg-accent" style="transform: scaleX(var(--scroll, 0))" aria-hidden="true"></div>
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-full focus:bg-white focus:px-4 focus:py-2">{{ __('wt.skip') }}</a>

    <x-front.navbar :transparent="View::hasSection('transparent_nav')" />

    <main id="main">
        @yield('body')
    </main>

    <x-front.footer />

    @stack('scripts')
</body>

</html>
