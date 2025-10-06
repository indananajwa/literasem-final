<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmgMasaDepan extends Model
{
    protected $table = 'smgMasaDepan';
    protected $primaryKey = 'kode_video';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_video',
        'judul',
        'video',
        'deskripsi',
    ];
}