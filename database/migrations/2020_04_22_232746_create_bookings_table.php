<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            //TODO: create timesheet table
            $table->id();
            $table->timestamps();
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->foreignId('booking_type_id')->references('id')->on('booking__types');
            $table->string('street');
            $table->string('suburb');
            $table->string('city');
            $table->bigInteger('postcode');
            $table->string('description');
            $table->date('date');
            $table->float('start_time')->default(6);
            $table->float('finish_time')->default(16);
            $table->integer('staff_needed');
            $table->integer('available_slots');
            $table->string('status')->default('available');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
