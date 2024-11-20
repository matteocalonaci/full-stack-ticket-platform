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
        $adminUser =[
            'name' => 'Admin User', // Nome dell'admin
            'email' => 'admin@example.com', // Email dell'admin
            'password' => Hash::make('password')
        ];

            // Crea o aggiorna l'utente admin
            User::updateOrCreate(
                [
                    'email' => $adminUser ['email']],
                     // Cerca per email
                [
                    'name' => $adminUser ['name'],
                    'password' => $adminUser ['password']
                ]
            );
    }
}
