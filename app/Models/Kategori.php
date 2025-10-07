<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'kode_kategori';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
        'judul_kategori',
        'deskripsi_kategori',
        'gambar_cover',
        'mime_type',
        'field_rules',
        'video_sampul',
    ];

    protected $casts = [
        'field_rules' => 'array',
        'video_sampul' => 'array'
    ];

    // Relasi umum ke tabel "konten"
    public function konten()
    {
        return $this->hasMany(\App\Models\Konten::class, 'kode_kategori', 'kode_kategori');
    }

    // Relasi khusus ke pariwisata
    public function pariwisata()
    {
        return $this->hasMany(Pariwisata::class, 'kategori_id');
    }

    // Relasi khusus ke pemerintah
    public function pemerintah()
    {
        return $this->hasMany(Pemerintah::class, 'kategori_id');
    }
}
