<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEO::generate() !!}

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-ash">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            @yield('content')
            {{ $slot ?? '' }}
        </main>
    <!-- Footer with location link -->
    <footer class="bg-charcoal text-ash py-4 mt-12">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between px-4">
            <div class="text-xs text-ash mb-2 md:mb-0">
                © {{ date('Y') }} ReyxShop – All rights reserved.
            </div>
            <div class="flex items-center gap-2 text-xs">
                <svg class="w-4 h-4 text-ash" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                    <circle cx="12" cy="9" r="2.5"/>
                </svg>
                <a href="https://www.google.com/maps/search/?api=1&query=Jl.+Komp.+Alam+Satria+3+No+560,%20Klapanunggal%20I,+Mekarjaya%20City%20Kabupaten%20Bandung,%20Jawa%20Barat%2030096" target="_blank" class="underline hover:text-coral text-ash">Jl. Komp. Alam Satria 3 No 560, Klapanunggal I – 30096</a>
            </div>
        </div>
    </footer>
</div>
