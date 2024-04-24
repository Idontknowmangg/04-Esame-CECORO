<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContattiContattiRuoliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contatti_contattiruoli', function (Blueprint $table) {
            $table->id("idTracciaUtente");
            $table->unsignedBigInteger("idContatto"); // --> Questa è la fk che devi assegnare
            $table->unsignedBigInteger("idContattoRuolo"); // --> Anche questa
            $table->timestamps();

            $table->foreign('idContattoRuolo')->references('idContattoRuolo')->on('contatti_ruoli')->onDelete('cascade');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('contatti_contattiruoli');
        Schema::enableForeignKeyConstraints();
    }
    
}
