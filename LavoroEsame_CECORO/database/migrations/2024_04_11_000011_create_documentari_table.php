<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentariTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentari', function (Blueprint $table) {
            $table->id("idDocumentario");
            $table->string("titoloDocumentario");
            $table->unsignedBigInteger("idGenere");
            $table->unsignedBigInteger("idImmagineDocumentario");
            $table->unsignedBigInteger("idFormatoDocumentario");
            $table->string("descrizione");
            $table->string("regista");
            $table->string("anno");
            $table->string("durata");
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idGenere')->references('idGenere')->on('genere');
            $table->foreign('idImmagineDocumentario')->references('idImmagineDocumentario')->on('immagini_documentario');
            $table->foreign('idFormatoDocumentario')->references('idFormatoDocumentario')->on('vedi_documentario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentari');
    }
}
