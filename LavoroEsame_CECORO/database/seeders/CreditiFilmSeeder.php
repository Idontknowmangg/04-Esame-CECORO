<?php

namespace Database\Seeders;

use App\Models\ImpostazioniSito\CreditiFilm;
use Illuminate\Database\Seeder;

class CreditiFilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CreditiFilm::create([
            'idCreditiFilm' => 1,
            'idFilm' => 1,
            'creditiNecessari' => 150
        ]);

        CreditiFilm::create([
            'idCreditiFilm' => 2,
            'idFilm' => 2,
            'creditiNecessari' => 0
        ]);

        CreditiFilm::create([
            'idCreditiFilm' => 3,
            'idFilm' => 3,
            'creditiNecessari' => 200
        ]);
    }
}
