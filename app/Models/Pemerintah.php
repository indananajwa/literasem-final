<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemerintah extends Model
{
    use HasFactory;

    protected $table = 'pemerintah';
    protected $primaryKey = 'periode';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'periode',
        'kode_kategori',
        'nama_walikota',
        'nama_wakil_walikota',
        'foto_walikota',
        'mime_type_walikota',
        'foto_wakil_walikota',
        'mime_type_wakil_walikota',
    ];
}