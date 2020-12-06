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
            $table->id(); // id() will automatically create id column with auto-increment and primary key
            $table->dateTime('start');
            $table->dateTime('end');
            $table->boolean('reccuring')->default(0)->nullable();
            $table->dateTime('reccuringEnd')->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('labID')->constrained('laboratories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('professor')->nullable();
            $table->string('course')->nullable();
            $table->boolean('isAllDay')->default(0)->nullable();
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
