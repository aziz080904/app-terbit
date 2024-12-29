<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manajemen extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'manajemen', 'is_completed'];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
