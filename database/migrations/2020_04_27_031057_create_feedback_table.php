<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('message',250);
            $table->bigInteger('rating');
            $table->foreignId('staff_assignment_id')->references('id')->on('staff__assignments');
            $table->foreignId('service_provider_job_id')->references('id')->on('service__provider__jobs');
            $table->bigInteger('rating');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
