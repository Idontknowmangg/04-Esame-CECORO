<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditiDocumentarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crediti_documentario', function (Blueprint $table) {
            $table->id("idCreditiDocumentario");
            $table->unsignedBigInteger("idDocumentario");
            $table->bigInteger("creditiNecessari");
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idDocumentario')->references('idDocumentario')->on('documentari');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crediti_documentario');
    }
}
