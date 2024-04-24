<?php

namespace Database\Seeders;

use App\Models\ImpostazioniAdmin\Attori;
use Illuminate\Database\Seeder;

class AttoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attori::create([
            "idAttore" => 1,
            "nomeAttore" => "Luis",
            "cognomeAttore" => "Ticklen",
            "annoNascita" => 1977
        ]);

        Attori::create([
            "idAttore" => 2,
            "nomeAttore" => "Barry",
            "cognomeAttore" => "Mobtlen",
            "annoNascita" => 1981
        ]);

        Attori::create([
            "idAttore" => 3,
            "nomeAttore" => "Jack",
            "cognomeAttore" => "White",
            "annoNascita" => 2001
        ]);
    }
}
