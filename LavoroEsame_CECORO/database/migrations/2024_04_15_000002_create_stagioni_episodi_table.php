<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagioniEpisodiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stagioni_episodi', function (Blueprint $table) {
            $table->id("idStagioneEpisodio");
            $table->unsignedBigInteger("idSerieTV");
            $table->unsignedBigInteger("idFormatoSerieTV");
            $table->bigInteger("Stagione");
            $table->bigInteger("Episodio");
            $table->string("descrizione")->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idSerieTV')->references('idSerieTV')->on('serie_tv');
            $table->foreign('idFormatoSerieTV')->references('idFormatoSerieTV')->on('vedi_serietv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stagioni_episodi');
    }
}
