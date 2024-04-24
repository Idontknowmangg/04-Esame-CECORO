<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditiSerieTVTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crediti_serie_tV', function (Blueprint $table) {
            $table->id("idCreditiSerieTV");
            $table->unsignedBigInteger("idSerieTV");
            $table->bigInteger("creditiNecessari");
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idSerieTV')->references('idSerieTV')->on('serie_tv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crediti_serie_tv');
    }
}
