<?php

// File: app/Models/Kategori.php
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

    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
        'deskripsi_kategori',
        'gambar_cover',
        'field_rules'
    ];

    protected $casts = [
        'field_rules' => 'array'
    ];

    public function konten()
    {
        return $this->hasMany(Konten::class, 'kode_kategori', 'kode_kategori');
    }
}

// ==================================================

// File: app/Models/Konten.php
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

    protected $fillable = [
        'kode_konten',
        'kode_kategori',
        'judul',
        'deskripsi',
        'video_url',
        'gambar',
        'mime_type',
        'tampilan'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kode_kategori', 'kode_kategori');
    }
}