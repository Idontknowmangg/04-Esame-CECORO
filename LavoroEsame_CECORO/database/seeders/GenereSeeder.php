<?php

namespace Database\Seeders;

use App\Models\ImpostazioniGenere\Genere;
use Illuminate\Database\Seeder;

class GenereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genere::create([
            "idGenere" => 1,
            "nomeGenere" => "Azione"
        ]);

        Genere::create([
            "idGenere" => 2,
            "nomeGenere" => "Thriller"
        ]);

        Genere::create([
            "idGenere" => 3,
            "nomeGenere" => "Drama"
        ]);

        Genere::create([
            "idGenere" => 4,
            "nomeGenere" => "Horror"
        ]);

        Genere::create([
            "idGenere" => 5,
            "nomeGenere" => "Commedia"
        ]);
    }
}
