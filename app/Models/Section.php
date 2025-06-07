<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Section extends Model
{
    use HasFactory;

    // Sesuaikan fillable dengan kolom yang ada di tabel 'sections'
    protected $fillable = ['name', 'field_rules', 'slug']; // Pastikan 'name' dan 'slug' ada

    // Relasi ke Content (sesuai nama model baru: Content)
    public function contents() // Ganti dari konten() jadi contents()
    {
        return $this->hasMany(Content::class); // Pakai Content::class
    }

    protected static function booted()
    {
        static::creating(function ($section) {
            $section->slug = Str::slug($section->name); // Gunakan $section->name
        });

        static::updating(function ($section) {
            $section->slug = Str::slug($section->name); // Gunakan $section->name
        });
    }
}