<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBsfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsf', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('bsf_post');
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
        Schema::table('bsf', function (Blueprint $table) {
            Schema::dropIfExists('bsf');
        });
    }
}
