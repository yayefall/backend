<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Crée 5 utilisateurs aléatoires
        User::factory()->count(4)->create();

        // Crée un utilisateur admin fixe
       User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin123'), // sera hashé par le mutator
            'role' => 'admin',
        ]);
    }
}
