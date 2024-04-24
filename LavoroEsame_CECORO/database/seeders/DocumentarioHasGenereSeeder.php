<?php

namespace Database\Seeders;

use App\Models\ImpostazioniGenere\Documentario_hasGenere;
use Illuminate\Database\Seeder;

class DocumentarioHasGenereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Documentario_hasGenere::create([
            "idTracciaDocumentario" => 1,
            "idDocumentario" => 1,
            "idGenere" => 1
        ]);

        Documentario_hasGenere::create([
            "idTracciaDocumentario" => 2,
            "idDocumentario" => 2,
            "idGenere" => 2
        ]);

        Documentario_hasGenere::create([
            "idTracciaDocumentario" => 3,
            "idDocumentario" => 3,
            "idGenere" => 3
        ]);
    }
}
