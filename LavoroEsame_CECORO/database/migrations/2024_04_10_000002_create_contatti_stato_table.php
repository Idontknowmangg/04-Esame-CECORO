<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContattiStatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contatti_stato', function (Blueprint $table) {
            $table->id("idContattoStato");
            $table->unsignedBigInteger("idContatto");
            $table->unsignedBigInteger("statoUtente");
            $table->unsignedBigInteger("isBanned")->nullable();
            $table->unsignedBigInteger("isRegistered")->nullable();
            $table->timestamps();

            $table->foreign('idContatto')->references('idContatto')->on('contatti')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contatti_stato');
    }
}
