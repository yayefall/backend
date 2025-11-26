<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'immatriculation',
        'marque',
        'modele',
        'annee',
        'couleur',
        'driver_id',
        'statut',
        'remarques',
    ];

    // 🔗 Relation : un véhicule appartient à un chauffeur
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // 🔗 Relations secondaires
    public function lavage()
    {
        return $this->hasMany(Lavage::class);
    }

    public function entretien()
    {
        return $this->hasMany(Entretien::class);
    }
}
