<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_task')->nullable();
            $table->foreign('id_task')->references('id')->on('tasks')->onDelete('cascade');
            $table->date('report_date');
            $table->string('reasonOfUncompleted');
            $table->unsignedBigInteger('eng_id')->unsigned();
            $table->foreign('eng_id')->references('id')->on('engineers');
            $table->string('engineer_notes');
            $table->string('action_take');
            $table->string('status');
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
        Schema::dropIfExists('task_details');
    }
}