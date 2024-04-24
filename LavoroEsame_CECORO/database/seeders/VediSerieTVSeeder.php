<?php

namespace Database\Seeders;

use App\Models\VisualizzazioneImmagini\Vedi_serieTV;
use Illuminate\Database\Seeder;

class VediSerieTVSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vedi_serieTV::create([
            'idFormatoSerieTV' => 1,
            'percorsoSerieTV' => 'mypath/all_videos/tvSeries1.mp3'
        ]);

        Vedi_serieTV::create([
            'idFormatoSerieTV' => 2,
            'percorsoSerieTV' => 'mypath/all_videos/tvSeries2.mp3'
        ]);

        Vedi_serieTV::create([
            'idFormatoSerieTV' => 3,
            'percorsoSerieTV' => 'mypath/all_videos/tvSeries3.mp3'
        ]);
    }
}
