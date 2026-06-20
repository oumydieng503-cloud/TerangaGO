<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trajet;

class TrajetPublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Trajet::with('ligne', 'bus')
            ->where('date_depart', '>=', today())
            ->where('places_dispo', '>', 0);

        if ($request->filled('ville_depart')) {
            $query->whereHas('ligne', function ($q) use ($request) {
                $q->where('ville_depart', 'like', '%' . $request->ville_depart . '%');
            });
        }

        if ($request->filled('ville_arrivee')) {
            $query->whereHas('ligne', function ($q) use ($request) {
                $q->where('ville_arrivee', 'like', '%' . $request->ville_arrivee . '%');
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('date_depart', $request->date);
        }

        $trajets = $query->orderBy('date_depart')->orderBy('heure_depart')->get();

        return view('welcome', compact('trajets'));
    }
}
