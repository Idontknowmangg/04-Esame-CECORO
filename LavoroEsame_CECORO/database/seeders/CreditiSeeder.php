<?php

namespace Database\Seeders;

use App\Models\ImpostazioniSito\Crediti;
use Illuminate\Database\Seeder;

class CreditiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Crediti::create([
            'idCrediti' => 1,
            'idContatto' => 1,
            'crediti' => 0
        ]);

        Crediti::create([
            'idCrediti' => 2,
            'idContatto' => 2,
            'crediti' => 0
        ]);

        Crediti::create([
            'idCrediti' => 3,
            'idContatto' => 3,
            'crediti' => 0
        ]);
    }
}
