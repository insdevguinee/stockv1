<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
            $table->string('nom')->nullable();
            $table->string('prenoms')->nullable();
            $table->string('contact')->nullable();
            $table->string('numero_equipe')->nullable();
            $table->integer('created_by')->unsigned();
            $table->boolean('etat')->default(0);
            $table->string('email')->default();
            $table->enum('civilite',['m','mme','mlle'])->default('m');
            $table->date('naissance')->nullable();
            $table->string('lieu_n')->nullable();
            $table->string('nationnalite')->nullable();
            $table->string('adresse')->nullable();
            $table->string('cnps')->nullable();
            $table->string('cmu')->nullable();
            $table->date('embauche')->nullable();
            $table->string('poste')->nullable();
            $table->integer('departement_id')->nullable();
            $table->string('salaire')->nullable();
            $table->enum('st_matri',['marie','celibataire'])->nullable();
            $table->integer('enfant')->default(0);
            $table->date('sortie')->nullable();
            $table->string('cv')->nullable();
            $table->string('photo')->nullable();
            $table->string('contrat_type')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('personnels');
    }
}
