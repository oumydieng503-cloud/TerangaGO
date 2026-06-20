<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Tableau de bord' }} — {{ config('transport.brand') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|syne:600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sand-50 font-sans antialiased">
    @include('layouts.partials.toast')

    <div class="flex min-h-screen">
        @include('layouts.partials.sidebar')

        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-white border-b border-sand-200 px-6 py-5 lg:hidden">
                <p class="font-display font-bold text-lg"><span class="text-terracotta">Teranga</span>Go</p>
            </header>

            @if(isset($header) && $header)
            <div class="bg-white border-b border-sand-200 px-6 py-5">
                <div class="font-display text-xl font-bold text-charcoal">{{ $header }}</div>
            </div>
            @endif

            <main class="flex-1 p-6 overflow-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
