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
        Schema::create('etudiants', function (Blueprint $table) {
                

            $table->id('id_etudiant');
            $table->string('cne');
            $table->string('nom_etu');
            $table->string('prenom_etu');
            $table->integer('phone_etu');
            $table->foreignId('id_filiere')->constrained('filieres','id_filiere');
            $table->foreignId('id_user')->constrained('users');
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
        Schema::dropIfExists('etudiants');
    }
};
