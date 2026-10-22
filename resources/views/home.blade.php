@extends('layouts.app')

@section('title', 'ReyxShop — Official Storefront & Katalog Perlengkapan Off-Road & Motocross')
@section('meta_description', 'Katalog resmi ReyxShop: Toko perlengkapan motocross, jersey set, helm trail, goggle, sepatu boots enduro, dan body protector original. Beli aman via Shopee, Lazada, atau WhatsApp.')

@section('content')

    <!-- HERO SECTION -->
    <section class="relative bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white overflow-hidden py-16 lg:py-24 border-b border-slate-800">
        <!-- Background Decorative Glow & Pattern -->
        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(#ef4444_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-red-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Column: Copy & Actions -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-600/10 border border-red-500/30 text-red-400 text-xs font-bold uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
                        Official Storefront & Katalog Terverifikasi
                    </div>
                    
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-tight">
                        GEAR UP FOR THE DIRT, <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-orange-400 to-amber-300">
                            TAKLUKKAN SETIAP TREK!
                        </span>
                    </h1>

                    <p class="text-slate-300 text-base sm:text-lg max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        Koleksi lengkap perlengkapan off-road, jersey motocross, helm trail SNI/DOT, sepatu boots enduro, dan proteksi tubuh bersertifikasi internasional. Transaksi resmi, cepat, dan aman melalui <span class="text-orange-400 font-semibold">Shopee</span>, <span class="text-indigo-400 font-semibold">Lazada</span>, atau <span class="text-emerald-400 font-semibold">WhatsApp</span>.
                    </p>

                    <!-- Store Status Quick Notice -->
                    <div class="inline-flex flex-wrap items-center justify-center lg:justify-start gap-4 p-3 rounded-2xl bg-white/5 border border-white/10 text-xs text-slate-300 backdrop-blur-xs">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full {{ $storeSettings['is_open'] ? 'bg-emerald-400' : 'bg-red-400' }}"></span>
                            <span class="font-bold text-white">Status Toko: {{ $storeSettings['is_open'] ? 'Buka' : 'Tutup Sementara' }}</span>
                        </div>
                        <span class="hidden sm:inline text-slate-600">•</span>
                        <span>{{ $storeSettings['status_notice'] }}</span>
                    </div>

                    <!-- CTA Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3.5 pt-2">
                        <a 
                            href="#katalog-unggulan" 
                            class="w-full sm:w-auto px-8 py-3.5 rounded-xl font-bold text-sm bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white shadow-xl shadow-red-600/30 transition transform hover:-translate-y-0.5 text-center"
                        >
                            Jelajahi Produk Unggulan ↓
                        </a>
                        <a 
                            href="https://wa.me/{{ $storeSettings['whatsapp_number'] }}?text=Halo%20Admin%20ReyxShop%2C%20saya%20ingin%20konsultasi%20ukuran%20gear%20motocross" 
                            target="_blank" 
                            class="w-full sm:w-auto px-6 py-3.5 rounded-xl font-bold text-sm bg-slate-800/90 hover:bg-slate-800 text-slate-200 border border-slate-700/80 transition text-center flex items-center justify-center gap-2"
                        >
                            <span class="text-emerald-400">💬</span>
                            Tanya Ukuran / Konsultasi
                        </a>
                    </div>
                </div>

                <!-- Right Column: Visual Hero Card -->
                <div class="lg:col-span-5">
                    <div class="relative mx-auto max-w-md rounded-3xl bg-gradient-to-b from-slate-800/80 to-slate-900/90 p-3 border border-slate-700/60 shadow-2xl backdrop-blur-md">
                        <div class="overflow-hidden rounded-2xl relative group">
                            <img 
                                src="https://images.unsplash.com/photo-1558981403-c5f9899a28bc?w=900&auto=format&fit=crop&q=80" 
                                alt="Motocross Rider ReyxShop" 
                                class="w-full h-80 object-cover object-center group-hover:scale-105 transition-transform duration-500"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                            
                            <!-- Overlay Badges -->
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 rounded-full text-xs font-black uppercase bg-red-600 text-white shadow-md">
                                    Ready Stock 2026
                                </span>
                            </div>

                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <p class="text-xs font-semibold text-red-400 uppercase tracking-widest">Katalog Resmi ReyxShop</p>
                                <h3 class="text-lg font-bold">Jersey, Helm, Boots & Body Armor</h3>
                                <div class="mt-2 flex items-center justify-between text-xs text-slate-300">
                                    <span>✓ Kualitas Original</span>
                                    <span>✓ Garansi Pengiriman</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- STORE NOTICE BAR -->
    <div class="bg-amber-500/10 border-b border-amber-500/20 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-amber-900">
            <div class="flex items-center gap-2">
                <span class="font-bold bg-amber-500 text-slate-950 px-2 py-0.5 rounded text-[10px] uppercase">Pemberitahuan Toko</span>
                <span>{{ $storeSettings['status_notice'] }}</span>
            </div>
            <a href="https://wa.me/{{ $storeSettings['whatsapp_number'] }}" target="_blank" class="font-bold underline hover:text-amber-700 transition">
                Hubungi Admin Sekarang &rarr;
            </a>
        </div>
    </div>

    <!-- CATEGORIES SECTION -->
    <section class="py-16 bg-white border-b border-slate-200" id="kategori">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
                <div>
                    <p class="text-xs font-bold text-red-600 uppercase tracking-wider">Kategori Pilihan</p>
                    <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-900 mt-1">
                        Perlengkapan Trabas & Motocross
                    </h2>
                </div>
                <a href="{{ route('products.index') }}" class="text-xs font-bold text-red-600 hover:text-red-700 transition flex items-center gap-1">
                    Lihat Semua Kategori &rarr;
                </a>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($categories as $category)
                    <a 
                        href="{{ route('products.index', ['category' => $category->slug]) }}" 
                        class="group p-5 rounded-2xl border border-slate-200 bg-slate-50/50 hover:bg-white hover:border-red-500/50 hover:shadow-lg hover:shadow-red-500/5 transition-all duration-200 flex flex-col justify-between"
                    >
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center font-bold text-lg mb-3 group-hover:scale-110 group-hover:bg-red-600 group-hover:text-white transition-all">
                                🏍️
                            </div>
                            <h3 class="font-bold text-slate-900 group-hover:text-red-600 transition text-sm">
                                {{ $category->name }}
                            </h3>
                            <p class="text-slate-500 text-xs mt-1 line-clamp-2 leading-relaxed">
                                {{ $category->description }}
                            </p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-200/60 flex items-center justify-between text-xs text-slate-500">
                            <span>{{ $category->products_count }} Produk</span>
                            <span class="group-hover:translate-x-1 transition-transform text-red-600 font-bold">&rarr;</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FEATURED PRODUCTS SECTION -->
    <section class="py-16 bg-slate-50" id="katalog-unggulan">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <span class="px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider bg-red-100 text-red-600">
                        Katalog Unggulan
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-950 mt-2">
                        Produk Motocross & Off-Road Terpopuler
                    </h2>
                    <p class="text-xs text-slate-500 mt-1">
                        Pilih produk dan langsung checkout melalui toko resmi Shopee, Lazada, atau pesan via WhatsApp.
                    </p>
                </div>

                <!-- Quick Category Pill Filter -->
                <div class="flex items-center gap-2 overflow-x-auto pb-2 md:pb-0">
                    <a href="{{ route('home') }}#katalog-unggulan" class="px-3.5 py-1.5 rounded-full text-xs font-bold {{ !$selectedCategory ? 'bg-slate-900 text-white' : 'bg-white text-slate-700 hover:bg-slate-100' }} border border-slate-200 transition">
                        Semua
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('home', ['category' => $cat->slug]) }}#katalog-unggulan" class="whitespace-nowrap px-3.5 py-1.5 rounded-full text-xs font-bold {{ $selectedCategory === $cat->slug ? 'bg-red-600 text-white' : 'bg-white text-slate-700 hover:bg-slate-100' }} border border-slate-200 transition">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Product Grid -->
            @if($featuredProducts->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($featuredProducts as $product)
                        <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-xs hover:shadow-xl hover:border-slate-300 transition-all duration-300 flex flex-col justify-between group">
                            
                            <!-- Image Container -->
                            <div class="relative overflow-hidden bg-slate-100 aspect-4/3">
                                <img 
                                    src="{{ $product->image_url }}" 
                                    alt="{{ $product->name }}" 
                                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                >
                                <!-- Badges -->
                                <div class="absolute top-3 left-3 flex flex-col gap-1.5 items-start">
                                    <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-slate-900 text-white shadow-sm">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                                <div class="absolute top-3 right-3">
                                    <span class="px-2 py-1 rounded-md text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Stok: {{ $product->stock }}
                                    </span>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-5 flex flex-col grow justify-between">
                                <div>
                                    <!-- Rating & Reviews -->
                                    <div class="flex items-center gap-1.5 text-xs text-amber-500 mb-2">
                                        <span>★</span>
                                        <span class="font-bold text-slate-800">{{ $product->average_rating }}</span>
                                        <span class="text-slate-400">({{ $product->approvedReviews->count() }} ulasan)</span>
                                    </div>

                                    <!-- Product Name -->
                                    <h3 class="font-bold text-slate-900 text-base leading-snug group-hover:text-red-600 transition line-clamp-2">
                                        <a href="{{ route('products.show', $product->slug) }}">
                                            {{ $product->name }}
                                        </a>
                                    </h3>

                                    <!-- Short Description -->
                                    <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">
                                        {{ $product->description }}
                                    </p>

                                    <!-- Variants Tag -->
                                    @if($product->variants->count() > 0)
                                        <div class="mt-3 flex flex-wrap gap-1">
                                            @foreach($product->variants as $variant)
                                                <span class="px-1.5 py-0.5 rounded text-[10px] bg-slate-100 text-slate-600 border border-slate-200 font-medium">
                                                    {{ $variant->name }}: {{ $variant->value }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Price & Action Area -->
                                <div class="mt-6 pt-4 border-t border-slate-100">
                                    <div class="flex items-baseline gap-2 mb-3">
                                        <span class="text-xl font-black text-slate-950">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    <!-- Purchase Options (Multi-Marketplace & WhatsApp) -->
                                    <div class="space-y-2">
                                        <a 
                                            href="{{ route('products.show', $product->slug) }}" 
                                            class="block w-full py-2.5 px-3 text-center rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition"
                                        >
                                            Lihat Detail & Varian
                                        </a>
                                        <div class="grid grid-cols-3 gap-1.5">
                                            @php
                                                $shopeeLink = $product->marketplaceLinks->firstWhere('marketplace', 'shopee')?->url ?? $storeSettings['shopee_url'];
                                                $lazadaLink = $product->marketplaceLinks->firstWhere('marketplace', 'lazada')?->url ?? $storeSettings['lazada_url'];
                                            @endphp
                                            <a 
                                                href="{{ $shopeeLink }}" 
                                                target="_blank" 
                                                rel="noopener" 
                                                class="py-2 text-center rounded-lg bg-orange-50 hover:bg-orange-100 text-orange-600 text-[11px] font-bold border border-orange-200 transition"
                                                title="Beli di Shopee"
                                            >
                                                Shopee
                                            </a>
                                            <a 
                                                href="{{ $lazadaLink }}" 
                                                target="_blank" 
                                                rel="noopener" 
                                                class="py-2 text-center rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-[11px] font-bold border border-indigo-200 transition"
                                                title="Beli di Lazada"
                                            >
                                                Lazada
                                            </a>
                                            <a 
                                                href="https://wa.me/{{ $storeSettings['whatsapp_number'] }}?text=Halo%20ReyxShop%2C%20apakah%20produk%20{{ urlencode($product->name) }}%20ready%20stock%3F" 
                                                target="_blank" 
                                                class="py-2 text-center rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-[11px] font-bold border border-emerald-200 transition"
                                                title="Tanya Admin WhatsApp"
                                            >
                                                WhatsApp
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center max-w-lg mx-auto">
                    <p class="text-3xl mb-2">🔍</p>
                    <h3 class="text-lg font-bold text-slate-800">Produk Tidak Ditemukan</h3>
                    <p class="text-xs text-slate-500 mt-1">Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
                    <a href="{{ route('home') }}" class="inline-block mt-4 px-4 py-2 bg-slate-900 text-white text-xs font-bold rounded-lg">
                        Reset Filter
                    </a>
                </div>
            @endif

            <!-- Bottom Catalog CTA -->
            <div class="mt-12 text-center">
                <a 
                    href="{{ route('products.index') }}" 
                    class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl text-sm font-bold bg-white hover:bg-slate-100 text-slate-800 border border-slate-300 shadow-sm transition"
                >
                    <span>Buka Seluruh Katalog Produk ({{ $featuredProducts->count() }}+ Item)</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- OFFICIAL MARKETPLACE SHOWCASE SECTION -->
    <section class="py-16 bg-white border-t border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center space-y-3 mb-10">
                <p class="text-xs font-bold text-red-600 uppercase tracking-wider">Kanal Belanja Resmi</p>
                <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-900">
                    Beli Aman Melalui Marketplace Pilihan Anda
                </h2>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Website ReyxShop merupakan sentral etalase & katalog resmi. Untuk memberikan rasa aman, jaminan gratis ongkir, dan sistem pembayaran terpercaya, Anda dapat menyelesaikan transaksi melalui marketplace official kami:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Shopee Card -->
                <div class="p-6 rounded-2xl border border-orange-200 bg-orange-50/40 flex flex-col justify-between hover:shadow-md transition">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="px-2.5 py-1 rounded text-[10px] font-bold bg-orange-600 text-white uppercase">Official Shopee</span>
                            <span class="text-xs text-amber-500 font-bold">★ 4.9 / 5.0</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">ReyxShop di Shopee Mall & Star</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Nikmati voucher gratis ongkir, promo cashback, ShopeePaylater, dan perlindungan pembeli 100%.
                        </p>
                    </div>
                    <a href="{{ $storeSettings['shopee_url'] }}" target="_blank" rel="noopener" class="mt-6 inline-block text-center py-2.5 px-4 rounded-xl bg-orange-600 hover:bg-orange-700 text-white font-bold text-xs transition">
                        Buka Toko Shopee &rarr;
                    </a>
                </div>

                <!-- Lazada Card -->
                <div class="p-6 rounded-2xl border border-indigo-200 bg-indigo-50/40 flex flex-col justify-between hover:shadow-md transition">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="px-2.5 py-1 rounded text-[10px] font-bold bg-indigo-600 text-white uppercase">Official Lazada</span>
                            <span class="text-xs text-amber-500 font-bold">★ 4.9 / 5.0</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">ReyxShop LazMall Official</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Jaminan keaslian gear off-road, pengiriman kilat Lazada Logistics, dan promo bank setiap minggu.
                        </p>
                    </div>
                    <a href="{{ $storeSettings['lazada_url'] }}" target="_blank" rel="noopener" class="mt-6 inline-block text-center py-2.5 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs transition">
                        Buka Toko Lazada &rarr;
                    </a>
                </div>

                <!-- WhatsApp Order Card -->
                <div class="p-6 rounded-2xl border border-emerald-200 bg-emerald-50/40 flex flex-col justify-between hover:shadow-md transition">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="px-2.5 py-1 rounded text-[10px] font-bold bg-emerald-600 text-white uppercase">Direct WhatsApp</span>
                            <span class="text-xs text-emerald-600 font-bold">● Fast Response</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Pemesanan & Konsultasi Langsung</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Butuh bantuan memilih ukuran helm, apparel set, atau ingin transfer bank langsung? Chat admin sekarang.
                        </p>
                    </div>
                    <a href="https://wa.me/{{ $storeSettings['whatsapp_number'] }}?text=Halo%20Admin%20ReyxShop%2C%20saya%20ingin%20pesan%20produk%20secara%20langsung" target="_blank" class="mt-6 inline-block text-center py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition">
                        Chat WhatsApp Admin &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- VALUE PROPOSITIONS SECTION -->
    <section class="py-16 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                
                <div class="space-y-2">
                    <div class="w-12 h-12 rounded-2xl bg-red-600/20 text-red-500 flex items-center justify-center text-xl font-bold">
                        🛡️
                    </div>
                    <h4 class="font-bold text-base text-white">100% Produk Original</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Seluruh jersey, helm, boots, dan armor kami dipasok langsung dari distributor resmi bersertifikasi.
                    </p>
                </div>

                <div class="space-y-2">
                    <div class="w-12 h-12 rounded-2xl bg-red-600/20 text-red-500 flex items-center justify-center text-xl font-bold">
                        📏
                    </div>
                    <h4 class="font-bold text-base text-white">Konsultasi Ukuran Akurat</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Ragu memilih size helm atau boots? CS kami siap memandu pengukuran lingkar kepala dan kaki secara tepat.
                    </p>
                </div>

                <div class="space-y-2">
                    <div class="w-12 h-12 rounded-2xl bg-red-600/20 text-red-500 flex items-center justify-center text-xl font-bold">
                        🚀
                    </div>
                    <h4 class="font-bold text-base text-white">Pengiriman Cepat & Aman</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Packing kardus tebal dan bubble wrap berlapis untuk menjamin helm dan gear sampai tanpa goresan.
                    </p>
                </div>

                <div class="space-y-2">
                    <div class="w-12 h-12 rounded-2xl bg-red-600/20 text-red-500 flex items-center justify-center text-xl font-bold">
                        🤝
                    </div>
                    <h4 class="font-bold text-base text-white">Dukungan Trabas & Komunitas</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Toko spesialis yang memahami kebutuhan real rider di lintasan bebatuan, tanah basah, dan tanjakan ekstrem.
                    </p>
                </div>

            </div>
        </div>
    </section>

@endsection
