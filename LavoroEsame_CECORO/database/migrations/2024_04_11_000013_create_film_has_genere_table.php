<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmHasGenereTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_has_genere', function (Blueprint $table) {
            $table->id("idTracciaFilm");
            $table->unsignedBigInteger("idFilm");
            $table->unsignedBigInteger("idGenere");
            $table->timestamps();

            $table->foreign('idFilm')->references('idFilm')->on('film');
            $table->foreign('idGenere')->references('idGenere')->on('genere');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_has_genere');
    }
}
