<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerieTVHasGenereTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serietv_has_genere', function (Blueprint $table) {
            $table->id("idTracciaSerieTV");
            $table->unsignedBigInteger("idSerieTV");
            $table->unsignedBigInteger("idGenere");
            $table->timestamps();

            $table->foreign('idSerieTV')->references('idSerieTV')->on('serie_tv');
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
        Schema::dropIfExists('serietv_has_genere');
    }
}
