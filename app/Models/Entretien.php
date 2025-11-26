<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entretien extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicule_id',
        'date_entretien',
        'type',
        'remarques',
    ];

    protected $casts = [
        'date_entretien' => 'date',
    ];

    // 🔗 Relation : l’entretien concerne un véhicule
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}
