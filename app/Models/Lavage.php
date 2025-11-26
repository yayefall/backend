<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lavage extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicule_id',
        'date_lavage',
        'type',
        'effectué_par',
    ];

    protected $casts = [
        'date_lavage' => 'date',
    ];

    // 🔗 Relation : ce lavage concerne un véhicule
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}
