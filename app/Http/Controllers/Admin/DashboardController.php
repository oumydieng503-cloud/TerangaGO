<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ligne;
use App\Models\Bus;
use App\Models\Trajet;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $nbVoyageurs = User::where('role', 'voyageur')->count();
        $nbOperateurs = User::where('role', 'operateur')->count();
        $nbAdmins = User::where('role', 'admin')->count();

        $nbLignes = Ligne::count();
        $nbBus = Bus::count();
        $nbTrajets = Trajet::count();
        $nbReservations = Reservation::count();

        return view('admin.dashboard', compact(
            'nbVoyageurs',
            'nbOperateurs',
            'nbAdmins',
            'nbLignes',
            'nbBus',
            'nbTrajets',
            'nbReservations'
        ));
    }
}