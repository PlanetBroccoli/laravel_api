<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function ($table) {
            $table->string('password')->nullable()->change();
            $table->string('provider');
            $table->string('provider_id')->nullable();
            $table->string('provider_token');
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
        Schema::table('users', function ($table) {
            $table->dropColum('provider');
            $table->dropColum('provider_id');
            $table->dropColum('provider_token');
            $table->string('password')->change();
                    });
    }
}
