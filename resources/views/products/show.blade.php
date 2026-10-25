@extends('layouts.app')

@section('title', $product->name . ' — ReyxShop Kids Official')
@section('meta_description', Str::limit(strip_tags($product->description), 150))

@section('content')

    <!-- Flash Notification -->
    @if(session('success'))
        <div class="bg-emerald-600 text-white py-3 px-4 text-xs font-semibold text-center flex items-center justify-center gap-2">
            <span>✓</span> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-600 text-white py-3 px-4 text-xs font-semibold text-center flex items-center justify-center gap-2">
            <span>⚠️</span> {{ session('error') }}
        </div>
    @endif

    <!-- Breadcrumb -->
    <div class="bg-ash border-b border-border py-3 text-xs text-slate">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-coral transition">Beranda</a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-coral transition">Katalog</a>
            <span>/</span>
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-coral transition">
                {{ $product->category->name }}
            </a>
            <span>/</span>
            <span class="text-charcoal font-semibold truncate">{{ $product->name }}</span>
        </div>
    </div>

    <!-- Product Detail Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Left Col: Gallery -->
            <div class="lg:col-span-6 space-y-4">
                <div class="rounded-card border border-border overflow-hidden bg-ash aspect-4/3 relative shadow-floating">
                    <img 
                        id="main-product-image"
                        src="{{ $product->image_url }}" 
                        alt="{{ $product->name }}" 
                        class="w-full h-full object-cover object-center transition-all duration-300"
                        onerror="this.onerror=null;this.src='{{ asset('images/placeholder-product.svg') }}';"
                    >
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 rounded-pill text-xs font-bold uppercase tracking-wider bg-charcoal text-white shadow-xs">
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
                                class="w-20 h-20 rounded-card overflow-hidden border-2 border-border hover:border-coral focus:border-coral-hover transition shrink-0 cursor-pointer"
                            >
                                <img src="{{ $img->url }}" alt="Thumbnail {{ $index + 1 }}" class="w-full h-full object-cover" onerror="this.onerror=null;this.src='{{ asset('images/placeholder-product.svg') }}';">
                            </button>
                        @endforeach
                    </div>
                @endif

                <!-- Store Guarantee Badges -->
                <div class="grid grid-cols-3 gap-3 pt-4 border-t border-border text-center text-xs text-slate">
                    <div class="p-3 rounded-card bg-white border border-border">
                        <span class="block text-base mb-1">🛡️</span>
                        <strong class="text-charcoal block">100% Original</strong>
                        <span>Garansi uang kembali</span>
                    </div>
                    <div class="p-3 rounded-card bg-white border border-border">
                        <span class="block text-base mb-1">📦</span>
                        <strong class="text-charcoal block">Packing Aman</strong>
                        <span>Kardus + bubble wrap</span>
                    </div>
                    <div class="p-3 rounded-card bg-white border border-border">
                        <span class="block text-base mb-1">⚡</span>
                        <strong class="text-charcoal block">Kirim Hari Ini</strong>
                        <span>Order s/d 15:00 WIB</span>
                    </div>
                </div>
            </div>

            <!-- Right Col: Product Info & Purchase Options -->
            <div class="lg:col-span-6 space-y-6">
                
                <div>
                    <!-- Badge & Rating -->
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2.5 py-0.5 rounded-pill text-[10px] font-bold uppercase bg-coral text-white">
                            ReyxShop Official
                        </span>
                        <div class="flex items-center gap-1 text-xs text-amber-500 font-bold">
                            <span>★</span>
                            <span class="text-charcoal">{{ $product->average_rating }}</span>
                            <span class="text-slate font-normal">({{ $product->approvedReviews->count() }} ulasan)</span>
                        </div>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-extrabold text-charcoal tracking-tight leading-tight">
                        {{ $product->name }}
                    </h1>
                </div>

                <!-- Price Box -->
                <div class="p-4 rounded-card bg-white border border-border flex items-baseline justify-between">
                    <div>
                        <span class="text-xs text-slate block mb-1">Harga Resmi:</span>
                        <div class="flex items-baseline gap-3">
                            <span class="text-3xl font-extrabold text-charcoal">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-pill text-xs font-semibold bg-white text-charcoal border border-border shadow-xs">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Stok: {{ $product->stock }} Tersedia
                        </span>
                    </div>
                </div>

                <!-- Variant Selector -->
                @if($product->variants->count() > 0)
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-charcoal uppercase tracking-wider block">
                            Pilihan Varian / Ukuran:
                        </label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($product->variants as $v)
                                <button 
                                    type="button" 
                                    class="px-4 py-2 rounded-card text-xs font-semibold border border-border hover:border-coral bg-white hover:bg-orange-50 transition cursor-pointer text-charcoal"
                                >
                                    {{ $v->name }}: {{ $v->value }}
                                    @if($v->additional_price > 0)
                                        <span class="text-[10px] text-coral font-bold">(+Rp {{ number_format($v->additional_price, 0, ',', '.') }})</span>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Official Marketplace Purchase Buttons (Notice: No Native Cart) -->
                <div class="space-y-3 pt-4 border-t border-border">
                    <p class="text-xs font-bold text-charcoal uppercase tracking-wider">
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
                        class="flex items-center justify-between p-3.5 rounded-card bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold text-sm shadow-md shadow-orange-500/20 transition transform hover:-translate-y-0.5"
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



                </div>

                <!-- Description -->
                <div class="pt-6 border-t border-border">
                    <h3 class="text-sm font-bold text-charcoal uppercase tracking-wider mb-2">Deskripsi Produk:</h3>
                    <div class="text-xs text-slate leading-relaxed whitespace-pre-line bg-white p-4 rounded-card border border-border">
                        {{ $product->description }}
                    </div>
                </div>

            </div>

        </div>

        <!-- REVIEWS & Q&A TABS SECTION -->
        <div class="mt-16 pt-10 border-t border-border">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                
                <!-- Reviews Column -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-charcoal flex items-center gap-2">
                            <span>⭐</span> Ulasan Pembeli ({{ $product->approvedReviews->count() }})
                        </h3>
                    </div>

                    <!-- Review Submission Form -->
                    <div class="bg-white p-5 rounded-card border border-border shadow-xs">
                        <h4 class="text-xs font-bold text-charcoal uppercase tracking-wider mb-3">Tulis Ulasan Anda</h4>
                        @php
                            $userReview = $userReview ?? (Auth::check() ? $product->reviews()->where('user_id', Auth::id())->first() : null);
                        @endphp

                        @auth
                            @if($userReview)
                                <div class="space-y-3">
                                    <div class="p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-xl flex items-center gap-2">
                                        <svg class="w-4 h-4 shrink-0 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="font-bold">Anda sudah mengulas produk ini</span>
                                    </div>
                                    <div class="p-4 bg-ash border border-border rounded-xl space-y-2 text-xs">
                                        <div class="flex items-center justify-between text-slate">
                                            <strong class="text-charcoal">{{ Auth::user()->name }} (Ulasan Anda)</strong>
                                            <span>{{ $userReview->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="text-amber-500 font-bold">
                                            @for($i = 0; $i < $userReview->rating; $i++) ★ @endfor
                                            <span class="text-slate font-normal">({{ $userReview->rating }}/5)</span>
                                        </div>
                                        @if($userReview->content)
                                            <p class="text-slate leading-relaxed">{{ $userReview->content }}</p>
                                        @endif
                                        @if($userReview->reply)
                                            <div class="mt-2 pt-2 border-t border-border pl-3 border-l-2 border-coral bg-white p-2.5 rounded-card text-[11px] text-slate">
                                                <strong class="text-coral block mb-0.5">Balasan Resmi Admin ReyxShop:</strong>
                                                {{ $userReview->reply->content }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @elseif(Auth::user()->isAdmin())
                                <div class="p-4 bg-slate-100 text-slate-600 text-xs rounded-card">Admin tidak dapat menulis ulasan produk.</div>
                            @else
                                <form action="{{ route('products.reviews.store', $product->slug) }}" method="POST" class="space-y-3" onsubmit="this.querySelector('button[type=submit]').disabled = true;">
                                    @csrf
                                    @if($errors->has('review'))
                                        <div class="p-3 bg-red-50 border border-red-200 text-red-700 text-xs rounded-xl font-medium">
                                            {{ $errors->first('review') }}
                                        </div>
                                    @endif
                                    <div>
                                        <label class="block text-[11px] font-semibold text-slate mb-1">Beri Bintang:</label>
                                        <select name="rating" required class="w-full px-3 py-2 text-xs rounded-xl border border-border focus:outline-hidden focus:ring-2 focus:ring-coral bg-white">
                                            <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>★★★★★ — Sangat Puas (5 Bintang)</option>
                                            <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>★★★★☆ — Puas (4 Bintang)</option>
                                            <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>★★★☆☆ — Cukup (3 Bintang)</option>
                                            <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>★★☆☆☆ — Kurang (2 Bintang)</option>
                                            <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>★☆☆☆☆ — Kecewa (1 Bintang)</option>
                                        </select>
                                        @error('rating')
                                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-semibold text-slate mb-1">Ulasan Tertulis (Opsional):</label>
                                        <textarea name="content" rows="3" placeholder="Bagikan pengalaman Anda mengenai kualitas produk, ukuran, atau kenyamanan..." class="w-full px-3 py-2 text-xs rounded-xl border border-border focus:outline-hidden focus:ring-2 focus:ring-coral">{{ old('content') }}</textarea>
                                        @error('content')
                                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="w-full py-2.5 px-4 rounded-pill bg-coral hover:bg-coral-hover text-white font-bold text-xs transition shadow-sm hover:shadow-md flex items-center justify-center gap-1.5">
                                        <span>⭐</span> Kirim Ulasan
                                    </button>
                                </form>
                            @endif
                        @else
                            <div class="p-4 bg-ash border border-border rounded-xl text-center space-y-2">
                                <p class="text-xs text-slate">Silakan masuk ke akun Anda untuk menulis ulasan produk.</p>
                                <a href="{{ route('login') }}" class="inline-block w-full py-2 px-4 bg-coral text-white text-center rounded-pill hover:bg-coral-hover text-xs font-bold transition">
                                    Login untuk Menulis Ulasan
                                </a>
                            </div>
                        @endauth
                    </div>

                    <!-- Reviews List -->
                    @if($product->approvedReviews->count() > 0)
                        <div class="space-y-3">
                            @foreach($product->approvedReviews as $rev)
                                <div class="bg-white p-4 rounded-card border border-border space-y-2">
                                    <div class="flex items-center justify-between text-xs">
                                        <strong class="text-charcoal">{{ $rev->user->name ?? 'Pelanggan Terverifikasi' }}</strong>
                                        <span class="text-slate">{{ $rev->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="text-amber-500 text-xs">
                                        @for($i = 0; $i < $rev->rating; $i++) ★ @endfor
                                    </div>
                                    <p class="text-xs text-slate leading-relaxed">{{ $rev->content }}</p>
                                    
                                    @if($rev->reply)
                                        <div class="mt-2 pt-2 border-t border-border pl-3 border-l-2 border-coral bg-ash p-2 rounded-card text-[11px] text-slate">
                                            <strong class="text-coral block mb-0.5">Balasan Resmi Admin ReyxShop:</strong>
                                            {{ $rev->reply->content }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-6 bg-white rounded-card border border-border text-center text-xs text-slate">
                            Belum ada ulasan untuk produk ini. Jadilah yang pertama memberikan ulasan!
                        </div>
                    @endif
                </div>

                <!-- Q&A Column -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-charcoal flex items-center gap-2">
                            <span>❓</span> Tanya Jawab Produk (Q&A)
                        </h3>
                    </div>

                    <!-- Ask Question Form -->
                    <div class="bg-white p-5 rounded-card border border-border shadow-xs">
                        <h4 class="text-xs font-bold text-charcoal uppercase tracking-wider mb-3">Ajukan Pertanyaan ke Admin</h4>
                        @auth
                            @if(Auth::user()->isAdmin())
                                <div class="p-4 bg-slate-100 text-slate-600 text-xs rounded-card">Admin tidak dapat mengajukan pertanyaan produk.</div>
                            @else
                                <form action="{{ route('products.questions.store', $product->slug) }}" method="POST" class="space-y-3" onsubmit="this.querySelector('button[type=submit]').disabled = true;">
                                    @csrf
                                    <div>
                                        <textarea name="question" rows="3" required placeholder="Tanyakan spesifikasi ukuran, kompatibilitas motor..." class="w-full px-3 py-2 text-xs rounded-xl border border-border focus:outline-hidden focus:ring-2 focus:ring-coral">{{ old('question') }}</textarea>
                                        @error('question')
                                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="w-full py-2.5 px-4 rounded-pill bg-coral hover:bg-coral-hover text-white font-bold text-xs transition shadow-sm hover:shadow-md flex items-center justify-center gap-1.5">
                                        <span>💬</span> Kirim Pertanyaan
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="block w-full py-2 px-4 bg-coral text-white text-center rounded-pill hover:bg-coral-hover text-xs font-bold">Login untuk bertanya</a>
                        @endauth
                    </div>

                    <!-- Questions List -->
                    @if($product->answeredQuestions->count() > 0)
                        <div class="space-y-3">
                            @foreach($product->answeredQuestions as $q)
                                <div class="bg-white p-4 rounded-card border border-border space-y-2">
                                    <div class="flex items-center justify-between text-xs text-slate">
                                        <span class="font-semibold text-charcoal">{{ $q->user->name ?? 'Rider' }} bertanya:</span>
                                        <span>{{ $q->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-xs font-medium text-charcoal">"{{ $q->question }}"</p>
                                    @if($q->answer)
                                        <div class="mt-2 pl-3 border-l-2 border-emerald-500 bg-emerald-50/50 p-2 rounded-card text-[11px] text-slate">
                                            <strong class="text-emerald-700 block mb-0.5">Jawaban Admin:</strong>
                                            {{ $q->answer->answer }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-6 bg-white rounded-card border border-border text-center text-xs text-slate">
                            Punya pertanyaan tentang spesifikasi atau kecocokan produk ini? Tuliskan pertanyaan Anda di atas atau langsung hubungi kami via live chat.
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <!-- RELATED PRODUCTS SECTION -->
        @if($relatedProducts->count() > 0)
            <div class="mt-20 pt-10 border-t border-border">
                <h3 class="text-xl font-extrabold text-charcoal mb-6">Produk Terkait di Kategori Ini</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($relatedProducts as $rel)
                        <a href="{{ route('products.show', $rel->slug) }}" class="group bg-white p-4 rounded-card border border-border hover:shadow-floating transition">
                            <div class="aspect-4/3 rounded-card overflow-hidden bg-ash mb-3">
                                <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder-product.svg') }}';">
                            </div>
                            <h4 class="font-bold text-xs text-charcoal group-hover:text-coral transition line-clamp-1">{{ $rel->name }}</h4>
                            <p class="font-extrabold text-charcoal text-sm mt-1">Rp {{ number_format($rel->price, 0, ',', '.') }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

@endsection
