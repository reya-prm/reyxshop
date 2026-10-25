@extends('layouts.app')

@section('title', 'Katalog Pakaian Anak — ReyxShop Kids')
@section('meta_description', 'Jelajahi seluruh katalog pakaian anak ReyxShop Kids. Filter berdasarkan kategori, ukuran, warna, dan harga. Beli via marketplace.')

@section('content')

    <!-- Breadcrumb & Header -->
    <div class="bg-white text-charcoal py-10 border-b border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs text-slate mb-3">
                <a href="{{ route('home') }}" class="hover:text-charcoal transition">Beranda</a>
                <span>/</span>
                <span class="text-charcoal font-semibold">Katalog Produk</span>
            </nav>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Katalog Produk Off-Road & Motocross</h1>
            <p class="text-xs sm:text-sm text-slate mt-2 max-w-2xl">
                Temukan perlengkapan riding terbaik dari berbagai kategori. Seluruh produk original dapat dipesan via marketplace resmi ReyxShop.
            </p>
        </div>
    </div>

    <!-- Main Catalog Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <!-- Search & Filter Controls -->
        <div class="bg-white p-5 rounded-card border border-border shadow-floating mb-8">
            <form action="{{ route('products.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                
                <!-- Search Input -->
                <div class="md:col-span-6 relative">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ $search }}" 
                        placeholder="Cari nama produk, apparel, helm, boots..." 
                        class="w-full pl-10 pr-4 py-2.5 text-xs rounded-xl border border-border focus:outline-hidden focus:ring-2 focus:ring-coral focus:border-transparent"
                    >
                    <svg class="w-4 h-4 text-slate absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <!-- Category Select Filter -->
                <div class="md:col-span-4">
                    <select 
                        name="category" 
                        onchange="this.form.submit()" 
                        class="w-full px-3 py-2.5 text-xs rounded-xl border border-border bg-white focus:outline-hidden focus:ring-2 focus:ring-coral"
                    >
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ $selectedCategory === $cat->slug ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit & Reset Buttons -->
                <div class="md:col-span-2 flex items-center gap-2">
                    <button type="submit" class="w-full py-2.5 px-4 rounded-pill bg-coral hover:bg-coral-hover text-white font-bold text-xs transition">
                        Cari
                    </button>
                    @if($search || $selectedCategory)
                        <a href="{{ route('products.index') }}" class="p-2.5 rounded-pill bg-ash hover:bg-slate-200 text-slate text-xs font-semibold transition" title="Reset Filter">
                            ✕
                        </a>
                    @endif
                </div>

            </form>
        </div>

        <!-- Products List Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-card border border-border overflow-hidden shadow-xs hover:shadow-floating transition-all duration-300 flex flex-col justify-between group">
                        
                        <div class="relative overflow-hidden bg-ash aspect-4/3">
                            <img 
                                src="{{ $product->image_url }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                onerror="this.onerror=null;this.src='{{ asset('images/placeholder-product.svg') }}';"
                            >
                            <div class="absolute top-3 left-3 flex flex-col gap-1 items-start">
                                <span class="px-2.5 py-1 rounded-pill text-[10px] font-bold uppercase bg-charcoal text-white">
                                    {{ $product->category->name }}
                                </span>
                            </div>
                            <div class="absolute top-3 right-3">
                                <span class="px-2.5 py-1 rounded-pill text-[10px] font-semibold bg-white text-charcoal border border-border shadow-xs">
                                    Stok: {{ $product->stock }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5 flex flex-col grow justify-between">
                            <div>
                                <div class="flex items-center gap-1.5 text-xs text-amber-500 mb-2">
                                    <span>★</span>
                                    <span class="font-bold text-charcoal">{{ $product->average_rating }}</span>
                                    <span class="text-slate">({{ $product->approvedReviews->count() }} ulasan)</span>
                                </div>

                                <h2 class="font-bold text-charcoal text-sm leading-snug group-hover:text-coral transition line-clamp-2">
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h2>

                                <p class="text-xs text-slate mt-2 line-clamp-2 leading-relaxed">
                                    {{ $product->description }}
                                </p>
                            </div>

                            <div class="mt-6 pt-4 border-t border-border">
                                <div class="flex items-baseline gap-2 mb-3">
                                    <span class="text-lg font-extrabold text-charcoal">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>

                                <div class="space-y-1.5">
                                    <a 
                                        href="{{ route('products.show', $product->slug) }}" 
                                        class="block w-full py-2 px-3 text-center rounded-pill bg-charcoal hover:bg-slate-900 text-white font-bold text-xs transition"
                                    >
                                        Buka Detail Produk
                                    </a>
                                    <div class="grid grid-cols-2 gap-1.5">
                                        @php
                                            $shopee = $product->marketplaceLinks->firstWhere('marketplace', 'shopee')?->url ?? 'https://shopee.co.id';
                                            $lazada = $product->marketplaceLinks->firstWhere('marketplace', 'lazada')?->url ?? 'https://lazada.co.id';
                                        @endphp
                                        <a 
                                            href="{{ $shopee }}" 
                                            target="_blank" 
                                            class="py-1.5 text-center rounded-pill bg-orange-50 text-orange-600 text-[11px] font-bold border border-orange-200 hover:bg-orange-100 transition"
                                        >
                                            Shopee
                                        </a>
                                        <a 
                                            href="{{ $lazada }}" 
                                            target="_blank" 
                                            class="py-1.5 text-center rounded-pill bg-indigo-50 text-indigo-600 text-[11px] font-bold border border-indigo-200 hover:bg-indigo-100 transition"
                                        >
                                            Lazada
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @else
            <div class="bg-white rounded-card border border-border p-12 text-center max-w-lg mx-auto">
                <p class="text-3xl mb-2">🔍</p>
                <h3 class="text-base font-bold text-charcoal">Tidak ada produk yang cocok</h3>
                <p class="text-xs text-slate mt-1">Coba kurangi kata kunci atau bersihkan pilihan kategori.</p>
                <a href="{{ route('products.index') }}" class="inline-block mt-4 px-4 py-2 bg-coral text-white text-xs font-bold rounded-pill">
                    Lihat Semua Produk
                </a>
            </div>
        @endif

    </div>

@endsection
