<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname',50);
            $table->string('lastname',50);
            $table->string('username',50);
            $table->string('email',50) ->unique();
            $table->string('password',100);
            $table->string('phone_number',20);
            $table->string('street');
            $table->string('suburb');
            $table->string('city');
            $table->bigInteger('postcode');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_providers');
    }
}
