<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            // Ubah tipe 'id' menjadi 'bigIncrements'
            $table->bigIncrements('id');  // Sebelumnya: $table->uuid('id');
            $table->string('type');
            $table->string('notifiable_type');
            $table->unsignedBigInteger('notifiable_id');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
    
            // Menambahkan indeks
            $table->index(['notifiable_type', 'notifiable_id']);
        });
    }
};