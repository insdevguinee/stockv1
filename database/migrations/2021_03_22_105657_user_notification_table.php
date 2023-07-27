<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notification', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('notification_id')->unsigned();
            $table->boolean('show')->default(1);
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('notification_id')
                ->references('id')
                ->on('notifications');

            $table->primary(['user_id', 'notification_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('user_notification');
    }
}
