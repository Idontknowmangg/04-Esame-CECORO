<?php

namespace Database\Seeders;

use App\Models\ImpostazioniAdmin\ContattiStato;
use Illuminate\Database\Seeder;

class ContattiStatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContattiStato::create([
            'idContattoStato' => 1,
            'idContatto' => 1,
            'statoUtente' => 1,
            'isBanned' => 0,
            'isRegistered' => 0
        ]);

        ContattiStato::create([
            'idContattoStato' => 2,
            'idContatto' => 2,
            'statoUtente' => 0,
            'isBanned' => 0,
            'isRegistered' => 1
        ]);

        ContattiStato::create([
            'idContattoStato' => 3,
            'idContatto' => 3,
            'statoUtente' => 1,
            'isBanned' => 1,
            'isRegistered' => 0
        ]);
    }
}
