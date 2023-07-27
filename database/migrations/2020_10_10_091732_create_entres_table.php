<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entres', function (Blueprint $table) {
            $table->id();
            $table->enum('mode',['entre','sortie']);
            $table->bigInteger('materiel_id')->unsigned();
            $table->string('nfacture')->nullable();
            $table->double('quantite')->default(0);
            $table->integer('pu')->default(0);
            $table->date('date_ajout')->nullable();
            $table->integer('fournisseur_id')->nullable();
            $table->bigInteger('chantier_id')->unsigned();
            $table->integer('transfert_id')->default(0);
            $table->text('motif')->nullable();
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::table('entres', function($table) {
            $table->foreign('materiel_id')
                ->references('id')
                ->on('materiels');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entres');
    }
}
