<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    use HasFactory;

    protected $table = 'kampus';
    protected $fillable = ['id', 'nama', 'alamat', 'latitude', 'longitude'];
}
