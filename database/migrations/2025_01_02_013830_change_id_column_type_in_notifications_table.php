<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIdColumnTypeInNotificationsTable extends Migration
{
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Ubah kolom `id` menjadi CHAR(36) untuk menyimpan UUID
            $table->char('id', 36)->change();
        });
    }

    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Kembalikan tipe kolom `id` menjadi BIGINT
            $table->bigIncrements('id')->change();
        });
    }
}
