<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'permis',
    ];

    // 🔗 Relation : un chauffeur peut conduire plusieurs véhicules
    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }
}
