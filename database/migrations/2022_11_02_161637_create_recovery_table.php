<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecoveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recovery', function (Blueprint $table) {
            $table->increments('id');
            $table->date('dor');
            $table->string('rec_agency');
            $table->string('type_drone')->nullable();
            $table->string('model')->nullable();
            $table->string('payload_cap')->nullable();
            $table->string('max_speed')->nullable();
            $table->string('flight_time')->nullable();
            $table->string('one_way')->nullable();
            $table->integer('drone_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recovery');
    }
}
