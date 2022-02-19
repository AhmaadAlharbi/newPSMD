<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngineersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('engineers')){

        Schema::create('engineers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('area');
            $table->boolean('shift');
            $table->foreign('user_id')->references('id')->on('user');
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
        Schema::dropIfExists('engineers');
    }
}