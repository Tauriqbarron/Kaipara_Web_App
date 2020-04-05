<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('serviceProviderID')->unsigned();
            $table->foreign('serviceProviderID') ->references('id')->on('ServiceProvider');
            $table->integer('applicationsID') ->unsigned();
            $table->foreign('applicationsID') ->references('id') ->on('applications');
            $table->enum('Status',array('incomplete','complete'));
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
