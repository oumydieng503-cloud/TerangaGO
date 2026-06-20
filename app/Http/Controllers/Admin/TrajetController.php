<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trajet;
use App\Models\Ligne;
use App\Models\Bus;

class TrajetController extends Controller
{
    public function index()
    {
        $trajets = Trajet::with('ligne', 'bus')->get();
        return view('admin.trajets.index', compact('trajets'));
    }

    public function create()
    {
        $lignes = Ligne::all();
        $buses = Bus::all();
        return view('admin.trajets.create', compact('lignes', 'buses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ligne_id'    => 'required|exists:lignes,id',
            'bus_id'      => 'required|exists:bus,id',
            'date_depart' => 'required|date',
            'heure_depart'=> 'required|date_format:H:i',
            'prix'        => 'required|numeric|min:0',
            'places_dispo'=> 'required|integer|min:0',
        ]);

        Trajet::create([
            'ligne_id'    => $request->ligne_id,
            'bus_id'      => $request->bus_id,
            'date_depart' => $request->date_depart,
            'heure_depart'=> $request->heure_depart,
            'prix'        => $request->prix,
            'places_dispo'=> $request->places_dispo,
        ]);

        return redirect()->route('admin.trajets.index')->with('success', 'Trajet créé avec succès.');
    }

    public function show(Trajet $trajet)
    {
        //
    }

    public function edit(Trajet $trajet)
    {
        $lignes = Ligne::all();
        $buses = Bus::all();
        return view('admin.trajets.edit', compact('trajet', 'lignes', 'buses'));
    }

    public function update(Request $request, Trajet $trajet)
    {
        $request->validate([
            'ligne_id'    => 'required|exists:lignes,id',
            'bus_id'      => 'required|exists:bus,id',
            'date_depart' => 'required|date',
            'heure_depart'=> 'required|date_format:H:i',
            'prix'        => 'required|numeric|min:0',
            'places_dispo'=> 'required|integer|min:0',
        ]);

        $trajet->ligne_id    = $request->ligne_id;
        $trajet->bus_id      = $request->bus_id;
        $trajet->date_depart = $request->date_depart;
        $trajet->heure_depart= $request->heure_depart;
        $trajet->prix        = $request->prix;
        $trajet->places_dispo= $request->places_dispo;
        $trajet->save();

        return redirect()->route('admin.trajets.index')->with('success', 'Trajet mis à jour avec succès.');
    }

    public function destroy(Trajet $trajet)
    {
        $trajet->delete();
        return redirect()->route('admin.trajets.index')->with('success', 'Trajet supprimé avec succès.');
    }
}