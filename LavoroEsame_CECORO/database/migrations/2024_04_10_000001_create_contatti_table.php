<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContattiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contatti', function (Blueprint $table) {
            $table->id("idContatto");
            $table->string("nome");
            $table->string("cognome")->nullable();
            $table->unsignedBigInteger("sesso")->nullable();
            $table->string("codiceFiscale")->unique();
            $table->string("partitaIva")->nullable();
            $table->string("cittadinanza");
            $table->string("cittaNascita");
            $table->string("provinciaNascita");
            $table->string("dataNascita");
            $table->string("email")->unique();
            $table->string("password")->unique();
            $table->string("password_confirmation")->unique();
            $table->boolean('isAdmin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contatti');
    }
}
