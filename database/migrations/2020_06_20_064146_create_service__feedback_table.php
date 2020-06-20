<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service__feedback', function (Blueprint $table) {
            $table->id();
            $table->integer('rating');
            $table->string('message');
            $table->foreignId('service__provder__job_id')->references('id')->on('staff__assignments')->onDelete('cascade');
            $table->integer('status');
            $table->foreignId('service__provider_id')->references('id')->on('service__providers')->onDelete('cascade');
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service__feedback');
    }
}
