<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    protected $table = 'konten';
    protected $primaryKey = 'kode_konten';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_konten', 'kode_kategori', 'judul', 'deskripsi',
        'video_url', 'gambar', 'mime_type', 'tampilan'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kode_kategori', 'kode_kategori');
    }

}
