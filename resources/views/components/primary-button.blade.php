<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-coral text-white rounded-full font-semibold text-xs uppercase tracking-widest hover:bg-coral-hover focus:outline-none focus:ring-2 focus:ring-coral focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
