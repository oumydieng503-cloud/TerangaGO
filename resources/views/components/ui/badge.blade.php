@props(['variant' => 'neutral'])

@php
$classes = match($variant) {
    'success' => 'bg-emerald-50 text-emerald-800 ring-emerald-200',
    'warning' => 'bg-amber-50 text-amber-800 ring-amber-200',
    'danger' => 'bg-red-50 text-red-800 ring-red-200',
    'info' => 'bg-sky-50 text-sky-800 ring-sky-200',
    default => 'bg-sand-100 text-charcoal ring-sand-200',
};
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 ring-inset ' . $classes]) }}>
    {{ $slot }}
</span>
