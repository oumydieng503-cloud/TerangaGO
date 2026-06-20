<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Billet — TerangaGo</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|syne:600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css'])
</head>
<body class="bg-sand-50 font-sans py-8 print:py-0">
    <div class="max-w-md mx-auto px-4 print:max-w-none print:px-0">
        <x-boarding-pass :billet="$billet" />
        <div class="text-center mt-6 print:hidden">
            <button onclick="window.print()" class="bg-terracotta text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-terracotta-600">
                Imprimer / Enregistrer en PDF
            </button>
        </div>
    </div>
</body>
</html>
