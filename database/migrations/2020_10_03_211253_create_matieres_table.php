<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matieres', function (Blueprint $table) {
            $table->id('id_matiere');
            $table->foreignId('id_filiere')->constrained('filieres','id_filiere');

            $table->foreignId('id_semestre')->constrained('semestres','id_semestre');

            $table->foreignId('id_enseignant')->constrained('enseignants','id_enseignant');
            
            $table->string('nom_mat',25);
           
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
        Schema::dropIfExists('matieres');
    }
};
