<?php

namespace Database\Seeders;

use App\Models\ImpostazioniGenere\SerieTV_hasGenere;
use Illuminate\Database\Seeder;

class SerieTVHasGenereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SerieTV_hasGenere::create([
            "idTracciaSerieTV" => 1,
            "idSerieTV" => 1,
            "idGenere" => 1
        ]);

        SerieTV_hasGenere::create([
            "idTracciaSerieTV" => 2,
            "idSerieTV" => 2,
            "idGenere" => 2
        ]);

        SerieTV_hasGenere::create([
            "idTracciaSerieTV" => 3,
            "idSerieTV" => 3,
            "idGenere" => 3
        ]);
    }
}
