<?php

namespace App\Http\Controllers\Voyageur;

use App\Http\Controllers\Controller;
use App\Models\Billet;
use App\Services\BilletQrService;
use Illuminate\Support\Facades\Auth;

class BilletController extends Controller
{
    public function qr(Billet $billet, BilletQrService $qrService)
    {
        $billet->load('reservation');

        if ($billet->reservation->user_id !== Auth::id()) {
            abort(403);
        }

        $svg = $qrService->generate($billet->code_billet);

        return response($svg, 200)->header('Content-Type', 'image/svg+xml');
    }

    public function pdf(Billet $billet)
    {
        $billet->load('reservation.trajet.ligne', 'reservation.trajet.bus');

        if ($billet->reservation->user_id !== Auth::id()) {
            abort(403);
        }

        return view('voyageur.billets.pdf', compact('billet'));
    }
}
