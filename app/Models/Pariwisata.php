<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pariwisata extends Model
{
    protected $table = 'pariwisata'; // 👈 Tambahkan baris ini
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'deskripsi',
        'foto',
        'mime_type',
        'url_maps',
        'lat',
        'lng',
    ];
}
