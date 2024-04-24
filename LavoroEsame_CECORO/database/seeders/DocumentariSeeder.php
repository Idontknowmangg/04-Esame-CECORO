<?php

namespace Database\Seeders;

use App\Models\MainContent\Documentari;
use Illuminate\Database\Seeder;

class DocumentariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Documentari::create([
            'idDocumentario' => 1,
            'titoloDocumentario' => 'Il documentario',
            'idGenere' => 1,
            'idImmagineDocumentario' => 1,
            'idFormatoDocumentario' => 1,
            'descrizione' => 'La descrizione del primo documentario',
            'regista' => 'S. Spielberg',
            'anno' => 1978,
            'durata' => "120 min"
        ]);

        Documentari::create([
            'idDocumentario' => 2,
            'titoloDocumentario' => 'Il secondo documentario',
            'idGenere' => 2,
            'idImmagineDocumentario' => 2,
            'idFormatoDocumentario' => 2,
            'descrizione' => 'La descrizione del secondo documentario',
            'regista' => 'G. Lucas',
            'anno' => 2002,
            'durata' => "93 min"
        ]);

        Documentari::create([
            'idDocumentario' => 3,
            'titoloDocumentario' => 'Il terzo documentario',
            'idGenere' => 4,
            'idImmagineDocumentario' => 3,
            'idFormatoDocumentario' => 3,
            'descrizione' => 'La descrizione del terzo documentario',
            'regista' => 'A. Monda',
            'anno' => 2005,
            'durata' => "100 min"
        ]);
    }
}
