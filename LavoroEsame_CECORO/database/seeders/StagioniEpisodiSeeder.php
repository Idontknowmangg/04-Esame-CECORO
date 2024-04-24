<?php

namespace Database\Seeders;

use App\Models\ImpostazioniSito\StagioniEpisodi;
use Illuminate\Database\Seeder;

class StagioniEpisodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StagioniEpisodi::create([
            'idStagioneEpisodio' => 1,
            'idSerieTV' => 1,
            'idFormatoSerieTV' => 1,
            'Stagione' => 1,
            'Episodio' => 1,
            'descrizione' => 'Descrizione ep 1'
        ]);

        StagioniEpisodi::create([
            'idStagioneEpisodio' => 2,
            'idSerieTV' => 1,
            'idFormatoSerieTV' => 2,
            'Stagione' => 1,
            'Episodio' => 2,
            'descrizione' => 'Descrizione ep 2'
        ]);

        StagioniEpisodi::create([
            'idStagioneEpisodio' => 3,
            'idSerieTV' => 2,
            'idFormatoSerieTV' => 3,
            'Stagione' => 4,
            'Episodio' => 71,
            'descrizione' => 'Descrizione ep 71'
        ]);
    }
}
