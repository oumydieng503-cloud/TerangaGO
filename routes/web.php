<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LigneController;

// Page d'accueil publique
Route::get('/', [\App\Http\Controllers\TrajetPublicController::class, 'index'])->name('home');

// Dashboard générique de Breeze (pas vraiment utilisé, gardé par défaut)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ===========================
// Routes Voyageur
// ===========================
Route::middleware(['auth', 'role:voyageur'])->prefix('voyageur')->name('voyageur.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Voyageur\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/reservations/confirm', [\App\Http\Controllers\Voyageur\ReservationController::class, 'confirm'])->name('reservations.confirm');
    Route::post('/reservations/pay', [\App\Http\Controllers\Voyageur\ReservationController::class, 'pay'])->name('reservations.pay');
    Route::get('/reservations/{billet}/success', [\App\Http\Controllers\Voyageur\ReservationController::class, 'success'])->name('reservations.success');
    Route::get('/billets/{billet}/qr', [\App\Http\Controllers\Voyageur\BilletController::class, 'qr'])->name('billets.qr');
    Route::get('/billets/{billet}/pdf', [\App\Http\Controllers\Voyageur\BilletController::class, 'pdf'])->name('billets.pdf');
});

// ===========================
// Routes Opérateur
// ===========================
Route::middleware(['auth', 'role:operateur'])->prefix('operateur')->name('operateur.')->group(function () {
    // Dashboard avec statistiques (bus, trajets, réservations, départs du jour)
    Route::get('/dashboard', [\App\Http\Controllers\Operateur\DashboardController::class, 'index'])->name('dashboard');

    // CRUD des trajets appartenant aux bus de l'opérateur connecté
    Route::resource('trajets', \App\Http\Controllers\Operateur\TrajetController::class);

    // Liste des réservations sur les trajets de l'opérateur (lecture seule)
    Route::get('/reservations', [\App\Http\Controllers\Operateur\ReservationController::class, 'index'])->name('reservations.index');
    // Liste des billets sur mes trajets
    Route::get('/billets', [\App\Http\Controllers\Operateur\BilletController::class, 'index'])->name('billets.index');
// Validation manuelle d'un billet via son code
    Route::post('/billets/valider', [\App\Http\Controllers\Operateur\BilletController::class, 'valider'])->name('billets.valider');
});

// ===========================
// Routes Administrateur
// ===========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard avec statistiques globales de la plateforme
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // CRUD complet : utilisateurs, lignes, bus, trajets
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('lignes', \App\Http\Controllers\Admin\LigneController::class);
    Route::resource('buses', \App\Http\Controllers\Admin\BusController::class);
    Route::resource('trajets', \App\Http\Controllers\Admin\TrajetController::class);
});

// ===========================
// Routes communes à tous les utilisateurs connectés (profil Breeze)
// ===========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Authentification Voyageur par OTP (sans mot de passe)
Route::prefix('voyageur')->name('voyageur.')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Voyageur\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/send-otp', [\App\Http\Controllers\Voyageur\AuthController::class, 'sendOtp'])->name('send-otp');
    Route::get('/verify-otp', [\App\Http\Controllers\Voyageur\AuthController::class, 'showVerifyForm'])->name('verify-otp.form');
    Route::post('/verify-otp', [\App\Http\Controllers\Voyageur\AuthController::class, 'verifyOtp'])->name('verify-otp');
    Route::post('/logout', [\App\Http\Controllers\Voyageur\AuthController::class, 'logout'])->name('logout');
});
// Réservation : choix du trajet et du nombre de places (accessible sans connexion)
Route::get('/voyageur/trajets/{trajet}/reserver', [\App\Http\Controllers\Voyageur\ReservationController::class, 'create'])->name('voyageur.reservations.create');
Route::post('/voyageur/trajets/{trajet}/reserver', [\App\Http\Controllers\Voyageur\ReservationController::class, 'chooseSeats'])->name('voyageur.reservations.choose-seats');
// Routes d'authentification générées par Breeze (login, register, logout...)
require __DIR__.'/auth.php';