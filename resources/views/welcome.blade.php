<x-app-layout>
    <div class="p-8 text-center">
        <h1 class="text-3xl font-bold">ReyXShop Storefront</h1>
        <p class="mt-4">Explore products, login or register to interact.</p>
        <div class="mt-6">
            <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded mr-2">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-600 text-white rounded">Register</a>
        </div>
    </div>
</x-app-layout>
