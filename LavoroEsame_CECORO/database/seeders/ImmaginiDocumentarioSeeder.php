<?php

namespace Database\Seeders;

use App\Models\Immagini\Immagini_documentario;
use Illuminate\Database\Seeder;

class ImmaginiDocumentarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Immagini_documentario::create([
            "idImmagineDocumentario" => 1,
            "percorsoImmagineDocumentario" => "mypath/all_images/doc.jpg"
        ]);

        Immagini_documentario::create([
            "idImmagineDocumentario" => 2,
            "percorsoImmagineDocumentario" => "mypath/all_images/doc2.png"
        ]);

        Immagini_documentario::create([
            "idImmagineDocumentario" => 3,
            "percorsoImmagineDocumentario" => "mypath/all_images/doc3.wbem"
        ]);

        Immagini_documentario::create([
            "idImmagineDocumentario" => 4,
            "percorsoImmagineDocumentario" => "mypath/all_images/doc4.gif"
        ]);

        Immagini_documentario::create([
            "idImmagineDocumentario" => 5,
            "percorsoImmagineDocumentario" => "mypath/all_images/doc5.avif"
        ]);
    }
}
