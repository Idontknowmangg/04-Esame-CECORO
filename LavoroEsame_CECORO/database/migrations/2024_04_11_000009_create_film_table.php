<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film', function (Blueprint $table) {
            $table->id("idFilm");
            $table->string("titoloFilm");
            $table->unsignedBigInteger("idGenere");
            $table->unsignedBigInteger("idImmagineFilm");
            $table->unsignedBigInteger("idFormatoFilm");
            $table->string("descrizione");
            $table->string("regista");
            $table->string("anno");
            $table->string("durata");
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idGenere')->references('idGenere')->on('genere');
            $table->foreign('idImmagineFilm')->references('idImmagineFilm')->on('immagini_film');
            $table->foreign('idFormatoFilm')->references('idFormatoFilm')->on('vedi_film');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film');
    }
}
