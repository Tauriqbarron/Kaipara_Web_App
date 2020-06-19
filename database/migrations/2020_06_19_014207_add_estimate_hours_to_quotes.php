<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstimateHoursToQuotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->integer('estimate_hours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn('estimate_hours');
        });
    }
}
