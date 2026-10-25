<nav x-data="{ open: false }" class="bg-white border-b border-border sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo + Brand -->
            <div class="flex items-center gap-10">
                <a href="{{ route('home') }}" class="shrink-0 flex items-center gap-2">
                    <span class="text-lg font-extrabold text-coral">ReyxShop Kids</span>
                </a>

                <!-- Navigation Links Desktop -->
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="text-xs font-bold text-charcoal hover:text-coral transition {{ request()->routeIs('home') ? 'text-coral border-b-2 border-coral pb-1' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('products.index') }}" class="text-xs font-bold text-charcoal hover:text-coral transition {{ request()->routeIs('products.*') ? 'text-coral border-b-2 border-coral pb-1' : '' }}">
                        Katalog
                    </a>
                    <a href="{{ route('home') }}#about" class="text-xs font-bold text-charcoal hover:text-coral transition">
                        Tentang Kami
                    </a>
                    <a href="{{ route('home') }}#contact" class="text-xs font-bold text-charcoal hover:text-coral transition">
                        Lokasi
                    </a>
                </div>
            </div>

            <!-- Right Section: Auth + Cart -->
            <div class="flex items-center gap-4">
                <!-- Store Info (small screens hidden) -->
                <div class="hidden lg:flex items-center gap-6 text-xs text-slate">
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="font-medium text-charcoal">Buka:</span>
                                            <span>07:00–17:00 WIB</span>
                    </div>
                </div>

                <!-- Auth Dropdown -->
                @auth
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-1.5 border border-border rounded-pill text-xs font-bold bg-white text-charcoal hover:bg-ash focus:outline-none transition">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        <span class="max-w-[80px] truncate">{{ Auth::user()->name }}</span>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                        Profile
                                    </span>
                                </x-dropdown-link>

                                <!-- Admin Panel (if admin/operator) -->
                                @if(auth()->user()->hasAnyRole(['admin', 'operator']))
                                    <x-dropdown-link href="{{ url('/admin') }}">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                            </svg>
                                            Admin Panel
                                        </span>
                                    </x-dropdown-link>
                                @endif

                                <!-- Logout -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                            </svg>
                                            Log Out
                                        </span>
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="hidden sm:flex items-center gap-3">
                        <a href="{{ route('login') }}" class="text-xs font-bold text-charcoal hover:text-coral transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="text-xs font-bold bg-coral text-white px-4 py-2 rounded-pill hover:bg-coral-hover transition">
                            Daftar
                        </a>
                    </div>
                @endauth

                <!-- Mobile Menu Toggle -->
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-card text-charcoal hover:text-coral hover:bg-ash focus:outline-none md:hidden">
                    <svg class="h-5 w-5" :class="{ 'hidden': open, 'inline-flex': !open }" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-5 w-5" :class="{ 'hidden': !open, 'inline-flex': open }" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (responsive) -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden border-t border-border bg-white">
        <div class="px-4 py-3 space-y-3">
            <a href="{{ route('home') }}" class="block text-xs font-bold text-charcoal hover:text-coral py-1.5 {{ request()->routeIs('home') ? 'text-coral' : '' }}">
                Beranda
            </a>
            <a href="{{ route('products.index') }}" class="block text-xs font-bold text-charcoal hover:text-coral py-1.5 {{ request()->routeIs('products.*') ? 'text-coral' : '' }}">
                Katalog
            </a>
            <a href="{{ route('home') }}#about" class="block text-xs font-bold text-charcoal hover:text-coral py-1.5">
                Tentang Kami
            </a>
            <a href="{{ route('home') }}#contact" class="block text-xs font-bold text-charcoal hover:text-coral py-1.5">
                Lokasi
            </a>

            <!-- Store Info Mobile -->
            <div class="pt-3 border-t border-border space-y-2">
                <div class="flex items-center gap-2 text-xs text-slate">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="font-medium text-charcoal">Buka:</span>
                                        <span>07:00–17:00 WIB</span>
                </div>
            </div>

            <!-- Auth Mobile -->
            @auth
                <div class="pt-3 border-t border-border space-y-2">
                    <a href="{{ route('profile.edit') }}" class="block text-xs font-bold text-charcoal hover:text-coral py-1.5">
                        Profile
                    </a>
                    @if(auth()->user()->hasAnyRole(['admin', 'operator']))
                        <a href="{{ url('/admin') }}" class="block text-xs font-bold text-charcoal hover:text-coral py-1.5">
                            Admin Panel
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block text-xs font-bold text-charcoal hover:text-coral py-1.5 w-full text-left">
                            Log Out
                        </button>
                    </form>
                </div>
            @else
                <div class="pt-3 border-t border-border flex items-center gap-3">
                    <a href="{{ route('login') }}" class="flex-1 text-center text-xs font-bold text-charcoal hover:text-coral py-2">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="flex-1 text-center text-xs font-bold bg-coral text-white py-2 rounded-pill hover:bg-coral-hover">
                        Daftar
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>