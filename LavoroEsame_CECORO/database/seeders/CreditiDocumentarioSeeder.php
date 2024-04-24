<?php

namespace Database\Seeders;

use App\Models\ImpostazioniSito\CreditiDocumentario;
use Illuminate\Database\Seeder;

class CreditiDocumentarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CreditiDocumentario::create([
            'idCreditiDocumentario' => 1,
            'idDocumentario' => 1,
            'creditiNecessari' => 0
        ]);

        CreditiDocumentario::create([
            'idCreditiDocumentario' => 2,
            'idDocumentario' => 2,
            'creditiNecessari' => 100
        ]);

        CreditiDocumentario::create([
            'idCreditiDocumentario' => 3,
            'idDocumentario' => 3,
            'creditiNecessari' => 500
        ]);
    }
}
