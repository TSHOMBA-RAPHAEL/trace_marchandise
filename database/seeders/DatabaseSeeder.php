<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. L'Administrateur du système (Gère les comptes)
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@trace.cd',
            'password' => Hash::make('1234'),
            'role' => 'admin',
        ]);

        // 2. L'Agent d'enregistrement (Enregistre les marchandises)
        User::create([
            'name' => 'Agent Enregistrement',
            'email' => 'agent@trace.cd',
            'password' => Hash::make('1234'),
            'role' => 'agent',
        ]);

        // 3. Le Contrôleur Douanier (Vérifie et valide)
        User::create([
            'name' => 'Contrôleur Douane',
            'email' => 'controleur@trace.cd',
            'password' => Hash::make('1234'),
            'role' => 'controleur',
        ]);
    }
}