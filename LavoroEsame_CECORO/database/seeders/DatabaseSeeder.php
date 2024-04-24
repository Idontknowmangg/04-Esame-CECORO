<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            ContattiSeeder::class,
            ContattiStatoSeeder::class,
            ContattiRuoliSeeder::class,
            ContattiContattiRuoliSeeder::class,
            GenereSeeder::class,
            AttoriSeeder::class,
            CreditiSeeder::class,
            SottotitoliSeeder::class,
            ImmaginiFilmSeeder::class,
            ImmaginiSerieTVSeeder::class,
            ImmaginiDocumentarioSeeder::class,
            VediFilmSeeder::class,
            VediSerieTVSeeder::class,
            VediDocumentarioSeeder::class,
            FilmSeeder::class,
            SerieTVSeeder::class,
            DocumentariSeeder::class,
            FilmHasGenereSeeder::class,
            SerieTVHasGenereSeeder::class,
            StagioniEpisodiSeeder::class,
            DocumentarioHasGenereSeeder::class,
            CreditiFilmSeeder::class,
            CreditiSerieTVSeeder::class,
            CreditiDocumentarioSeeder::class,
            NazioniSeeder::class
        ]);
    }
}
