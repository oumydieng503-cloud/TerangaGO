<?php

namespace App\Http\Controllers\Operateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trajet;
use App\Models\Ligne;
use App\Models\Bus;
use Illuminate\Support\Facades\Auth;

class TrajetController extends Controller
{
    public function index()
    {
        $trajets = Trajet::whereHas('bus', function ($query) {
            $query->where('operateur_id', Auth::id());
        })->with('ligne', 'bus')->get();

        return view('operateur.trajets.index', compact('trajets'));
    }

    public function create()
    {
        $lignes = Ligne::all();
        // Seulement les bus de cet opérateur
        $buses = Bus::where('operateur_id', Auth::id())->get();

        return view('operateur.trajets.create', compact('lignes', 'buses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ligne_id'     => 'required|exists:lignes,id',
            'bus_id'       => 'required|exists:bus,id',
            'date_depart'  => 'required|date',
            'heure_depart' => 'required|date_format:H:i',
            'prix'         => 'required|numeric|min:0',
            'places_dispo' => 'required|integer|min:0',
        ]);

        // Sécurité : vérifie que le bus choisi appartient bien à l'opérateur
        $bus = Bus::where('id', $request->bus_id)
                  ->where('operateur_id', Auth::id())
                  ->firstOrFail();

        Trajet::create([
            'ligne_id'     => $request->ligne_id,
            'bus_id'       => $request->bus_id,
            'date_depart'  => $request->date_depart,
            'heure_depart' => $request->heure_depart,
            'prix'         => $request->prix,
            'places_dispo' => $request->places_dispo,
        ]);

        return redirect()->route('operateur.trajets.index')->with('success', 'Trajet créé avec succès.');
    }

    public function edit(Trajet $trajet)
    {
        // Sécurité : vérifie que ce trajet appartient bien à un bus de l'opérateur
        if ($trajet->bus->operateur_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        $lignes = Ligne::all();
        $buses = Bus::where('operateur_id', Auth::id())->get();

        return view('operateur.trajets.edit', compact('trajet', 'lignes', 'buses'));
    }

    public function update(Request $request, Trajet $trajet)
    {
        if ($trajet->bus->operateur_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        $request->validate([
            'ligne_id'     => 'required|exists:lignes,id',
            'bus_id'       => 'required|exists:bus,id',
            'date_depart'  => 'required|date',
            'heure_depart' => 'required|date_format:H:i',
            'prix'         => 'required|numeric|min:0',
            'places_dispo' => 'required|integer|min:0',
        ]);

        $bus = Bus::where('id', $request->bus_id)
                  ->where('operateur_id', Auth::id())
                  ->firstOrFail();

        $trajet->update($request->only([
            'ligne_id', 'bus_id', 'date_depart', 'heure_depart', 'prix', 'places_dispo'
        ]));

        return redirect()->route('operateur.trajets.index')->with('success', 'Trajet mis à jour avec succès.');
    }

    public function destroy(Trajet $trajet)
    {
        if ($trajet->bus->operateur_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        $trajet->delete();
        return redirect()->route('operateur.trajets.index')->with('success', 'Trajet supprimé avec succès.');
    }
}