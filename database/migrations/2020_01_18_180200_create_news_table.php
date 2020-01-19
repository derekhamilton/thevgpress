<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('link', 2048)->nullable();
            $table->enum('company', array('multiplat','microsoft','nintendo','sony','pc'))->nullable();
            $table->boolean('is_big_news')->default(0);
            $table->boolean('is_news')->default(0);
            $table->boolean('is_media')->default(0);
            $table->boolean('is_impressions')->default(0);
            $table->boolean('is_editorial')->default(0);
            $table->integer('clicks')->unsigned()->default(0);
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
        Schema::drop('news');
    }
}
