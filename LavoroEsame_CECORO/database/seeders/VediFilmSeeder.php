<?php

namespace Database\Seeders;

use App\Models\VisualizzazioneImmagini\Vedi_film;
use Illuminate\Database\Seeder;

class VediFilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vedi_film::create([
            'idFormatoFilm' => 1,
            'percorsoFilm' => 'mypath/all_videos/Film1.mp3'
        ]);

        Vedi_film::create([
            'idFormatoFilm' => 2,
            'percorsoFilm' => 'mypath/all_videos/Film2.mp3'
        ]);

        Vedi_film::create([
            'idFormatoFilm' => 3,
            'percorsoFilm' => 'mypath/all_videos/Film3.mp3'
        ]);
    }
}
