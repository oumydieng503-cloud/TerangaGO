@props(['label' => '', 'name' => '', 'type' => 'text', 'datalist' => null])

<div>
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-charcoal/80 mb-1.5">{{ $label }}</label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        @if($datalist) list="{{ $datalist }}" @endif
        {{ $attributes->merge(['class' => 'w-full rounded-xl border-sand-200 bg-white px-4 py-2.5 text-charcoal shadow-sm focus:border-terracotta focus:ring-terracotta']) }}
    />
    @if($datalist)
        <datalist id="{{ $datalist }}">
            @foreach(config('transport.cities') as $city)
                <option value="{{ $city }}"></option>
            @endforeach
        </datalist>
    @endif
</div>
