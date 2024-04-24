<?php

namespace Database\Seeders;

use App\Models\ImpostazioniSito\Nazioni;
use Illuminate\Database\Seeder;

class NazioniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = storage_path("app/csv_db/nazioni.csv");
        $file = fopen($csv, "r");
        while (($data = fgetcsv($file, 200, ",")) !== false) {
            Nazioni::create(
                [
                    "idNazione" => $data[0],
                    "nome" => $data[1],
                    "continente" => $data[2],
                    "iso" => $data[3],
                    "iso3" => $data[4],
                    "prefissoTelefonico" => $data[5]
                ]
            );
        }
    }
}
