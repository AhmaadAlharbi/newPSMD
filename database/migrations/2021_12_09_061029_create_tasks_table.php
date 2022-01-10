<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tasks')){

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('refNum');
            $table->unsignedBigInteger('fromSection')->unsigned();
            $table->unsignedBigInteger('toSection')->unsigned();
            $table->unsignedBigInteger('station_id')->unsigned();
            $table->string('main_alarm');
            $table->string('work_type');
            $table->date('task_date');
            $table->string('equip');
            $table->unsignedBigInteger('eng_id')->unsigned();
            $table->string('problem');
            $table->foreign('eng_id')->references('id')->on('engineers');
            $table->foreign('fromSection')->references('id')->on('sections');
            $table->foreign('toSection')->references('id')->on('sections');
            $table->string('notes');
            $table->foreign('station_id')->references('id')->on('stations');
            $table->string('status');
            $table->string('alarm_count');
            $table->string('user');

            $table->timestamps();
        });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}