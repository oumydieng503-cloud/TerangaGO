<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $table = 'bus';
    protected $fillable = ['numero', 'capacite', 'operateur_id'];

    public function operateur()
    {
        return $this->belongsTo(User::class, 'operateur_id');
    }

    public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }
}