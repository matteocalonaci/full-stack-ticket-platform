<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use Faker\Factory as Faker;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inizializza Faker
        $faker = Faker::create();

        // Definisci gli stati possibili
        $states = ['assegnato', 'in lavorazione', 'chiuso'];

        // Crea 10 ticket con dati casuali
        for ($i = 0; $i < 10; $i++) {
            Ticket::create([
                'title' => $faker->sentence(6, true), // Titolo casuale
                'state' => $faker->randomElement($states), // Stato casuale
                'date' => $faker->date(), // Data casuale
                'description' => $faker->paragraph(3, true), // Descrizione casuale
                'operator_id' => $faker->numberBetween(1, 10), // ID operatore casuale (assumendo che ci siano operatori con ID da 1 a 10)
                'category_id' => $faker->numberBetween(1, 5), // ID categoria casuale (assumendo che ci siano categorie con ID da 1 a 5)
            ]);
        }
    }
}
