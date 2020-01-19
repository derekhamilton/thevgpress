<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSkinsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('name', 20);
            $table->decimal('font_size_1', 3);
            $table->string('font_family_1');
            $table->decimal('font_size_forum', 3);
            $table->string('font_color_1', 6);
            $table->string('font_color_2', 6);
            $table->string('font_color_3', 6);
            $table->string('font_color_4', 6);
            $table->string('font_color_5', 6);
            $table->string('font_color_6', 6);
            $table->string('bg_color_1', 6);
            $table->string('bg_color_2', 6);
            $table->string('bg_color_3', 6);
            $table->string('bg_color_4', 6);
            $table->string('bg_color_5', 6);
            $table->string('bg_color_6', 6);
            $table->string('forum_sidebar_bg', 6);
            $table->string('microsoft_bg', 6);
            $table->string('microsoft_border', 6);
            $table->string('nintendo_bg', 6);
            $table->string('nintendo_border', 6);
            $table->string('pc_bg', 6);
            $table->string('pc_border', 6);
            $table->string('sony_bg', 6);
            $table->string('sony_border', 6);
            $table->string('big_news_bg', 6);
            $table->string('main_bg_image', 1024);
            $table->string('sidebar_bg', 6);
            $table->text('user_css', 65535);
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
        Schema::drop('skins');
    }
}
