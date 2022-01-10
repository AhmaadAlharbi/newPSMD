<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('SSNAME',255);
            $table->string('COMPANY_MAKE',255);
            $table->string('Voltage_Level_KV',255);
            $table->string('Contract_No',255);
            $table->string('COMMISIONING_DATE',255);
            $table->string('control',255);
            $table->string('fullName',255);
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
        Schema::dropIfExists('stations');
    }
}