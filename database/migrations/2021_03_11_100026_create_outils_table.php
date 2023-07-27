<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outils', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('qte')->default(1);
            $table->integer('etat')->default(1);
            $table->text('description')->nullable();
            $table->integer('categorie_id');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('outils');
    }
}
