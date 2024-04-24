<?php

namespace Database\Seeders;

use App\Models\ImpostazioniAdmin\Contatti;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class ContattiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contatti::create([
            'idContatto' => 1,
            'nome' => 'admin',
            'cognome' => 'admin',
            'sesso' => 0,
            'codiceFiscale' => Hash::make('AADMIN01B23C456D'),
            'partitaIva' => null,
            'cittadinanza' => "Italiana",
            'cittaNascita' => "Roma",
            'provinciaNascita' => "Latina",
            'dataNascita' => "01/01/1970",
            'email' => 'admin@email.com',
            'password' => Hash::make('L10pO7QmiZiAsHkJsBdLD814YwXcXF5'),
            'password_confirmation' => Hash::make('L10pO7QmiZiAsHkJsBdLD814YwXcXF5'),
            'isAdmin' => true
        ]);

        Contatti::create([
            'idContatto' => 2,
            'nome' => 'Mario',
            'cognome' => 'Rossi',
            'sesso' => 0,
            'codiceFiscale' => 'RSSMRA01B23C456D',
            'partitaIva' => null,
            'cittadinanza' => "Italiana",
            'cittaNascita' => "Firenze",
            'provinciaNascita' => "Empoli",
            'dataNascita' => "21/07/1998",
            'email' => 'mario@email.com',
            'password' => Hash::make('mario123!'),
            'password_confirmation' => Hash::make('mario123!'),
            'isAdmin' => false
        ]);

        Contatti::create([
            'idContatto' => 3,
            'nome' => 'Giulia',
            'cognome' => 'Bianchi',
            'sesso' => 1,
            'codiceFiscale' => 'GLIBCH12S34G567N',
            'partitaIva' => null,
            'cittadinanza' => "Svizzera",
            'cittaNascita' => "Palermo",
            'provinciaNascita' => "Villafrate",
            'dataNascita' => "18/11/1993",
            'email' => 'giulia@email.com',
            'password' => Hash::make('giulia123!'),
            'password_confirmation' => Hash::make('giulia123!'),
            'isAdmin' => false
        ]);
    }
}
