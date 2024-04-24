<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValutazioneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valutazione', function (Blueprint $table) {
            $table->id("idValutazione");
            $table->unsignedBigInteger("idContatto");
            $table->string("valutazione");
            $table->unsignedBigInteger("stars");
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
        Schema::dropIfExists('valutazione');
    }
}
