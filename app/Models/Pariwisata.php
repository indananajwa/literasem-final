<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pariwisata extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 
        'deskripsi', 
        'foto', 
        'lokasi'
    ];

    // Accessor untuk foto
    public function getFotoAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
