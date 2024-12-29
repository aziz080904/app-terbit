<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdForeignKeyToManajemensTable extends Migration
{
    public function up()
    {
        Schema::table('manajemens', function (Blueprint $table) {
            // Pastikan kolom `user_id` ada dan bertipe unsignedBigInteger
            if (Schema::hasColumn('manajemens', 'user_id')) {
                $table->unsignedBigInteger('user_id')->change();
            }

            // Tambahkan foreign key jika belum ada
            $this->addForeignKeyIfNotExists($table, 'manajemens', 'user_id', 'users', 'manajemens_user_id_foreign');
        });
    }

    public function down()
    {
        Schema::table('manajemens', function (Blueprint $table) {
            // Hapus foreign key jika ada
            if ($this->foreignKeyExists('manajemens', 'manajemens_user_id_foreign')) {
                $table->dropForeign('manajemens_user_id_foreign');
            }
        });
    }

    /**
     * Tambahkan foreign key jika belum ada.
     */
    private function addForeignKeyIfNotExists(Blueprint $table, $tableName, $column, $referencedTable, $foreignKeyName)
    {
        if (!$this->foreignKeyExists($tableName, $foreignKeyName)) {
            $table->foreign($column)
                ->references('id')
                ->on($referencedTable)
                ->onDelete('cascade');
        }
    }

    /**
     * Periksa keberadaan foreign key berdasarkan nama.
     */
    private function foreignKeyExists($table, $foreignKeyName)
    {
        $query = "SELECT CONSTRAINT_NAME 
                  FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
                  WHERE TABLE_NAME = ? 
                  AND CONSTRAINT_NAME = ?";
        $result = DB::select($query, [$table, $foreignKeyName]);

        return count($result) > 0;
    }
}
