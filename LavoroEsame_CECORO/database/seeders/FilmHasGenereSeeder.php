<?php

namespace Database\Seeders;

use App\Models\ImpostazioniGenere\Film_hasGenere;
use Illuminate\Database\Seeder;

class FilmHasGenereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Film_hasGenere::create([
            "idTracciaFilm" => 1,
            "idFilm" => 1,
            "idGenere" => 1
        ]);

        Film_hasGenere::create([
            "idTracciaFilm" => 2,
            "idFilm" => 2,
            "idGenere" => 2
        ]);

        Film_hasGenere::create([
            "idTracciaFilm" => 3,
            "idFilm" => 3,
            "idGenere" => 3
        ]);
    }
}
