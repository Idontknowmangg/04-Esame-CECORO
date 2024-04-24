<?php

namespace Database\Seeders;

use App\Models\ImpostazioniSito\CreditiSerieTV;
use Illuminate\Database\Seeder;

class CreditiSerieTVSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CreditiSerieTV::create([
            'idCreditiSerieTV' => 1,
            'idSerieTV' => 1,
            'creditiNecessari' => 50
        ]);

        CreditiSerieTV::create([
            'idCreditiSerieTV' => 2,
            'idSerieTV' => 2,
            'creditiNecessari' => 300
        ]);

        CreditiSerieTV::create([
            'idCreditiSerieTV' => 3,
            'idSerieTV' => 3,
            'creditiNecessari' => 500
        ]);
    }
}
