<?php

namespace App\Http\Controllers\Operateur;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::whereHas('trajet.bus', function ($query) {
            $query->where('operateur_id', Auth::id());
        })->with('trajet.ligne', 'user')->get();

        return view('operateur.reservations.index', compact('reservations'));
    }
}