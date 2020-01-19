<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id_sender')->unsigned();
            $table->integer('user_id_receiver')->unsigned();
            $table->string('title', 50);
            $table->text('message', 65535);
            $table->dateTime('read_at')->nullable();
            $table->timestamps();
            $table->dateTime('sender_deleted_at')->nullable();
            $table->dateTime('receiver_deleted_at')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('messages');
    }
}
