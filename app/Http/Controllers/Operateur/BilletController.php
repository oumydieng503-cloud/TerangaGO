<?php

namespace App\Http\Controllers\Operateur;

use App\Http\Controllers\Controller;
use App\Models\Billet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BilletController extends Controller
{
    // Liste des billets sur les trajets de l'opérateur connecté
    public function index()
    {
        $billets = Billet::whereHas('reservation.trajet.bus', function ($query) {
            $query->where('operateur_id', Auth::id());
        })->with('reservation.trajet.ligne', 'reservation.user')->get();

        return view('operateur.billets.index', compact('billets'));
    }

    // Valide un billet (changement de statut)
    public function valider(Request $request)
    {
        $request->validate([
            'code_billet' => 'required|string',
        ]);

        $billet = Billet::where('code_billet', $request->code_billet)
            ->whereHas('reservation.trajet.bus', function ($query) {
                $query->where('operateur_id', Auth::id());
            })
            ->first();

        if (!$billet) {
            return back()->with('error', 'Billet introuvable ou ne vous appartient pas.');
        }

        if ($billet->statut === 'valide') {
            return back()->with('error', 'Ce billet a déjà été validé.');
        }

        $billet->statut = 'valide';
        $billet->save();

        return back()->with('success', 'Billet validé avec succès ! Voyageur : ' . $billet->reservation->user->name);
    }
}