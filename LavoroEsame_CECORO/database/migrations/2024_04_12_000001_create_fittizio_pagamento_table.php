<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFittizioPagamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fittizio_pagamento', function (Blueprint $table) {
            $table->id("idPagamento");
            $table->unsignedBigInteger("idContatto");
            $table->string("personal_info")->unique();
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
        Schema::dropIfExists('fittizio_pagamento');
    }
}
