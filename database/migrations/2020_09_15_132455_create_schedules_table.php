<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('scheduleID');
            $table->dateTime('timeStart');
            $table->dateTime('timeEnd');
            $table->boolean('reccuring');
            $table->dateTime('reccuringEnd');
            $table->string('color', 50);
            $table->string('description', 191);
            $table->integer('labID')->unsigned();
            $table->integer('studentID')->unsigned();
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
        Schema::dropIfExists('schedules');
    }
}
