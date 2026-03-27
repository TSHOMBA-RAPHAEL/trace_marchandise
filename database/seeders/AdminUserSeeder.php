<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@trace.cd',
            'password' => Hash::make('1234'), // Votre mot de passe sera '1234'
        ]);
    }
}