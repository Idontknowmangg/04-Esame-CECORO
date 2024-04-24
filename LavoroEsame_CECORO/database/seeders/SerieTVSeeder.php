<?php

namespace Database\Seeders;

use App\Models\MainContent\SerieTV;
use Illuminate\Database\Seeder;

class SerieTVSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SerieTV::create([
            'idSerieTV' => 1,
            'titoloSerieTV' => 'La mia serie TV',
            'idGenere' => 1,
            'idImmagineSerieTV' => 1,
            'descrizione' => 'Descrizione Serie TV',
            'regista' => 'S. Spielberg',
            'totStagioni' => 1,
            'totEp' => 30,
            'anno' => 2001
        ]);

        SerieTV::create([
            'idSerieTV' => 2,
            'titoloSerieTV' => 'La mia seconda serie TV',
            'idGenere' => 4,
            'idImmagineSerieTV' => 2,
            'descrizione' => 'Descrizione Serie TV 2',
            'regista' => 'L. Mourente',
            'totStagioni' => 3,
            'totEp' => 60,
            'anno' => 2008
        ]);

        SerieTV::create([
            'idSerieTV' => 3,
            'titoloSerieTV' => 'La mia terza serie TV',
            'idGenere' => 5,
            'idImmagineSerieTV' => 3,
            'descrizione' => 'Descrizione Serie TV 3',
            'regista' => 'M. Burny',
            'totStagioni' => 5,
            'totEp' => 90,
            'anno' => 2010
        ]);
    }
}
