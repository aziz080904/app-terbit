<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'waktu',
        'user_id',
    ];
    

    protected $casts = [
        'waktu' => 'datetime', // Konversi kolom 'waktu' menjadi objek Carbon
    ];
    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
}
