<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeSlotsTable extends Migration
{
    public function up()
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('escape_room_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('max_participants');
            $table->timestamps();

            $table->foreign('escape_room_id')->references('id')->on('escape_rooms')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('time_slots');
    }
}
