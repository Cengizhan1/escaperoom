<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscapeRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('escape_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('theme');
            $table->integer('maximum_participants');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('escape_rooms');
    }
}
