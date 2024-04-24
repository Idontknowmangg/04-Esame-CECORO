<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentarioHasGenereTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentario_has_genere', function (Blueprint $table) {
            $table->id("idTracciaDocumentario");
            $table->unsignedBigInteger("idDocumentario");
            $table->unsignedBigInteger("idGenere");
            $table->timestamps();

            $table->foreign('idDocumentario')->references('idDocumentario')->on('documentari');
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
        Schema::dropIfExists('documentario_has_genere');
    }
}
