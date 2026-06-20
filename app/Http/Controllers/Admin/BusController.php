<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\User;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buses = Bus::with('operateur')->get();
        return view('admin.buses.index', compact('buses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $operateurs = User::where('role', 'operateur')->get();
        return view('admin.buses.create', compact('operateurs'));
    }

    public function edit(Bus $bus)
    {
        $operateurs = User::where('role', 'operateur')->get();
        return view('admin.buses.edit', compact('bus', 'operateurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'numero' => 'required|string|max:255',
            'capacite' => 'required|integer|min:1',
            'operateur_id' => 'required|exists:users,id',
        ]);
        Bus::create([
            'numero' => $request->numero,
            'capacite' => $request->capacite,
            'operateur_id' => $request->operateur_id,
        ]);
        return redirect()->route('admin.buses.index')->with('success', 'Bus créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $bus = Bus::findOrFail($id);
        return view('admin.buses.show', compact('bus'));
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bus $bus)
    {
        $request->validate([
            'numero' => 'required|string|max:255',
            'capacite' => 'required|integer|min:1',
            'operateur_id' => 'required|exists:users,id',
        ]);
        $bus->numero = $request->numero;
        $bus->capacite = $request->capacite;
        $bus->operateur_id = $request->operateur_id;
        $bus->save();
        return redirect()->route('admin.buses.index')->with('success', 'Bus mis à jour avec succès.');
    }

    public function destroy(Bus $bus)
    {
        $bus->delete();
        return redirect()->route('admin.buses.index')->with('success', 'Bus supprimé avec succès.');
    }
}
