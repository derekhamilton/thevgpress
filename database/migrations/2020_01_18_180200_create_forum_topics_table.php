<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForumTopicsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('forum_board_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('title', 100);
            $table->string('slug', 100);
            $table->boolean('stickied')->default(0);
            $table->boolean('locked')->default(0);
            $table->integer('votes')->default(0);
            $table->dateTime('last_commented_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forum_topics');
    }
}
