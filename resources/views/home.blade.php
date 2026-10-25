@extends('layouts.app')

@section('title', 'ReyxShop Kids — Katalog Pakaian Anak Berkualitas & Nyaman')
@section('meta_description', 'Katalog toko keluarga ReyxShop Kids: Pakaian anak, kaos setelan, celana kargo, dan baju harian anak original dan nyaman.')

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
                        Pakaian Anak Berkualitas <br>
                        <span class="text-coral">
                            Nyaman untuk Si Kecil!
                        </span>
                    </h1>

                    <p class="text-slate text-base sm:text-lg max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        Koleksi lengkap kaos anak, celana kargo, setelan, jaket, dan pakaian harian original. Pesan mudah dan terpercaya langsung via <span class="font-semibold text-charcoal">Shopee</span>.
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
                                </div>
                </div>

                <!-- Right Column: Visual Hero Card -->
                <div class="lg:col-span-5">
                    <div class="relative mx-auto max-w-md rounded-card bg-white p-3 border border-border shadow-floating">
                        <div class="overflow-hidden rounded-xl relative group aspect-4/3 bg-ash">
                            <img 
                                src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=900&auto=format&fit=crop&q=80" 
                                alt="Pakaian Anak ReyxShop Kids" 
                                class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                                onerror="this.onerror=null;this.src='{{ asset('images/placeholder-product.svg') }}';"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-charcoal/80 via-transparent to-transparent"></div>
                            
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <span class="px-2.5 py-1 rounded-pill text-[10px] font-bold uppercase bg-coral text-white mb-1 inline-block">
                                    Ready Stock
                                </span>
                                <h3 class="text-base font-bold text-white">Kaos, Celana, Setelan & Jaket Anak Original</h3>
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
                        Pilihan Kategori Pakaian Anak
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
                                <img src="{{ asset('category-icons/' . $category->slug . '.png') }}" alt="{{ $category->name }}" class="w-6 h-6" onerror="this.onerror=null;this.src='{{ asset('images/bag-icon.svg') }}';" />
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
                        Produk Kami
                    </h2>
                    <p class="text-xs text-slate mt-1">
                        Pilih produk dan nikmati kemudahan bertransaksi via Shopee.
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
                                    onerror="this.onerror=null;this.src='{{ asset('images/placeholder-product.svg') }}';"
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



    <!-- ABOUT SECTION -->
    <section class="py-16 bg-white border-t border-border" id="about">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Image -->
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-card border border-border shadow-floating overflow-hidden bg-ash">
                        <div class="aspect-4/3 overflow-hidden">
                            <img 
                                src="https://images.unsplash.com/photo-1561056044-89a68f3fa279?w=900&auto=format&fit=crop&q=80" 
                                alt="Toko ReyxShop" 
                                class="w-full h-full object-cover object-center"
                                onerror="this.onerror=null;this.src='{{ asset('images/placeholder-product.svg') }}';"
                            >
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="order-1 lg:order-2">
                    <p class="text-xs font-bold text-coral uppercase tracking-wider mb-3">Tentang Toko Kami</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-charcoal mb-4">
                        ReyxShop Kids – Toko Pakaian Anak Terpercaya
                    </h2>
                    <div class="space-y-3 text-xs text-slate leading-relaxed">
                        <p>
                            ReyxShop Kids adalah toko pakaian anak yang menyediakan pilihan baju nyaman, rapi, dan bergaya untuk si kecil. Kami memahami bahwa anak butuh pakaian yang adem dipakai seharian, aman di kulit, dan tetap nyaman saat bermain, sekolah, maupun bepergian.
                        </p>
                        <p>
                            Setiap produk kami pilih dengan teliti: bahan katun yang lembut dan menyerap keringat, jahitan kuat yang tahan dicuci berulang kali, serta desain karakter dan motif yang disukai anak-anak. Ukurannya juga kami sesuaikan dengan tumbuh kembang si kecil, jadi lebih mudah memilih yang pas.
                        </p>
                        <p>
                            Koleksi kami mencakup kaos anak, celana, hingga setelan yang praktis dipadukan. Semuanya tersedia dengan harga yang ramah di kantong orang tua, tanpa mengorbankan kualitas.
                        </p>
                        <p>
                            Lewat katalog online ini, kamu bisa melihat koleksi dengan santai, membandingkan pilihan warna dan ukuran, membaca ulasan dari pembeli lain, dan bertanya langsung ke admin lewat fitur tanya jawab atau live chat. Kalau sudah cocok, pembelian bisa dilanjutkan lewat Shopee atau Tokopedia kami.
                    </div>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('products.index') }}" class="px-5 py-2.5 rounded-pill bg-coral hover:bg-coral-hover text-white text-xs font-bold transition">
                            Lihat Katalog Lengkap
                        </a>
                        @auth
                        <button onclick="if(window.Tawk_API){Tawk_API.toggle();}else{alert('Widget chat sedang dimuat, coba lagi.');}" class="px-5 py-2.5 rounded-pill bg-white hover:bg-ash text-charcoal border border-border text-xs font-bold transition">
                            Chat Admin
                        </button>
                        @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-pill bg-white hover:bg-ash text-charcoal border border-border text-xs font-bold transition">
                            Chat Admin
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section class="py-16 bg-ash border-t border-border" id="contact">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Contact Details + Maps -->
                <div class="lg:col-span-2">
                    <p class="text-xs font-bold text-coral uppercase tracking-wider mb-3">Lokasi</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-charcoal mb-6">
                        Lokasi Toko Kami
                    </h2>
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Location & Plus Code Card -->
                        <div class="p-5 rounded-card border border-border bg-white space-y-2">
                            
                            <h4 class="font-bold text-sm text-charcoal">Lokasi & Plus Code</h4>
                            <p class="text-xs text-slate leading-relaxed">
                                XGXX+44C<br>
                                Katapang, Kec. Katapang, Kabupaten Bandung, Jawa Barat 40921
                            </p>
                        </div>
                    </div>

                    <!-- Google Maps Embed (inside left column) -->
                    <div class="mt-6">
                        <h3 class="text-base font-bold text-charcoal mb-3">Lokasi Toko Kami</h3>
                        <div class="rounded-card overflow-hidden border border-border relative" style="padding-bottom:45%; height:0;">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d495.00750916306475!2d107.54783584246609!3d-7.002208627316598!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ef00468ebd19%3A0x3d5f9f46cd14a6b3!2sREYS%20HOME!5e0!3m2!1sid!2sid!4v1792919272897!5m2!1sid!2sid"
                                class="absolute top-0 left-0 w-full h-full"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="strict-origin-when-cross-origin"
                            ></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
