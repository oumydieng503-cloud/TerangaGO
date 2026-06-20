<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    protected $fillable = [
        'ligne_id',
        'bus_id',
        'date_depart',
        'heure_depart',
        'prix',
        'places_dispo',
    ];

    public function ligne()
    {
        return $this->belongsTo(Ligne::class);
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}