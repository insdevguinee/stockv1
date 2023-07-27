<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PersonnelChantierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnel_chantier', function (Blueprint $table) {
            $table->bigInteger('personnel_id')->unsigned();
            $table->bigInteger('chantier_id')->unsigned();
            // $table->text('description')->nullable();

            $table->foreign('personnel_id')
                ->references('id')
                ->on('personnels')
                ->onDelete('cascade');

            $table->foreign('chantier_id')
                ->references('id')
                ->on('chantiers')
                ->onDelete('cascade');

            $table->primary(['personnel_id', 'chantier_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personnel_chantier');
    }
}
