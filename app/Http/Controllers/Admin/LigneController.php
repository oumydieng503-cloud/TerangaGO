<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ligne;

class LigneController extends Controller
{
    public function index()
    {
        $lignes = Ligne::all();
        return view('admin.lignes.index', compact('lignes'));
    }

    public function create()
    {
        return view('admin.lignes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'ville_depart' => 'required|string|max:255',
            'ville_arrivee' => 'required|string|max:255',
        ]);

        Ligne::create([
            'nom' => $request->nom,
            'ville_depart' => $request->ville_depart,
            'ville_arrivee' => $request->ville_arrivee,
        ]);

        return redirect()->route('admin.lignes.index')->with('success', 'Ligne créée avec succès.');
    }

    public function show(Ligne $ligne)
    {
        //
    }

    public function edit(Ligne $ligne)
    {
        return view('admin.lignes.edit', compact('ligne'));
    }

    public function update(Request $request, Ligne $ligne)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'ville_depart' => 'required|string|max:255',
            'ville_arrivee' => 'required|string|max:255',
        ]);

        $ligne->nom = $request->nom;
        $ligne->ville_depart = $request->ville_depart;
        $ligne->ville_arrivee = $request->ville_arrivee;
        $ligne->save();

        return redirect()->route('admin.lignes.index')->with('success', 'Ligne mise à jour avec succès.');
    }

    public function destroy(Ligne $ligne)
    {
        $ligne->delete();
        return redirect()->route('admin.lignes.index')->with('success', 'Ligne supprimée avec succès.');
    }
}