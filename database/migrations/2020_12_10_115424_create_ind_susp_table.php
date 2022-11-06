<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndSuspTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ind_susp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('father');
            $table->string('address');
            $table->string('district');
            $table->integer('age');
            $table->integer('drone_id');
        });

        Schema::table('ind_susp', function (Blueprint $table) {
            //
            
            $table->string('district')->nullable()->change();
            $table->string('father')->nullable()->change();
            $table->string('address')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ind_susp');
    }
}
