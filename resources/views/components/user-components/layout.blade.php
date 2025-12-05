<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', $settings->site_name ?? 'DP3AP2KB')</title>

    @if(isset($settings) && $settings->site_logo)
        <link rel="icon" href="{{ asset('storage/' . $settings->site_logo) }}">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}">
    @endif

    <meta name="description" content="@yield('meta_description', $settings->site_description ?? 'Website resmi Dinas Pemberdayaan Perempuan dan Perlindungan Anak.')">
    <meta name="keywords" content="@yield('meta_keywords', 'dp3ap2kb, pemberdayaan perempuan, perlindungan anak, pemerintah, katingan, dp3a, dp3ap2kb katingan')">
    <meta name="author" content="{{ $settings->site_name ?? 'DP3A' }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:site_name" content="{{ $settings->site_name ?? 'DP3A' }}">
    <meta property="og:title" content="@yield('title', $settings->site_name ?? 'DP3A')">
    <meta property="og:description" content="@yield('meta_description', $settings->site_description ?? 'Website Resmi DP3A.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="@yield('meta_image', isset($settings) && $settings->site_logo ? asset('storage/' . $settings->site_logo) : asset('img/default-share.jpg'))">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $settings->site_name ?? 'DP3A')">
    <meta name="twitter:description" content="@yield('meta_description', $settings->site_description ?? 'Website Resmi DP3A.')">
    <meta name="twitter:image" content="@yield('meta_image', isset($settings) && $settings->site_logo ? asset('storage/' . $settings->site_logo) : asset('img/default-share.jpg'))">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @stack('meta')
    @stack('styles')
    @vite(['resources/css/frontend.scss', 'resources/js/frontend.js'])

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&display=swap');
        
        body {
            font-family: 'Arimo', sans-serif;
        }

        @media (max-width: 991.98px) {
            html, body {
                overflow-x: hidden;
            }
            
            img {
                max-width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body class="bg-light">

    <x-user-components.header />

    <main>
        {{ $slot }}
    </main>

    <x-user-components.footer />
    <x-user-components.back-to-top />

    @stack('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>
</html>