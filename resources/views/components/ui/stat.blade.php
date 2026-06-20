@props(['label', 'value', 'color' => 'terracotta'])

@php
$colorClass = match($color) {
    'forest' => 'text-forest',
    'terracotta' => 'text-terracotta',
    'amber' => 'text-amber-600',
    'sky' => 'text-sky-600',
    default => 'text-terracotta',
};
@endphp

<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl border border-sand-200 p-5 shadow-card']) }}>
    <p class="text-3xl font-display font-bold {{ $colorClass }}">{{ $value }}</p>
    <p class="text-sm text-charcoal/60 mt-1">{{ $label }}</p>
</div>
