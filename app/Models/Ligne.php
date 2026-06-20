<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ligne extends Model
{
    //
     protected $fillable = ['nom', 'ville_depart', 'ville_arrivee'];

    public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }
}
