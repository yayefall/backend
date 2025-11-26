<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // ✅ Importer le trait Sanctum

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // ✅ Sanctum ici

    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'avatar'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
