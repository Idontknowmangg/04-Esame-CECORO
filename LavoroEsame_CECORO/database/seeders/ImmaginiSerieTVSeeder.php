<?php

namespace Database\Seeders;

use App\Models\Immagini\Immagini_serieTV;
use Illuminate\Database\Seeder;

class ImmaginiSerieTVSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Immagini_serieTV::create([
            "idImmagineSerieTV" => 1,
            "percorsoImmagineSerieTV" => "mypath/all_images/serieTV_1.png"
        ]);

        Immagini_serieTV::create([
            "idImmagineSerieTV" => 2,
            "percorsoImmagineSerieTV" => "mypath/all_images/serieTV_2.pdf"
        ]);

        Immagini_serieTV::create([
            "idImmagineSerieTV" => 3,
            "percorsoImmagineSerieTV" => "mypath/all_images/serieTV_3.eps"
        ]);

        Immagini_serieTV::create([
            "idImmagineSerieTV" => 4,
            "percorsoImmagineSerieTV" => "mypath/all_images/serieTV_4.jpg"
        ]);

        Immagini_serieTV::create([
            "idImmagineSerieTV" => 5,
            "percorsoImmagineSerieTV" => "mypath/all_images/serieTV_5.ai"
        ]);
    }
}
