<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgpathToServiceProviders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_providers', function (Blueprint $table) {
            $table->string('imgPath')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_providers', function (Blueprint $table) {
            $table->dropColumn('imgPath');
        });
    }
}
