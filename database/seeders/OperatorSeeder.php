<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Operator;
use Faker\Factory as Faker;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inizializza Faker
        $faker = Faker::create();

        // Definisci gli stati possibili
        $states = ['online', 'offline', 'occupato'];

        // Definisci le specializzazioni
        $specializations = [
            'Supporto Tecnico',
            'Fatturazione',
            'Gestione Reclami',
            'Assistenza Clienti',
            'Sistemi Informatici',
            'Sicurezza Informatica',
            'Integrazione Software',
            'Formazione Utenti',
            'Analisi Dati',
            'Gestione Progetti',
            'Sviluppo Software',
            'Networking',
            'Manutenzione Hardware',
            'Supporto per Applicazioni',
            'Gestione Incidenti',
            'Ottimizzazione Processi',
            'Consulenza IT',
            'Servizi Cloud',
            'Assistenza Remota',
            'Supporto per Dispositivi Mobili',
        ];

        // Crea 10 operatori con dati casuali
        for ($i = 0; $i < 10; $i++) {
            // Seleziona da 1 a 3 specializzazioni casuali
            $selectedSpecializations = $faker->randomElements($specializations, $faker->numberBetween(1, 3));
             // Converte l'array in una stringa separata da virgole
            $specializationString = implode(', ', $selectedSpecializations);

            Operator::create([
                'email' => $faker->unique()->safeEmail(),
                'password' => bcrypt('password'),
                'state' => $faker->randomElement($states),
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'specialization' => $specializationString,
            ]);
        };

        // $category->operator_category()->attach($data['category']);

    }
}
