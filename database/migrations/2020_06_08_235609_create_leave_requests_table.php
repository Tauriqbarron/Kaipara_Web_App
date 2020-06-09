<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->references('id')->on('staff')->onDelete('cascade');
            $table->string('subject');
            $table->string('message');
            $table->foreignId('absence_types_id')->references('id')->on('absence_types');
            $table->foreignId('absence_status_id')->references('id')->on('absence_statuses');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('updated_on')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_requests');
    }
}
