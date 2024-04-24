<?php

namespace Database\Seeders;

use App\Models\VisualizzazioneImmagini\Vedi_documentario;
use Illuminate\Database\Seeder;

class VediDocumentarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vedi_documentario::create([
            'idFormatoDocumentario' => 1,
            'percorsoDocumentario' => 'mypath/all_videos/videoDoc1.mp3'
        ]);

        Vedi_documentario::create([
            'idFormatoDocumentario' => 2,
            'percorsoDocumentario' => 'mypath/all_videos/videoDoc2.mp3'
        ]);

        Vedi_documentario::create([
            'idFormatoDocumentario' => 3,
            'percorsoDocumentario' => 'mypath/all_videos/videoDoc3.mp3'
        ]);
    }
}
