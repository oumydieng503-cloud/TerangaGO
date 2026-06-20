<?php

namespace App\Http\Controllers\Voyageur;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Affiche le formulaire de connexion (nom + téléphone)
    public function showLoginForm()
    {
        return view('voyageur.auth.login');
    }

    // Étape 1 : reçoit le téléphone, génère et "envoie" l'OTP
    public function sendOtp(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'telephone' => 'required|digits:9',
        ]);

        // Cherche un voyageur existant avec ce téléphone, sinon le crée
        $user = User::firstOrCreate(
            ['telephone' => $request->telephone],
            ['name' => $request->name, 'role' => 'voyageur']
        );

        // Génère un code OTP à 4 chiffres
        $otp = rand(1000, 9999);

        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        // Simulation d'envoi SMS : on le passe à la vue (et on le log aussi)
        Log::info("OTP pour {$user->telephone} : {$otp}");

        return redirect()->route('voyageur.verify-otp.form', ['telephone' => $user->telephone])
            ->with('otp_debug', $otp); // visible uniquement en dev, à retirer en prod
    }

    // Affiche le formulaire de saisie du code OTP
    public function showVerifyForm(Request $request)
    {
        return view('voyageur.auth.verify', ['telephone' => $request->telephone]);
    }

    // Étape 2 : vérifie le code OTP et connecte l'utilisateur
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'telephone' => 'required|digits:9',
            'otp_code'  => 'required|digits:4',
        ]);

        $user = User::where('telephone', $request->telephone)->first();

        if (!$user) {
            return back()->with('error', 'Utilisateur introuvable.');
        }

        if ($user->otp_code !== $request->otp_code) {
            return back()->with('error', 'Code incorrect.');
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            return back()->with('error', 'Code expiré, veuillez recommencer.');
        }

        // Code valide : on connecte l'utilisateur et on nettoie l'OTP
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        Auth::login($user);

        // Si une réservation était en cours, on continue ce parcours au lieu du dashboard
if (session()->has('reservation_en_cours')) {
    return redirect()->route('voyageur.reservations.confirm');
}

return redirect()->route('voyageur.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('voyageur.login');
    }
}