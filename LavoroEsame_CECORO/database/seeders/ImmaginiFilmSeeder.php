<?php

namespace Database\Seeders;

use App\Models\Immagini\Immagini_film;
use Illuminate\Database\Seeder;

class ImmaginiFilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Immagini_film::create([
            "idImmagineFilm" => 1,
            "percorsoImmagineFilm" => "mypath/all_images/film1.gif"
        ]);

        Immagini_film::create([
            "idImmagineFilm" => 2,
            "percorsoImmagineFilm" => "mypath/all_images/film2.jpeg"
        ]);

        Immagini_film::create([
            "idImmagineFilm" => 3,
            "percorsoImmagineFilm" => "mypath/all_images/film3.svg"
        ]);

        Immagini_film::create([
            "idImmagineFilm" => 4,
            "percorsoImmagineFilm" => "mypath/all_images/film4.psd"
        ]);

        Immagini_film::create([
            "idImmagineFilm" => 5,
            "percorsoImmagineFilm" => "mypath/all_images/film5.bmp"
        ]);
    }
}
