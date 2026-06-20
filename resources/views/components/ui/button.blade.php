@props(['variant' => 'primary', 'type' => 'button', 'href' => null])

@php
$classes = match($variant) {
    'primary' => 'bg-terracotta text-white hover:bg-terracotta-600 focus:ring-terracotta',
    'secondary' => 'bg-forest text-white hover:bg-forest-600 focus:ring-forest',
    'outline' => 'border-2 border-terracotta text-terracotta hover:bg-terracotta hover:text-white focus:ring-terracotta',
    'ghost' => 'text-charcoal hover:bg-sand-100 focus:ring-sand-200',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
    default => 'bg-terracotta text-white hover:bg-terracotta-600',
};
$base = 'inline-flex items-center justify-center gap-2 rounded-xl px-5 py-2.5 text-sm font-semibold transition focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 ' . $classes;
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $base]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $base]) }}>{{ $slot }}</button>
@endif
