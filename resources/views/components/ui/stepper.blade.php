@props(['steps' => [], 'current' => 1])

<nav aria-label="Progression" class="mb-8">
    <ol class="flex items-center justify-between gap-2">
        @foreach($steps as $index => $step)
            @php $stepNum = $index + 1; $active = $stepNum <= $current; $currentStep = $stepNum === $current; @endphp
            <li class="flex-1 flex flex-col items-center gap-2">
                <span class="flex h-8 w-8 items-center justify-center rounded-full text-xs font-bold transition
                    {{ $currentStep ? 'bg-terracotta text-white ring-4 ring-terracotta/20' : ($active ? 'bg-forest text-white' : 'bg-sand-200 text-charcoal/40') }}">
                    {{ $stepNum }}
                </span>
                <span class="text-xs text-center font-medium {{ $currentStep ? 'text-terracotta' : 'text-charcoal/50' }} hidden sm:block">{{ $step }}</span>
            </li>
            @if(!$loop->last)
                <div class="h-0.5 flex-1 {{ $stepNum < $current ? 'bg-forest' : 'bg-sand-200' }} -mt-6"></div>
            @endif
        @endforeach
    </ol>
</nav>
