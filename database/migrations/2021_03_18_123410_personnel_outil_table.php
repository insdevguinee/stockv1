<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PersonnelOutilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnel_outil', function (Blueprint $table) {
            $table->bigInteger('personnel_id')->unsigned();
            $table->bigInteger('outil_id')->unsigned();
            $table->bigInteger('id')->unsigned();
            $table->text('description')->nullable();

            $table->foreign('personnel_id')
                ->references('id')
                ->on('personnels')
                ->onDelete('cascade');

            $table->foreign('outil_id')
                ->references('id')
                ->on('outils')
                ->onDelete('cascade');

            $table->primary(['personnel_id', 'outil_id','id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personnel_outil');
    }
}
