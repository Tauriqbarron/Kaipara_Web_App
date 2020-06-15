<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->timestamps();
            $table->integer('status');
            $table->string('imagePath')->nullable(true);
            $table->string('title');
            $table->text('description');
            $table->integer('price')->nullable();
            $table->date('date');
            $table->time('start_time');
            $table->time('finish_time');
            $table->string('street');
            $table->string('suburb');
            $table->string('city');
            $table->string('postCode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
