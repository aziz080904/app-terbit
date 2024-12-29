<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manajemen;

class ManajemenSeeder extends Seeder
{
    public function run()
    {
        Manajemen::insert([
            [
                'user_id' => 1,
                'manajemen' => 'Mengerjakan tugas kuliah',
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'manajemen' => 'Membaca buku',
                'is_completed' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'manajemen' => 'Mengikuti rapat organisasi',
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
