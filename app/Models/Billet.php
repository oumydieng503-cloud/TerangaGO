<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Billet extends Model
{
    protected $fillable = [
        'reservation_id',
        'code_billet',
        'statut',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($billet) {
            $billet->code_billet = strtoupper(Str::random(10));
        });
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}