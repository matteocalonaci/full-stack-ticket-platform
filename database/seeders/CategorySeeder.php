<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categorie da inserire con le loro descrizioni
        $categories = [
            [
                'name' => 'Supporto Tecnico',
                'description' => 'Assistenza per problemi tecnici e malfunzionamenti.'
            ],
            [
                'name' => 'Fatturazione',
                'description' => 'Domande relative a fatture e pagamenti.'
            ],
            [
                'name' => 'Richieste Generali',
                'description' => 'Richieste di informazioni generali sui servizi.'
            ],
            [
                'name' => 'Feedback',
                'description' => 'Commenti e suggerimenti sui nostri servizi.'
            ],
            [
                'name' => 'Problemi di Accesso',
                'description' => 'Assistenza per problemi di accesso agli account.'
            ],
            [
                'name' => 'Suggerimenti',
                'description' => 'Suggerimenti per migliorare i nostri servizi.'
            ],
            [
                'name' => 'Segnalazione Bug',
                'description' => 'Segnalazione di errori o malfunzionamenti nel sistema.'
            ],
            [
                'name' => 'Richieste di Funzionalità',
                'description' => 'Richieste per nuove funzionalità o miglioramenti.'
            ],
        ];

        // Inserisci le categorie nel database
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
