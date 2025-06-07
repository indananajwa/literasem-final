<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budaya extends Model
{
    protected $table ='budaya';
    protected $fillable = [
        'nama_budaya',
        'deskripsi_budaya',
        'image_budaya',
        'video_budaya',
    ];
}
