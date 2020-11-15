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
            $table->integer('calendarId')->unsigned();
            $table->string('title', 191);
            $table->string('category', 191);
            $table->string('dueDateClass', 191);
            $table->string('start');
            $table->string('end');
            $table->boolean('reccuring');
            $table->boolean('isReadOnly');
            $table->dateTime('reccuringEnd');
            $table->string('color', 50);           
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
