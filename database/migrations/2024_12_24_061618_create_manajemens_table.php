<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManajemensTable extends Migration
{
    public function up()
    {
        Schema::create('manajemens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // User yang memiliki tugas
            $table->string('manajemen'); // Nama tugas
            $table->boolean('is_completed')->default(false); // Status tugas
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('manajemens');
    }
}
