<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('pays_id');
            $table->string('ville')->nullable();
            $table->string('contact')->nullable();
            $table->timestamps();
        });

        Schema::create('pays', function (Blueprint $table){
            $table->id();
            $table->string('code')->nullable();
            $table->string('alpha2')->nullable();
            $table->string('alpha3')->nullable();
            $table->string('nom_en_gb')->nullable();
            $table->string('nom_fr_fr')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pays');
        Schema::dropIfExists('fournisseurs');
    }
}
