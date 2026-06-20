<?php

namespace App\Http\Controllers\Voyageur;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with('trajet.ligne', 'trajet.bus', 'billet')
            ->latest()
            ->get();

        return view('voyageur.dashboard', compact('reservations'));
    }
}