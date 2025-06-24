<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemerintah extends Model
{
    use HasFactory;

    protected $table = 'pemerintah';

    protected $fillable = [
        'nama', 
        'jabatan', 
        'tahun_berkuasa', 
        'tahun_akhir', 
        'foto'
    ];

    // Accessor untuk foto
    public function getFotoAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
