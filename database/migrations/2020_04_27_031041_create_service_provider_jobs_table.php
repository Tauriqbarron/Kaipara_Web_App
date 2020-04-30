<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service__provider__jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_provider_id')->references('id')->on('service_providers');
            $table->foreignId('job_id')->references('id')->on('jobs');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service__provider__jobs');
    }
}
