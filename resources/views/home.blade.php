@extends('layouts.app')

@section('title', 'ReyxShop — Katalog Resmi Perlengkapan Off-Road & Motocross')
@section('meta_description', 'Katalog toko keluarga ReyxShop: Perlengkapan motocross, helm trail, jersey set, boots enduro, dan proteksi tubuh original.')

@section('content')

    <!-- HERO SECTION -->
    <section class="relative bg-white text-charcoal overflow-hidden py-16 lg:py-24 border-b border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Column: Copy & Actions -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-pill bg-ash border border-border text-slate text-xs font-bold uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-coral"></span>
                        Toko Keluarga & Katalog Terverifikasi
                    </div>
                    
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight text-charcoal">
                        Perlengkapan Off-Road <br>
                        <span class="text-coral">
                            Terbaik untuk Setiap Trek!
                        </span>
                    </h1>

                    <p class="text-slate text-base sm:text-lg max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        Koleksi lengkap jersey motocross, helm trail, sepatu boots enduro, dan body protector original. Pesan mudah, hangat, dan terpercaya langsung via <span class="font-semibold text-charcoal">Shopee</span>, <span class="font-semibold text-charcoal">Lazada</span>, atau <span class="font-semibold text-charcoal">WhatsApp</span>.
                    </p>

                    <!-- Store Status Quick Notice -->
                    <div class="inline-flex flex-wrap items-center justify-center lg:justify-start gap-4 p-3 rounded-card bg-ash border border-border text-xs text-slate">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-pill {{ $storeSettings['is_open'] ? 'bg-emerald-500' : 'bg-coral' }}"></span>
                            <span class="font-bold text-charcoal">Status Toko: {{ $storeSettings['is_open'] ? 'Buka' : 'Tutup Sementara' }}</span>
                        </div>
                        <span class="hidden sm:inline text-slate-300">•</span>
                        <span>{{ $storeSettings['status_notice'] }}</span>
                    </div>

                    <!-- CTA Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3.5 pt-2">
                        <a 
                            href="#katalog-unggulan" 
                            class="w-full sm:w-auto px-8 py-3.5 rounded-pill font-bold text-sm bg-coral hover:bg-coral-hover text-white shadow-floating transition text-center"
                        >
                            Jelajahi Katalog ↓
                        </a>
                        <a 
                            href="https://wa.me/{{ $storeSettings['whatsapp_number'] }}?text=Halo%20Admin%20ReyxShop%2C%20saya%20ingin%20konsultasi%20ukuran%20gear%20motocross" 
                            target="_blank" 
                            class="w-full sm:w-auto px-6 py-3.5 rounded-pill font-bold text-sm bg-white hover:bg-ash text-charcoal border border-border transition text-center flex items-center justify-center gap-2"
                        >
                            <span class="text-emerald-600">💬</span>
                            Tanya via WhatsApp
                        </a>
                    </div>
                </div>

                <!-- Right Column: Visual Hero Card -->
                <div class="lg:col-span-5">
                    <div class="relative mx-auto max-w-md rounded-card bg-white p-3 border border-border shadow-floating">
                        <div class="overflow-hidden rounded-xl relative group aspect-4/3 bg-ash">
                            <img 
                                src="https://images.unsplash.com/photo-1558981403-c5f9899a28bc?w=900&auto=format&fit=crop&q=80" 
                                alt="Motocross Rider ReyxShop" 
                                class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-charcoal/80 via-transparent to-transparent"></div>
                            
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <span class="px-2.5 py-1 rounded-pill text-[10px] font-bold uppercase bg-coral text-white mb-1 inline-block">
                                    Ready Stock
                                </span>
                                <h3 class="text-base font-bold text-white">Jersey, Helm, Boots & Armor Original</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- CATEGORIES SECTION -->
    <section class="py-16 bg-ash border-b border-border" id="kategori">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
                <div>
                    <p class="text-xs font-bold text-coral uppercase tracking-wider">Kategori Pilihan</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-charcoal mt-1">
                        Perlengkapan Trabas & Motocross
                    </h2>
                </div>
                <a href="{{ route('products.index') }}" class="text-xs font-bold text-coral hover:text-coral-hover transition flex items-center gap-1">
                    Lihat Semua &rarr;
                </a>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($categories as $category)
                    <a 
                        href="{{ route('products.index', ['category' => $category->slug]) }}" 
                        class="group p-5 rounded-card border border-border bg-white hover:border-coral hover:shadow-floating transition-all duration-200 flex flex-col justify-between"
                    >
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-orange-50 text-coral flex items-center justify-center font-bold text-lg mb-3 group-hover:scale-110 group-hover:bg-coral group-hover:text-white transition-all">
                                🏍️
                            </div>
                            <h3 class="font-bold text-charcoal group-hover:text-coral transition text-sm">
                                {{ $category->name }}
                            </h3>
                            <p class="text-slate text-xs mt-1 line-clamp-2 leading-relaxed">
                                {{ $category->description }}
                            </p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-border flex items-center justify-between text-xs text-slate">
                            <span>{{ $category->products_count }} Produk</span>
                            <span class="group-hover:translate-x-1 transition-transform text-coral font-bold">&rarr;</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FEATURED PRODUCTS SECTION -->
    <section class="py-16 bg-white" id="katalog-unggulan">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <span class="px-2.5 py-1 rounded-pill text-xs font-bold uppercase tracking-wider bg-orange-50 text-coral border border-orange-100">
                        Katalog Unggulan
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-charcoal mt-2">
                        Produk Terpopuler ReyxShop
                    </h2>
                    <p class="text-xs text-slate mt-1">
                        Pilih produk dan nikmati kemudahan bertransaksi via Shopee, Lazada, atau WhatsApp.
                    </p>
                </div>

                <!-- Quick Category Pill Filter -->
                <div class="flex items-center gap-2 overflow-x-auto pb-2 md:pb-0">
                    <a href="{{ route('home') }}#katalog-unggulan" class="px-4 py-2 rounded-pill text-xs font-bold {{ !$selectedCategory ? 'bg-charcoal text-white' : 'bg-ash text-charcoal hover:bg-border' }} transition">
                        Semua
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('home', ['category' => $cat->slug]) }}#katalog-unggulan" class="whitespace-nowrap px-4 py-2 rounded-pill text-xs font-bold {{ $selectedCategory === $cat->slug ? 'bg-coral text-white' : 'bg-ash text-charcoal hover:bg-border' }} transition">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Product Grid -->
            @if($featuredProducts->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($featuredProducts as $product)
                        <div class="bg-white rounded-card border border-border overflow-hidden shadow-xs hover:shadow-floating hover:border-coral transition-all duration-300 flex flex-col justify-between group">
                            
                            <!-- Image Container -->
                            <div class="relative overflow-hidden bg-ash aspect-4/3">
                                <img 
                                    src="{{ $product->image_url }}" 
                                    alt="{{ $product->name }}" 
                                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                >
                                <!-- Badges -->
                                <div class="absolute top-3 left-3 flex flex-col gap-1.5 items-start">
                                    <span class="px-2.5 py-1 rounded-pill text-[10px] font-bold uppercase tracking-wider bg-charcoal text-white shadow-sm">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                                <div class="absolute top-3 right-3">
                                    <span class="px-2.5 py-1 rounded-pill text-[10px] font-semibold bg-white text-charcoal border border-border shadow-xs">
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
                                        <span class="font-bold text-charcoal">{{ $product->average_rating }}</span>
                                        <span class="text-slate">({{ $product->approvedReviews->count() }} ulasan)</span>
                                    </div>

                                    <!-- Product Name -->
                                    <h3 class="font-bold text-charcoal text-base leading-snug group-hover:text-coral transition line-clamp-2">
                                        <a href="{{ route('products.show', $product->slug) }}">
                                            {{ $product->name }}
                                        </a>
                                    </h3>

                                    <!-- Short Description -->
                                    <p class="text-xs text-slate mt-2 line-clamp-2 leading-relaxed">
                                        {{ $product->description }}
                                    </p>
                                </div>

                                <!-- Price & Action Area -->
                                <div class="mt-6 pt-4 border-t border-border">
                                    <div class="flex items-baseline gap-2 mb-3">
                                        <span class="text-xl font-extrabold text-charcoal">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    <!-- Purchase Options -->
                                    <div class="space-y-2">
                                        <a 
                                            href="{{ route('products.show', $product->slug) }}" 
                                            class="block w-full py-2.5 px-3 text-center rounded-pill bg-charcoal hover:bg-slate-900 text-white font-bold text-xs transition"
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
                                                class="py-2 text-center rounded-xl bg-orange-50 hover:bg-orange-100 text-orange-600 text-[11px] font-bold border border-orange-200 transition"
                                                title="Shopee"
                                            >
                                                Shopee
                                            </a>
                                            <a 
                                                href="{{ $lazadaLink }}" 
                                                target="_blank" 
                                                rel="noopener" 
                                                class="py-2 text-center rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-[11px] font-bold border border-indigo-200 transition"
                                                title="Lazada"
                                            >
                                                Lazada
                                            </a>
                                            <a 
                                                href="https://wa.me/{{ $storeSettings['whatsapp_number'] }}?text=Halo%20ReyxShop%2C%20apakah%20produk%20{{ urlencode($product->name) }}%20ready%20stock%3F" 
                                                target="_blank" 
                                                class="py-2 text-center rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-[11px] font-bold border border-emerald-200 transition"
                                                title="WhatsApp"
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
                <div class="bg-ash rounded-card border border-border p-12 text-center max-w-lg mx-auto">
                    <p class="text-3xl mb-2">🔍</p>
                    <h3 class="text-lg font-bold text-charcoal">Produk Tidak Ditemukan</h3>
                    <p class="text-xs text-slate mt-1">Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
                    <a href="{{ route('home') }}" class="inline-block mt-4 px-6 py-2.5 bg-coral text-white text-xs font-bold rounded-pill">
                        Reset Filter
                    </a>
                </div>
            @endif

            <!-- Bottom Catalog CTA -->
            <div class="mt-12 text-center">
                <a 
                    href="{{ route('products.index') }}" 
                    class="inline-flex items-center gap-2 px-8 py-3.5 rounded-pill text-sm font-bold bg-white hover:bg-ash text-charcoal border border-border shadow-xs transition"
                >
                    <span>Buka Seluruh Katalog Produk ({{ $featuredProducts->count() }}+ Item)</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- VALUE PROPOSITIONS SECTION -->
    <section class="py-16 bg-ash border-t border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                
                <div class="p-6 rounded-card bg-white border border-border space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-coral flex items-center justify-center text-lg font-bold">
                        🛡️
                    </div>
                    <h4 class="font-bold text-sm text-charcoal">100% Produk Original</h4>
                    <p class="text-xs text-slate leading-relaxed">
                        Seluruh jersey, helm, boots, dan armor kami dipasok langsung dari distributor resmi bersertifikasi.
                    </p>
                </div>

                <div class="p-6 rounded-card bg-white border border-border space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-coral flex items-center justify-center text-lg font-bold">
                        📏
                    </div>
                    <h4 class="font-bold text-sm text-charcoal">Konsultasi Ukuran Akurat</h4>
                    <p class="text-xs text-slate leading-relaxed">
                        Ragu memilih size helm atau boots? CS kami siap memandu pengukuran lingkar kepala dan kaki secara tepat.
                    </p>
                </div>

                <div class="p-6 rounded-card bg-white border border-border space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-coral flex items-center justify-center text-lg font-bold">
                        🚀
                    </div>
                    <h4 class="font-bold text-sm text-charcoal">Pengiriman Cepat & Aman</h4>
                    <p class="text-xs text-slate leading-relaxed">
                        Packing kardus tebal dan bubble wrap berlapis untuk menjamin helm dan gear sampai tanpa goresan.
                    </p>
                </div>

                <div class="p-6 rounded-card bg-white border border-border space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-coral flex items-center justify-center text-lg font-bold">
                        🤝
                    </div>
                    <h4 class="font-bold text-sm text-charcoal">Dukungan Trabas & Komunitas</h4>
                    <p class="text-xs text-slate leading-relaxed">
                        Toko spesialis yang memahami kebutuhan real rider di lintasan bebatuan, tanah basah, dan tanjakan ekstrem.
                    </p>
                </div>

            </div>
        </div>
    </section>

@endsection
