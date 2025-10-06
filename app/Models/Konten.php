<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use HasFactory;

    protected $table = 'konten';
    protected $primaryKey = 'kode_konten';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'kode_konten',
        'kode_kategori',
        'judul',
        'deskripsi',
        'gambar',
        'video_url',
        'mime_type',
        'highlight',
        'sampulvideo'
    ];

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kode_kategori', 'kode_kategori');
    }

}