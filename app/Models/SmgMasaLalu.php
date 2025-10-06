<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmgMasaLalu extends Model
{
    protected $table = 'smgMasaLalu';
    protected $primaryKey = 'kode_lokasi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_lokasi',
        'judul',
        'deskripsi',
        'foto_sebelum',
        'mime_type_sebelum',
        'foto_sesudah',
        'mime_type_sesudah',
        'label_sebelum',
        'label_sesudah',
        'tahun_sebelum',
        'tahun_sesudah',
    ];
}
