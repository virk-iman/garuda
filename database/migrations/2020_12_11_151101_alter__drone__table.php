<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDroneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drones', function (Blueprint $table) {
            //
            $table->timestamps();
            $table->string('cons_dropped')->default('No');
            $table->string('recovery')->default('No');
            $table->string('forensics')->default('No');            
            $table->string('bop')->after('ps')->nullable();
            $table->string('vill')->after('bop')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drones', function (Blueprint $table) {
            $table->dropColumn('cons_dropped');
            $table->dropColumn('recovery');
            $table->dropColumn('forensics');
            $table->dropColumn('bop');
            $table->dropColumn('vill');
            $table->dropColumn('updated_at');
             $table->dropColumn('created_at');
              
        });
    }
}
