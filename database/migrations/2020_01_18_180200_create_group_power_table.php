<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupPowerTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_power', function (Blueprint $table) {
            $table->integer('group_id')->unsigned();
            $table->integer('power_id')->unsigned();
            $table->primary(['group_id','power_id']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('group_power');
    }
}
