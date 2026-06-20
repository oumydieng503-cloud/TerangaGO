@props(['type' => 'info'])

@php
$classes = match($type) {
    'success' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
    'error' => 'bg-red-50 text-red-800 border-red-200',
    'warning' => 'bg-amber-50 text-amber-800 border-amber-200',
    default => 'bg-sky-50 text-sky-800 border-sky-200',
};
@endphp

<div {{ $attributes->merge(['class' => 'rounded-xl border px-4 py-3 text-sm ' . $classes]) }}>
    {{ $slot }}
</div>
