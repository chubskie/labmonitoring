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
            $table->string('start');
            $table->string('end');
            $table->boolean('reccuring');
            $table->dateTime('reccuringEnd');
            $table->string('color');
            $table->longText('description');
            $table->foreignId('labID')->constrained('laboratories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('professor');
            $table->string('course');
            $table->string('category'); // Para saan yung category?
            // $table->string('dueDateClass'); // Para saan yung due date?
            $table->boolean('isReadOnly'); // Para saan yung readonly?
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
