<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea un utente admin
        User::create([
            'name' => 'Admin User', // Nome dell'admin
            'email' => 'admin@example.com', // Email dell'admin
            'password' => 'password', // Password criptata
            'email_verified_at' => now(), // Imposta la data di verifica dell'email
        ]);
    }
}
