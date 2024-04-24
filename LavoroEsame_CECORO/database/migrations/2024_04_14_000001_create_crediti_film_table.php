<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditiFilmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crediti_film', function (Blueprint $table) {
            $table->id("idCreditiFilm");
            $table->unsignedBigInteger("idFilm");
            $table->bigInteger("creditiNecessari");
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idFilm')->references('idFilm')->on('film');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crediti_film');
    }
}
