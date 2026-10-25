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
    <footer class="bg-charcoal text-white py-6 mt-12">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between px-4">
            <div class="text-xs text-slate-300 mb-2 md:mb-0">
                © {{ date('Y') }} ReyxShop Kids – All rights reserved.
            </div>
            <div class="flex items-center gap-2 text-xs">
                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                    <circle cx="12" cy="9" r="2.5"/>
                </svg>
                <a href="https://maps.app.goo.gl/1dcLsCVoF2LuTsEj9" target="_blank" class="underline hover:text-coral text-slate-300">XGXX+44C, Katapang, Kec. Katapang, Kabupaten Bandung, Jawa Barat 40921</a>
            </div>
        </div>
    </footer>
    </div>

    <!-- Tawk.to Live Chat -->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/672bb3d12480f5b4f59f6a8f/1ic1qr9fk'; // ganti dengan ID properti Anda
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
</body>
</html>
