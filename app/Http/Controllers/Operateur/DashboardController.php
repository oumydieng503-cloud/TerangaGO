<?php

namespace App\Http\Controllers\Operateur;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Trajet;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $operateurId = Auth::id();

        // Nombre de mes bus
        $nbBus = Bus::where('operateur_id', $operateurId)->count();

        // Mes trajets (via mes bus)
        $mesTrajets = Trajet::whereHas('bus', function ($query) use ($operateurId) {
            $query->where('operateur_id', $operateurId);
        })->get();

        $nbTrajets = $mesTrajets->count();

        // Places encore disponibles (somme sur tous mes trajets)
        $totalPlacesDispo = $mesTrajets->sum('places_dispo');

        // Réservations sur mes trajets
        $nbReservations = Reservation::whereHas('trajet.bus', function ($query) use ($operateurId) {
            $query->where('operateur_id', $operateurId);
        })->count();

        // Départs du jour
        $departsDuJour = Trajet::whereHas('bus', function ($query) use ($operateurId) {
            $query->where('operateur_id', $operateurId);
        })->whereDate('date_depart', today())->with('ligne')->get();

        return view('operateur.dashboard', compact(
            'nbBus',
            'nbTrajets',
            'totalPlacesDispo',
            'nbReservations',
            'departsDuJour'
        ));
    }
}