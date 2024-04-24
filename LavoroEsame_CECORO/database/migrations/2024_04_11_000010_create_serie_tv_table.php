<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerieTVTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serie_tv', function (Blueprint $table) {
            $table->id("idSerieTV");
            $table->string("titoloSerieTV");
            $table->unsignedBigInteger("idGenere");
            $table->unsignedBigInteger("idImmagineSerieTV");
            $table->string("descrizione");
            $table->string("regista");
            $table->bigInteger("totStagioni");
            $table->bigInteger("totEp");
            $table->string("anno");
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idGenere')->references('idGenere')->on('genere');
            $table->foreign('idImmagineSerieTV')->references('idImmagineSerieTV')->on('immagini_serietv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('serie_tv');
        Schema::enableForeignKeyConstraints();
    }
}
