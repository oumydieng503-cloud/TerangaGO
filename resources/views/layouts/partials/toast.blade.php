@if(session('success') || session('error'))
<div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 5000)"
    x-transition
    class="fixed top-4 right-4 z-[100] max-w-sm"
>
    @if(session('success'))
        <x-ui.alert type="success" class="shadow-lg">{{ session('success') }}</x-ui.alert>
    @endif
    @if(session('error'))
        <x-ui.alert type="error" class="shadow-lg">{{ session('error') }}</x-ui.alert>
    @endif
</div>
@endif
