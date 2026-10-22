@extends('layouts.app')

@section('title', $product->name . ' — ReyxShop Official')
@section('meta_description', Str::limit(strip_tags($product->description), 150))

@section('content')

    <!-- Flash Notification -->
    @if(session('success'))
        <div class="bg-emerald-600 text-white py-3 px-4 text-xs font-semibold text-center">
            ✓ {{ session('success') }}
        </div>
    @endif

    <!-- Breadcrumb -->
    <div class="bg-slate-100 border-b border-slate-200 py-3 text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-red-600 transition">Beranda</a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-red-600 transition">Katalog</a>
            <span>/</span>
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-red-600 transition">
                {{ $product->category->name }}
            </a>
            <span>/</span>
            <span class="text-slate-800 font-semibold truncate">{{ $product->name }}</span>
        </div>
    </div>

    <!-- Product Detail Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Left Col: Gallery -->
            <div class="lg:col-span-6 space-y-4">
                <div class="rounded-3xl border border-slate-200 overflow-hidden bg-slate-100 aspect-4/3 relative shadow-xs">
                    <img 
                        id="main-product-image"
                        src="{{ $product->image_url }}" 
                        alt="{{ $product->name }}" 
                        class="w-full h-full object-cover object-center transition-all duration-300"
                    >
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-slate-900 text-white shadow-sm">
                            {{ $product->category->name }}
                        </span>
                    </div>
                </div>

                <!-- Thumbnails Gallery -->
                @if($product->images->count() > 1)
                    <div class="flex items-center gap-3 overflow-x-auto pb-2">
                        @foreach($product->images as $index => $img)
                            <button 
                                type="button" 
                                onclick="document.getElementById('main-product-image').src='{{ $img->url }}'"
                                class="w-20 h-20 rounded-xl overflow-hidden border-2 border-slate-200 hover:border-red-500 focus:border-red-600 transition shrink-0 cursor-pointer"
                            >
                                <img src="{{ $img->url }}" alt="Thumbnail {{ $index + 1 }}" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif

                <!-- Store Guarantee Badges -->
                <div class="grid grid-cols-3 gap-3 pt-4 border-t border-slate-200 text-center text-xs text-slate-600">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/60">
                        <span class="block text-base mb-1">🛡️</span>
                        <strong class="text-slate-900 block">100% Original</strong>
                        <span>Garansi uang kembali</span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/60">
                        <span class="block text-base mb-1">📦</span>
                        <strong class="text-slate-900 block">Packing Aman</strong>
                        <span>Kardus + bubble wrap</span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/60">
                        <span class="block text-base mb-1">⚡</span>
                        <strong class="text-slate-900 block">Kirim Hari Ini</strong>
                        <span>Order s/d 15:00 WIB</span>
                    </div>
                </div>
            </div>

            <!-- Right Col: Product Info & Purchase Options -->
            <div class="lg:col-span-6 space-y-6">
                
                <div>
                    <!-- Badge & Rating -->
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-red-100 text-red-600">
                            ReyxShop Official
                        </span>
                        <div class="flex items-center gap-1 text-xs text-amber-500 font-bold">
                            <span>★</span>
                            <span class="text-slate-800">{{ $product->average_rating }}</span>
                            <span class="text-slate-400 font-normal">({{ $product->approvedReviews->count() }} ulasan)</span>
                        </div>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-tight">
                        {{ $product->name }}
                    </h1>
                </div>

                <!-- Price Box -->
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-baseline justify-between">
                    <div>
                        <span class="text-xs text-slate-500 block mb-1">Harga Resmi:</span>
                        <div class="flex items-baseline gap-3">
                            <span class="text-3xl font-black text-slate-950">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Stok: {{ $product->stock }} Tersedia
                        </span>
                    </div>
                </div>

                <!-- Variant Selector -->
                @if($product->variants->count() > 0)
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-900 uppercase tracking-wider block">
                            Pilihan Varian / Ukuran:
                        </label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($product->variants as $v)
                                <button 
                                    type="button" 
                                    class="px-4 py-2 rounded-xl text-xs font-semibold border border-slate-300 hover:border-red-500 bg-white hover:bg-red-50 transition cursor-pointer text-slate-800"
                                >
                                    {{ $v->name }}: {{ $v->value }}
                                    @if($v->additional_price > 0)
                                        <span class="text-[10px] text-red-600 font-bold">(+Rp {{ number_format($v->additional_price, 0, ',', '.') }})</span>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Official Marketplace Purchase Buttons (Notice: No Native Cart) -->
                <div class="space-y-3 pt-4 border-t border-slate-200">
                    <p class="text-xs font-bold text-slate-900 uppercase tracking-wider">
                        Pesan Langsung Melalui Kanal Resmi:
                    </p>

                    @php
                        $shopeeUrl = $product->marketplaceLinks->firstWhere('marketplace', 'shopee')?->url ?? $storeSettings['shopee_url'];
                        $lazadaUrl = $product->marketplaceLinks->firstWhere('marketplace', 'lazada')?->url ?? $storeSettings['lazada_url'];
                    @endphp

                    <!-- Shopee Button -->
                    <a 
                        href="{{ $shopeeUrl }}" 
                        target="_blank" 
                        rel="noopener" 
                        class="flex items-center justify-between p-3.5 rounded-2xl bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold text-sm shadow-md shadow-orange-500/20 transition transform hover:-translate-y-0.5"
                    >
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center font-black">S</span>
                            <div>
                                <span class="block text-xs uppercase tracking-wide opacity-90">Beli di Marketplace</span>
                                <span class="font-bold text-sm">Buka Produk di Shopee Official</span>
                            </div>
                        </div>
                        <span class="text-base">&rarr;</span>
                    </a>

                    <!-- Lazada Button -->
                    <a 
                        href="{{ $lazadaUrl }}" 
                        target="_blank" 
                        rel="noopener" 
                        class="flex items-center justify-between p-3.5 rounded-2xl bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-bold text-sm shadow-md shadow-indigo-600/20 transition transform hover:-translate-y-0.5"
                    >
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center font-black">L</span>
                            <div>
                                <span class="block text-xs uppercase tracking-wide opacity-90">Beli di Marketplace</span>
                                <span class="font-bold text-sm">Buka Produk di Lazada Official</span>
                            </div>
                        </div>
                        <span class="text-base">&rarr;</span>
                    </a>

                    <!-- WhatsApp Direct Order -->
                    <a 
                        href="https://wa.me/{{ $storeSettings['whatsapp_number'] }}?text=Halo%20Admin%20ReyxShop%2C%20saya%20tertarik%20dengan%20produk%20{{ urlencode($product->name) }}%20(Harga%20Rp%20{{ number_format($product->price, 0, ',', '.') }}).%20Apakah%20stok%20masih%20tersedia%3F" 
                        target="_blank" 
                        class="flex items-center justify-between p-3.5 rounded-2xl bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-bold text-sm shadow-md shadow-emerald-600/20 transition transform hover:-translate-y-0.5"
                    >
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center font-black">💬</span>
                            <div>
                                <span class="block text-xs uppercase tracking-wide opacity-90">Konsultasi / Order Cepat</span>
                                <span class="font-bold text-sm">Chat Admin via WhatsApp</span>
                            </div>
                        </div>
                        <span class="text-base">&rarr;</span>
                    </a>
                </div>

                <!-- Description -->
                <div class="pt-6 border-t border-slate-200">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-2">Deskripsi Produk:</h3>
                    <div class="text-xs text-slate-600 leading-relaxed whitespace-pre-line bg-slate-50 p-4 rounded-xl border border-slate-200">
                        {{ $product->description }}
                    </div>
                </div>

            </div>

        </div>

        <!-- REVIEWS & Q&A TABS SECTION -->
        <div class="mt-16 pt-10 border-t border-slate-200">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                
                <!-- Reviews Column -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <span>⭐</span> Ulasan Pembeli ({{ $product->approvedReviews->count() }})
                        </h3>
                    </div>

                    <!-- Review Submission Form -->
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
                        <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-3">Tulis Ulasan Anda</h4>
                        <form action="{{ route('products.reviews.store', $product->slug) }}" method="POST" class="space-y-3">
                            @csrf
                            <div>
                                <input 
                                    type="text" 
                                    name="customer_name" 
                                    required 
                                    placeholder="Nama Anda (contoh: Deni / Rider Bandung)" 
                                    class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-hidden focus:ring-2 focus:ring-red-500"
                                >
                            </div>
                            <div>
                                <select 
                                    name="rating" 
                                    required 
                                    class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-hidden focus:ring-2 focus:ring-red-500 bg-white"
                                >
                                    <option value="5">★★★★★ — Sangat Puas (5 Bintang)</option>
                                    <option value="4">★★★★☆ — Puas (4 Bintang)</option>
                                    <option value="3">★★★☆☆ — Cukup (3 Bintang)</option>
                                    <option value="2">★★☆☆☆ — Kurang (2 Bintang)</option>
                                    <option value="1">★☆☆☆☆ — Kecewa (1 Bintang)</option>
                                </select>
                            </div>
                            <div>
                                <textarea 
                                    name="content" 
                                    rows="3" 
                                    required 
                                    placeholder="Bagikan pengalaman Anda tentang bahan, fitting, kenyamanan saat trabas..." 
                                    class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-hidden focus:ring-2 focus:ring-red-500"
                                ></textarea>
                            </div>
                            <button type="submit" class="w-full py-2 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition">
                                Kirim Ulasan
                            </button>
                        </form>
                    </div>

                    <!-- Reviews List -->
                    @if($product->approvedReviews->count() > 0)
                        <div class="space-y-3">
                            @foreach($product->approvedReviews as $rev)
                                <div class="bg-white p-4 rounded-2xl border border-slate-200 space-y-2">
                                    <div class="flex items-center justify-between text-xs">
                                        <strong class="text-slate-900">{{ $rev->customer_name ?? 'Pelanggan Terverifikasi' }}</strong>
                                        <span class="text-slate-400">{{ $rev->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="text-amber-500 text-xs">
                                        @for($i = 0; $i < $rev->rating; $i++) ★ @endfor
                                    </div>
                                    <p class="text-xs text-slate-600 leading-relaxed">{{ $rev->content }}</p>
                                    
                                    @if($rev->reply)
                                        <div class="mt-2 pt-2 border-t border-slate-100 pl-3 border-l-2 border-red-500 bg-slate-50 p-2 rounded text-[11px] text-slate-600">
                                            <strong class="text-red-600 block mb-0.5">Balasan Resmi Admin ReyxShop:</strong>
                                            {{ $rev->reply->content }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200 text-center text-xs text-slate-500">
                            Belum ada ulasan untuk produk ini. Jadilah yang pertama memberikan ulasan!
                        </div>
                    @endif
                </div>

                <!-- Q&A Column -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <span>❓</span> Tanya Jawab Produk (Q&A)
                        </h3>
                    </div>

                    <!-- Ask Question Form -->
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
                        <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-3">Ajukan Pertanyaan ke Admin</h4>
                        <form action="{{ route('products.questions.store', $product->slug) }}" method="POST" class="space-y-3">
                            @csrf
                            <div>
                                <input 
                                    type="text" 
                                    name="customer_name" 
                                    required 
                                    placeholder="Nama Anda (contoh: Fajar)" 
                                    class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-hidden focus:ring-2 focus:ring-red-500"
                                >
                            </div>
                            <div>
                                <textarea 
                                    name="question" 
                                    rows="3" 
                                    required 
                                    placeholder="Tanyakan spesifikasi ukuran, kompatibilitas motor, atau ketersediaan warna..." 
                                    class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-hidden focus:ring-2 focus:ring-red-500"
                                ></textarea>
                            </div>
                            <button type="submit" class="w-full py-2 px-4 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs transition">
                                Kirim Pertanyaan
                            </button>
                        </form>
                    </div>

                    <!-- Questions List -->
                    @if($product->answeredQuestions->count() > 0)
                        <div class="space-y-3">
                            @foreach($product->answeredQuestions as $q)
                                <div class="bg-white p-4 rounded-2xl border border-slate-200 space-y-2">
                                    <div class="flex items-center justify-between text-xs text-slate-500">
                                        <span class="font-semibold text-slate-800">{{ $q->customer_name ?? 'Rider' }} bertanya:</span>
                                        <span>{{ $q->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-xs font-medium text-slate-900">"{{ $q->question }}"</p>
                                    @if($q->answer)
                                        <div class="mt-2 pl-3 border-l-2 border-emerald-500 bg-emerald-50/50 p-2 rounded text-[11px] text-slate-700">
                                            <strong class="text-emerald-700 block mb-0.5">Jawaban Admin:</strong>
                                            {{ $q->answer->answer }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200 text-center text-xs text-slate-500">
                            Punya pertanyaan tentang spesifikasi atau kecocokan produk ini? Tuliskan pertanyaan Anda di atas atau langsung hubungi kami via WhatsApp.
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <!-- RELATED PRODUCTS SECTION -->
        @if($relatedProducts->count() > 0)
            <div class="mt-20 pt-10 border-t border-slate-200">
                <h3 class="text-xl font-black text-slate-950 mb-6">Produk Terkait di Kategori Ini</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($relatedProducts as $rel)
                        <a href="{{ route('products.show', $rel->slug) }}" class="group bg-white p-4 rounded-2xl border border-slate-200 hover:shadow-md transition">
                            <div class="aspect-4/3 rounded-xl overflow-hidden bg-slate-100 mb-3">
                                <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            </div>
                            <h4 class="font-bold text-xs text-slate-900 group-hover:text-red-600 transition line-clamp-1">{{ $rel->name }}</h4>
                            <p class="font-black text-slate-950 text-sm mt-1">Rp {{ number_format($rel->price, 0, ',', '.') }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

@endsection
