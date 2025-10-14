<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pariwisata extends Model
{
    protected $table = 'pariwisata';
    protected $primaryKey = 'kodePariwisata';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'kodePariwisata',
        'nama',
        'deskripsi',
        'foto',
        'mime_type',
        'url_maps',
        'lat',
        'lng',
    ];

    /**
     * Generate kode pariwisata otomatis
     */
    public static function generateKodePariwisata()
    {
        $latest = self::orderBy('kodePariwisata', 'desc')->first();
        
        if (!$latest) {
            return 'PAR001';
        }
        
        $number = (int)substr($latest->kodePariwisata, 3) + 1;
        return 'PAR' . sprintf("%03d", $number);
    }
}