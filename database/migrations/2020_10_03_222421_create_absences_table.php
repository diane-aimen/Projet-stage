<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
           
            $table->id('id_absence');
            $table->boolean('etat');
            $table->string('justification', 25);
            $table->foreignId('id_seance')->constrained('seances','id_seance');
            $table->foreignId('id_etudiant')->constrained('etudiants','id_etudiant');
            $table->timestamps();
           
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absences');
    }
};
