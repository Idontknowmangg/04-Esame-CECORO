<?php

namespace Database\Seeders;

use App\Models\ImpostazioniSito\Sottotitoli;
use Illuminate\Database\Seeder;

class SottotitoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sottotitoli::create([
            'idSottotitolo' => 1,
            'linguaSottotitolo' => 'Inglese (EN)'
        ]);

        Sottotitoli::create([
            'idSottotitolo' => 2,
            'linguaSottotitolo' => 'Tedesco (DE)'
        ]);

        Sottotitoli::create([
            'idSottotitolo' => 3,
            'linguaSottotitolo' => 'Paesi Bassi (NL)'
        ]);
    }
}
