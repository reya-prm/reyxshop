<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEO::generate() !!}

    <title>ReyxShop Kids</title>

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

    <!-- Chat Widget: Login prompt for guests, Tawk.to for authenticated users -->
    @guest
    <div class="fixed bottom-6 right-6 z-50">
        <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-3 bg-coral hover:bg-coral-hover text-white rounded-full shadow-lg transition-all hover:scale-105">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            <span class="text-sm font-bold">Chat Admin</span>
        </a>
        <div class="absolute bottom-full right-0 mb-2 w-48 bg-white text-charcoal text-xs p-3 rounded-lg shadow-lg opacity-0 hover:opacity-100 transition-opacity pointer-events-none">
            Silakan login terlebih dahulu untuk chat dengan admin
        </div>
    </div>
    @endguest

    @stack('scripts')
    @auth
    @if(auth()->user()->isAdmin())
        <!-- Admin: disabled chat button -->
        <div class="fixed bottom-6 right-6 z-50">
            <span class="flex items-center gap-2 px-4 py-3 bg-slate-200 text-slate-600 rounded-full shadow-lg cursor-not-allowed" title="Admin tidak dapat chat dengan diri sendiri">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                Chat Admin
            </span>
        </div>
    @else
        <!-- User: floating chat button -->
        <div class="fixed bottom-6 right-6 z-50">
            <button id="chat-admin-btn" class="flex items-center gap-2 px-4 py-3 bg-coral hover:bg-coral-hover text-white rounded-full shadow-lg transition-all hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                Chat Admin
            </button>
        </div>
        <!-- Tawk.to widget script -->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/672bb3d12480f5b4f59f6a8f/1ic1qr9fk';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
        
        // Button click handler with retry
        document.getElementById('chat-admin-btn').addEventListener('click', function(){
            var attempts = 0;
            var checkTawk = setInterval(function(){
                attempts++;
                if(window.Tawk_API && window.Tawk_API.toggle){
                    clearInterval(checkTawk);
                    Tawk_API.toggle();
                } else if(attempts > 10) {
                    clearInterval(checkTawk);
                    alert('Widget chat tidak dapat dimuat. Coba refresh halaman.');
                }
            }, 500);
        });
        </script>
    @endif
    @endauth
</body>
</html>
