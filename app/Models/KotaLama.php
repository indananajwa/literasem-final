<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KotaLama extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'foto'
    ];

    // Accessor untuk foto
    public function getFotoAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
