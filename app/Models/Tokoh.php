<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tokoh extends Model
{
    protected $table ='tokoh';
    protected $fillable = [
        'nama_tokoh',
        'deskripsi_tokoh',
        'image_tokoh',
    ];
}
