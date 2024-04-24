<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistenzaAutorizzatiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistenza_autorizzati', function (Blueprint $table) {
            $table->id("idAssistenza");
            $table->unsignedBigInteger("idContatto");
            $table->string("feedback");
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
        Schema::dropIfExists('assistenza_autorizzati');
    }
}
