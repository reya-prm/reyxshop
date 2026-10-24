@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-border focus:border-coral focus:ring-coral rounded-xl shadow-sm']) }}>
