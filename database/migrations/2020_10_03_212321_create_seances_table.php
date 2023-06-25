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
        Schema::create('seances', function (Blueprint $table) {
           
            $table->id('id_seance');
            $table->date('date');
            $table->string('type');
            $table->boolean('active');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->foreignId('id_enseignant')->constrained('enseignants','id_enseignant');
            $table->foreignId('id_matiere')->constrained('matieres','id_matiere');

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
        Schema::dropIfExists('seances');
    }
};
