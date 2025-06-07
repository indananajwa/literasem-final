<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Content extends Model // Ganti nama class dari Konten jadi Content
{
    use HasFactory;

    // Sesuaikan fillable dengan kolom-kolom yang ada di tabel 'contents'
    protected $fillable = ['section_id', 'title', 'description', 'image', 'video_url', 'extra', 'slug']; // Pastikan 'title' dan 'slug' ada

    // Relasi ke Section
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    protected static function booted()
    {
        static::creating(function ($content) { // Ganti $konten jadi $content
            $content->slug = Str::slug($content->title); // Gunakan $content->title
        });

        static::updating(function ($content) { // Ganti $konten jadi $content
            $content->slug = Str::slug($content->title); // Gunakan $content->title
        });
    }
}