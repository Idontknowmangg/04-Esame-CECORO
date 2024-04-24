<?php

namespace Database\Seeders;

use App\Models\ImpostazioniAdmin\Contatti_ContattiRuoli;
use Illuminate\Database\Seeder;

class ContattiContattiRuoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contatti_ContattiRuoli::create([
            'idTracciaUtente' => 1,
            'idContatto' => 1,
            'idContattoRuolo' => 1 
        ]);

        Contatti_ContattiRuoli::create([
            'idTracciaUtente' => 2,
            'idContatto' => 2,
            'idContattoRuolo' => 2 
        ]);

        Contatti_ContattiRuoli::create([
            'idTracciaUtente' => 3,
            'idContatto' => 3,
            'idContattoRuolo' => 3 
        ]);
    }
}
