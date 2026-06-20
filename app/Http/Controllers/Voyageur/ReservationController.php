<?php

namespace App\Http\Controllers\Voyageur;

use App\Http\Controllers\Controller;
use App\Models\Trajet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Billet;
use App\Services\PaymentService;


class ReservationController extends Controller
{
    // Affiche le formulaire de choix du nombre de places pour un trajet donné
    public function create(Trajet $trajet)
    {
        return view('voyageur.reservations.create', compact('trajet'));
    }

    // Reçoit le nombre de places choisi, stocke temporairement en session, puis redirige
    public function chooseSeats(Request $request, Trajet $trajet)
    {
        $request->validate([
            'nb_places' => 'required|integer|min:1|max:' . $trajet->places_dispo,
        ]);

        // On stocke le choix en session en attendant la connexion (OTP) du voyageur
        session([
            'reservation_en_cours' => [
                'trajet_id' => $trajet->id,
                'nb_places' => $request->nb_places,
            ]
        ]);

        // Si déjà connecté, on va direct à la confirmation/paiement
        if (Auth::check()) {
            return redirect()->route('voyageur.reservations.confirm');
        }

        // Sinon, on passe par l'étape OTP (connexion/inscription rapide)
        return redirect()->route('voyageur.login');
    }

    // ... dans la classe, ajoute ces 2 méthodes :

    public function confirm()
    {
        $data = session('reservation_en_cours');

        if (!$data) {
            return redirect()->route('home')->with('error', 'Aucune réservation en cours.');
        }

        $trajet = Trajet::with('ligne', 'bus')->findOrFail($data['trajet_id']);
        $nbPlaces = $data['nb_places'];
        $total = $trajet->prix * $nbPlaces;

        return view('voyageur.reservations.confirm', compact('trajet', 'nbPlaces', 'total'));
    }

    public function pay(PaymentService $paymentService)
    {
        $data = session('reservation_en_cours');

        if (!$data) {
            return redirect()->route('home')->with('error', 'Aucune réservation en cours.');
        }

        $trajet = Trajet::findOrFail($data['trajet_id']);
        $nbPlaces = $data['nb_places'];
        $total = $trajet->prix * $nbPlaces;

        // Vérifie qu'il y a encore assez de places (sécurité contre les réservations concurrentes)
        if ($trajet->places_dispo < $nbPlaces) {
            return redirect()->route('home')->with('error', 'Plus assez de places disponibles.');
        }

        // Appel du service de paiement (simulé pour l'instant)
        $resultatPaiement = $paymentService->payer($total, Auth::user()->telephone);

        if (!$resultatPaiement['success']) {
            return back()->with('error', 'Le paiement a échoué : ' . $resultatPaiement['message']);
        }

        // Création de la réservation confirmée
        $reservation = Reservation::create([
            'user_id'   => Auth::id(),
            'trajet_id' => $trajet->id,
            'nb_places' => $nbPlaces,
            'statut'    => 'confirmee',
        ]);

        // Génération automatique du billet (le code_billet se génère seul, voir Billet::boot())
        $billet = Billet::create([
            'reservation_id' => $reservation->id,
            'statut'          => 'non_valide',
        ]);

        // On décrémente les places disponibles
        $trajet->decrement('places_dispo', $nbPlaces);

        // Nettoyage de la session
        session()->forget('reservation_en_cours');

        return redirect()->route('voyageur.reservations.success', $billet);
    }
    public function success(Billet $billet)
    {
        $billet->load('reservation.trajet.ligne', 'reservation.trajet.bus');

        if ($billet->reservation->user_id !== Auth::id()) {
            abort(403);
        }

        return view('voyageur.reservations.success', compact('billet'));
    }
}
