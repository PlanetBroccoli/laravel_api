<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCoordinatesType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('reports', function ($table) {
            $table->float('latitude')->change();
            $table->float('longitude')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('reports', function ($table) {
        $table->decimal('latitude', 10)->change();
        $table->decimal('longitude', 11)->change();
        });
    }
}
