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
            $table->datetime('start');
            $table->datetime('end');
            $table->boolean('reccuring')->default('0');
            $table->dateTime('reccuringEnd')->nullable();
            // $table->string('color')->nullable();
            $table->longText('description')->nullable();
            //$table->foreignId('labID')->constrained('laboratories')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('professor')->nullable();
            $table->string('course')->nullable();
            $table->string('category')->nullable(); // Para saan yung category?
            // $table->string('dueDateClass'); // Para saan yung due date?
            $table->boolean('isAllDay')->default('0'); // Para saan yung readonly?
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
