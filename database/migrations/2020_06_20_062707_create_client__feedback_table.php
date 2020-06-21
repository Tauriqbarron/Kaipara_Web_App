<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client__feedback', function (Blueprint $table) {
            $table->id();
            $table->integer('rating');
            $table->string('message');
            $table->foreignId('staff__assignment_id')->references('id')->on('staff__assignments')->onDelete('cascade');
            $table->foreignId('staff_id')->references('id')->on('staff')->onDelete('cascade');
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
        Schema::dropIfExists('client__feedback');
    }
}
