@props(['padding' => true])

<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl shadow-card border border-sand-200/80 clip-route' . ($padding ? ' p-6' : '')]) }}>
    {{ $slot }}
</div>
