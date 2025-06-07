<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsitektur extends Model
{
    protected $table ='arsitektur';
    protected $fillable = [
        'nama_arsitektur',
        'deskripsi_arsitektur',
        'image_arsitektur',
    ];
}
