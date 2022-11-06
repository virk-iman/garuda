<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDroneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drones', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('drone_type');
            $table->string('location');
            $table->string('district');
            $table->string('PS');
            $table->decimal('lat',12,6);
            $table->decimal('long',12,6);
            $table->dateTime('time_seen', 0);
            $table->time('fly_dur', 0);
            $table->string('pen_dist');
            $table->longText('action');
        });

        Schema::table('drones', function (Blueprint $table) {
            //
            $table->renameColumn('PS', 'ps');
            $table->string('drone_type')->nullable()->change();
            $table->string('district')->nullable()->change();
            $table->string('ps')->nullable()->change();
            $table->longText('action')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('drones');
    }
}
