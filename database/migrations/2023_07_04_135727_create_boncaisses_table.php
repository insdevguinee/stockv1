<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoncaissesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boncaisses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('numerobon');
            $table->text('motif')->nullable();
            $table->date('date_execution')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('cout')->unsigned()->nullable();
            $table->enum('etat',['attente','valider','terminer','annuler'])->default('attente');
            $table->bigInteger('chantier_id')->unsigned();
            $table->integer('valide_by')->nullable();
            $table->string('beneficiaire')->nullable();
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
        Schema::dropIfExists('boncaisses');
    }
}
