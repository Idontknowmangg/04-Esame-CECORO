<?php

namespace Database\Seeders;

use App\Models\ImpostazioniAdmin\ContattiRuoli;
use Illuminate\Database\Seeder;

class ContattiRuoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContattiRuoli::create([
            "idContattoRuolo" => 1,
            "nomeRuolo" => "Ospite",
            "lvlRuolo" => 1
        ]);

        ContattiRuoli::create([
            "idContattoRuolo" => 2,
            "nomeRuolo" => "Utente",
            "lvlRuolo" => 2
        ]);

        ContattiRuoli::create([
            "idContattoRuolo" => 3,
            "nomeRuolo" => "Admin",
            "lvlRuolo" => 3
        ]);
    }
}
