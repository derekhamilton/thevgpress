<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('skin_id')->unsigned()->default(1);
            $table->string('username', 30)->unique('username');
            $table->string('password', 60);
            $table->string('reset_token', 50)->nullable();
            $table->dateTime('reset_time')->nullable();
            $table->string('email', 253)->nullable();
            $table->text('signature', 65535)->nullable();
            $table->text('profile', 65535)->nullable();
            $table->boolean('comments_per_page')->default(20);
            $table->integer('bury_votes')->default(-5);
            $table->boolean('sticky_menu')->default(1);
            $table->boolean('menu_dropdowns')->default(1);
            $table->boolean('use_editor')->default(1);
            $table->boolean('show_avatars')->default(1);
            $table->boolean('show_stats')->default(1);
            $table->boolean('show_signatures')->default(1);
            $table->boolean('hide_read')->default(0);
            $table->boolean('jump_last_unread')->nullable()->default(1);
            $table->boolean('appear_online')->nullable()->default(1);
            $table->string('country', 2)->default('UN');
            $table->string('ip', 15)->default('0.0.0.0');
            $table->dateTime('news_visited_at')->nullable();
            $table->integer('score')->default(0);
            $table->integer('news_clicks')->default(0);
            $table->string('remember_token', 100)->nullable();
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
        Schema::drop('users');
    }
}
