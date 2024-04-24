<?php

namespace Database\Seeders;

use App\Models\MainContent\Film;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Film::create([
            'idFilm' => 1,
            'titoloFilm' => 'Il primo film',
            'idGenere' => 3,
            'idImmagineFilm' => 1,
            'idFormatoFilm' => 1,
            'descrizione' => 'La descrizione del primo film',
            'regista' => 'S. Spielberg',
            'anno' => 2012,
            'durata' => '98 min'
        ]);

        Film::create([
            'idFilm' => 2,
            'titoloFilm' => 'Il secondo film',
            'idGenere' => 5,
            'idImmagineFilm' => 2,
            'idFormatoFilm' => 2,
            'descrizione' => 'La descrizione del secondo film',
            'regista' => 'S. Spielberg',
            'anno' => 2002,
            'durata' => '102 min'
        ]);

        Film::create([
            'idFilm' => 3,
            'titoloFilm' => 'Il terzo film',
            'idGenere' => 2,
            'idImmagineFilm' => 3,
            'idFormatoFilm' => 3,
            'descrizione' => 'La descrizione del terzo film',
            'regista' => 'S. Spielberg',
            'anno' => 1998,
            'durata' => '138 min'
        ]);
    }
}
