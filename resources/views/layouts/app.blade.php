<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! SEO::generate() !!}

    <!-- Open Graph Meta -->
    <meta property="og:title" content="@yield('title', 'ReyxShop — Official Motocross & Off-Road Gear Store')">
    <meta property="og:description" content="@yield('meta_description', 'Katalog resmi perlengkapan off-road dan motocross terlengkap.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased selection:bg-red-500 selection:text-white flex flex-col justify-between">

    <!-- Top Announcement & Store Status Bar -->
    <div class="bg-slate-950 text-slate-300 text-xs border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex flex-col sm:flex-row items-center justify-between gap-2 text-center sm:text-left">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    TOKO BUKA
                </span>
                <span>Buka setiap hari 08:30 - 18:00 WIB • Pengiriman Cepat Se-Indonesia</span>
            </div>
            <div class="flex items-center gap-4 text-slate-400">
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20ReyxShop%2C%20saya%20ingin%20tanya%20produk%20offroad" target="_blank" class="hover:text-emerald-400 transition flex items-center gap-1">
                    <span>CS WhatsApp: +62 812-3456-7890</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 gap-4">
                
                <!-- Brand Logo -->
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-red-600 via-red-700 to-slate-950 flex items-center justify-center text-white font-black text-xl shadow-md shadow-red-500/20 group-hover:scale-105 transition-transform duration-200">
                            R
                        </div>
                        <div>
                            <span class="text-2xl font-black tracking-tight text-slate-950 flex items-center gap-1">
                                REYX<span class="text-red-600">SHOP</span>
                            </span>
                            <span class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 -mt-1">
                                Off-Road & Motocross Gear
                            </span>
                        </div>
                    </a>

                    <!-- Desktop Nav Links -->
                    <nav class="hidden md:flex items-center gap-1">
                        <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('home') ? 'text-red-600 bg-red-50' : 'text-slate-700 hover:text-red-600 hover:bg-slate-100' }} transition">
                            Beranda
                        </a>
                        <a href="{{ route('products.index') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('products.*') ? 'text-red-600 bg-red-50' : 'text-slate-700 hover:text-red-600 hover:bg-slate-100' }} transition">
                            Katalog Produk
                        </a>
                        <a href="{{ route('home') }}#kategori" class="px-3 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-red-600 hover:bg-slate-100 transition">
                            Kategori
                        </a>
                        <a href="{{ route('home') }}#tentang-toko" class="px-3 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-red-600 hover:bg-slate-100 transition">
                            Tentang Toko
                        </a>
                    </nav>
                </div>

                <!-- Search Input & CTA -->
                <div class="flex items-center gap-3">
                    <form action="{{ route('products.index') }}" method="GET" class="hidden sm:block relative">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Cari jersey, helm, boots..." 
                            class="w-48 lg:w-72 pl-9 pr-4 py-2 text-xs rounded-full border border-slate-300 bg-slate-100/60 focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"
                        >
                        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </form>

                    <!-- Official Marketplace Quick Buttons -->
                    <div class="flex items-center gap-2">
                        <a 
                            href="https://shopee.co.id" 
                            target="_blank" 
                            rel="noopener" 
                            class="hidden lg:inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-100 border border-orange-200 transition"
                            title="Buka Toko Resmi Shopee"
                        >
                            <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                            Shopee
                        </a>
                        <a 
                            href="https://lazada.co.id" 
                            target="_blank" 
                            rel="noopener" 
                            class="hidden lg:inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-100 border border-indigo-200 transition"
                            title="Buka Toko Resmi Lazada"
                        >
                            <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                            Lazada
                        </a>
                        <a 
                            href="https://wa.me/6281234567890?text=Halo%20Admin%20ReyxShop%2C%20saya%20tertarik%20dengan%20produk%20offroad" 
                            target="_blank" 
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 shadow-md shadow-emerald-600/20 transition transform hover:-translate-y-0.5"
                        >
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                            </svg>
                            <span>WhatsApp</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- Page Content Slot -->
    <main class="grow">
        @yield('content')
    </main>

    <!-- Floating Live Chat / WhatsApp Widget -->
    <aside class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-3" id="floating-chat-container">
        <!-- Chat Popup Panel (Hidden by default, toggleable) -->
        <div id="chat-popup" class="hidden w-80 bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden transform transition-all duration-300">
            <div class="bg-gradient-to-r from-red-600 via-red-700 to-slate-900 text-white p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-sm font-black">R</div>
                        <div>
                            <h4 class="text-sm font-bold">Admin ReyxShop</h4>
                            <p class="text-[10px] text-emerald-300 flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Online • Siap Membantu
                            </p>
                        </div>
                    </div>
                    <button type="button" onclick="toggleChatPopup()" class="text-white/80 hover:text-white p-1 rounded-md transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
            <div id="chat-messages-list" class="p-4 bg-slate-50 space-y-2.5 h-64 overflow-y-auto text-xs text-slate-700">
                <div class="bg-white p-3 rounded-xl border border-slate-200/80 shadow-2xs">
                    <p class="font-semibold text-slate-900 mb-1">Halo Rider! 👋</p>
                    <p>Ada yang bisa kami bantu seputar ukuran gear, helm, sepatu boots, atau cek stok barang hari ini?</p>
                </div>
            </div>
            <!-- Chat Input Form -->
            <form id="chat-send-form" onsubmit="sendLiveChatMessage(event)" class="p-3 bg-white border-t border-slate-200 flex items-center gap-2">
                <input 
                    type="text" 
                    id="chat-input-message" 
                    placeholder="Tulis pesan..." 
                    required 
                    class="grow px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-hidden focus:ring-2 focus:ring-red-500"
                >
                <button type="submit" class="p-2 rounded-xl bg-red-600 text-white hover:bg-red-700 transition" title="Kirim">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </button>
            </form>
        </div>

        <!-- Trigger Button -->
        <button 
            type="button" 
            onclick="toggleChatPopup()" 
            class="group flex items-center gap-2.5 px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-full shadow-xl shadow-red-600/30 hover:scale-105 transition-all duration-200 cursor-pointer"
            aria-label="Buka Chat Bantuan"
        >
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-400"></span>
            </span>
            <span class="text-xs font-bold tracking-wide">Live Chat / Tanya Admin</span>
            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
        </button>
    </aside>

    <!-- Professional Storefront Footer -->
    <footer class="bg-slate-950 text-slate-400 text-xs mt-20 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                
                <!-- Col 1: Brand & About -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-red-600 to-slate-900 flex items-center justify-center text-white font-black text-lg">
                            R
                        </div>
                        <span class="text-xl font-black tracking-tight text-white">
                            REYX<span class="text-red-500">SHOP</span>
                        </span>
                    </div>
                    <p class="text-slate-400 leading-relaxed text-xs">
                        Official Storefront & Katalog Toko Perlengkapan Off-Road, Motocross, dan Adventure Trail. Menghadirkan produk apparel dan gear original berkualitas untuk keamanan dan performa maksimal para rider Indonesia.
                    </p>
                    <div class="flex items-center gap-3 pt-2">
                        <a href="https://shopee.co.id" target="_blank" class="px-2.5 py-1 rounded bg-slate-900 text-orange-400 border border-slate-800 hover:border-orange-500/50 transition font-semibold">Shopee Official</a>
                        <a href="https://lazada.co.id" target="_blank" class="px-2.5 py-1 rounded bg-slate-900 text-indigo-400 border border-slate-800 hover:border-indigo-500/50 transition font-semibold">Lazada Official</a>
                    </div>
                </div>

                <!-- Col 2: Kategori Populer -->
                <div class="space-y-3">
                    <h3 class="text-white font-bold uppercase tracking-wider text-xs">Kategori Perlengkapan</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('products.index', ['category' => 'jersey-apparel']) }}" class="hover:text-red-400 transition">Jersey & Celana Riding</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'helm-goggles']) }}" class="hover:text-red-400 transition">Helm Trail & Kacamata Goggles</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'sarung-tangan-boots']) }}" class="hover:text-red-400 transition">Sepatu Boots & Sarung Tangan</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'body-protector']) }}" class="hover:text-red-400 transition">Body Armor & Pelindung Lutut</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'parts-aksesoris']) }}" class="hover:text-red-400 transition">Aksesoris & Toolkit Adventure</a></li>
                    </ul>
                </div>

                <!-- Col 3: Layanan Pelanggan -->
                <div class="space-y-3">
                    <h3 class="text-white font-bold uppercase tracking-wider text-xs">Layanan & Konsultasi</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('products.index') }}" class="hover:text-red-400 transition">Panduan Belanja via Marketplace</a></li>
                        <li><a href="https://wa.me/6281234567890?text=Halo%20ReyxShop%2C%20mau%20konsultasi%20size%20chart" target="_blank" class="hover:text-emerald-400 transition">Konsultasi Ukuran / Size Chart</a></li>
                        <li><a href="https://wa.me/6281234567890?text=Halo%20ReyxShop%2C%20mau%20cek%20resi%20pengiriman" target="_blank" class="hover:text-emerald-400 transition">Status Pengiriman & Resi</a></li>
                        <li><a href="#tentang-toko" class="hover:text-red-400 transition">Syarat & Ketentuan Garansi Produk</a></li>
                    </ul>
                </div>

                <!-- Col 4: Lokasi & Kontak -->
                <div class="space-y-3" id="tentang-toko">
                    <h3 class="text-white font-bold uppercase tracking-wider text-xs">Informasi Toko Fisik</h3>
                    <p class="leading-relaxed">
                        <strong class="text-white">ReyxShop Garage:</strong><br>
                        Kawasan Jalur Trabas Utama No. 49<br>
                        Jawa Barat, Indonesia
                    </p>
                    <p>
                        <strong class="text-white">WhatsApp Order:</strong><br>
                        +62 812-3456-7890
                    </p>
                    <p class="text-emerald-400 font-semibold">
                        ● Jam Buka: 08:30 - 18:00 WIB
                    </p>
                </div>

            </div>

            <div class="mt-12 pt-8 border-t border-slate-900 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] text-slate-500">
                <p>&copy; {{ date('Y') }} ReyxShop. Seluruh hak cipta dilindungi undang-undang.</p>
                <p>Website Resmi Storefront & Katalog Terpadu.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleChatPopup() {
            const popup = document.getElementById('chat-popup');
            if (popup) {
                const isHidden = popup.classList.contains('hidden');
                popup.classList.toggle('hidden');
                if (isHidden) {
                    loadChatMessages();
                }
            }
        }

        async function loadChatMessages() {
            try {
                const res = await fetch('{{ route('chat.messages') }}');
                const data = await res.json();
                if (data.messages && data.messages.length > 0) {
                    const list = document.getElementById('chat-messages-list');
                    list.innerHTML = '';
                    data.messages.forEach(msg => appendMessageBubble(msg.sender_type, msg.message));
                    list.scrollTop = list.scrollHeight;
                }
            } catch (e) {
                console.error('Chat load error:', e);
            }
        }

        async function sendLiveChatMessage(e) {
            e.preventDefault();
            const input = document.getElementById('chat-input-message');
            const message = input.value.trim();
            if (!message) return;

            appendMessageBubble('customer', message);
            input.value = '';

            try {
                const res = await fetch('{{ route('chat.send') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message: message })
                });
                const data = await res.json();
                if (data.status === 'success') {
                    setTimeout(() => loadChatMessages(), 800);
                }
            } catch (err) {
                console.error('Chat send error:', err);
            }
        }

        function appendMessageBubble(sender, text) {
            const list = document.getElementById('chat-messages-list');
            const div = document.createElement('div');
            if (sender === 'customer') {
                div.className = 'ml-auto max-w-[80%] bg-red-600 text-white p-2.5 rounded-2xl rounded-tr-xs text-xs';
            } else if (sender === 'system') {
                div.className = 'mr-auto max-w-[85%] bg-amber-50 text-amber-900 border border-amber-200 p-2.5 rounded-2xl text-[11px]';
            } else {
                div.className = 'mr-auto max-w-[80%] bg-white border border-slate-200 text-slate-800 p-2.5 rounded-2xl rounded-tl-xs text-xs';
            }
            div.textContent = text;
            list.appendChild(div);
            list.scrollTop = list.scrollHeight;
        }
    </script>
</body>
</html>
