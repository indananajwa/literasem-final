<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriData = [
            [
                'kode_kategori' => 'BUD',
                'nama_kategori' => 'Budaya',
                'judul_kategori' => 'Jelajah Budaya Semarang',
                'deskripsi_kategori' => 'Keindahan yang Tak Lekang oleh Waktu',
                'cover_path' => public_path('cover/cover_budaya.png'),
                'field_rules' => [
                    "tampilan" => "0",
                    "sampulvideo" => "not_used",
                    "highlight" => "required",
                    "judul" => "required",
                    "deskripsi" => "required",
                    "gambar" => "required",
                    "video_url" => "optional"
                ]
            ],
            [
                'kode_kategori' => 'ARS',
                'nama_kategori' => 'Arsitektur',
                'judul_kategori' => 'Arsitektur Kota Semarang',
                'deskripsi_kategori' => 'Menelusuri Jejak Arsitektur Semarang, Dari Masa ke Masa',
                'cover_path' => public_path('cover/cover_arsi.jpg'),
                'field_rules' => [
                    "tampilan" => "0",
                    "sampulvideo" => "not_used",
                    "highlight" => "not_used",
                    "judul" => "required",
                    "deskripsi" => "required",
                    "gambar" => "optional",
                    "video_url" => "optional"
                ]
            ],
            [
                'kode_kategori' => 'TEM',
                'nama_kategori' => 'Tempat Ibadah',
                'judul_kategori' => 'Tempat Ibadah Kota Semarang',
                'deskripsi_kategori' => 'Menapaki Keagungan Tempat Ibadah Bersejarah di Semarang',
                'cover_path' => public_path('cover/cover_ibadah.jpg'),
                'field_rules' => [
                    "tampilan" => "0",
                    "sampulvideo" => "not_used",
                    "highlight" => "not_used",
                    "judul" => "required",
                    "deskripsi" => "required",
                    "gambar" => "required",
                    "video_url" => "optional"
                ]
            ],
            [
                'kode_kategori' => 'TOK',
                'nama_kategori' => 'Tokoh',
                'judul_kategori' => 'Jelajah Para Tokoh',
                'deskripsi_kategori' => 'Mengenal Sosok-Sosok Berpengaruh dari Sejarah Semarang',
                'cover_path' => public_path('cover/cover_tokoh.png'),
                'field_rules' => [
                    "tampilan" => "0",
                    "sampulvideo" => "not_used",
                    "highlight" => "not_used",
                    "judul" => "required",
                    "deskripsi" => "required",
                    "gambar" => "required",
                    "video_url" => "optional"
                ]
            ],
            [
                'kode_kategori' => 'MAK',
                'nama_kategori' => 'Makanan Khas',
                'judul_kategori' => 'Ragam Kuliner Semarang',
                'deskripsi_kategori' => 'Kaya Rasa, Sarat Makna',
                'cover_path' => public_path('cover/cover_pariwisata.jpg'),
                'field_rules' => [
                    "tampilan" => "1",
                    "sampulvideo" => "not_used",
                    "highlight" => "not_used",
                    "judul" => "required",
                    "deskripsi" => "required",
                    "gambar" => "required",
                    "video_url" => "optional"
                ]
            ],
            [
                'kode_kategori' => 'SIT',
                'nama_kategori' => 'Situs Kota Lama',
                'judul_kategori' => 'Situs Kota Lama Semarang',
                'deskripsi_kategori' => 'Menghidupkan Kembali Warisan Sejarah Kota Semarang',
                'cover_path' => public_path('cover/cover_kotalama.jpg'),
                'field_rules' => [
                    "tampilan" => "0",
                    "sampulvideo" => "required",
                    "highlight" => "not_used",
                    "judul" => "required",
                    "deskripsi" => "required",
                    "gambar" => "required",
                    "video_url" => "not_used"
                ],
                'video_sampul' => [
                    [
                        'title' => 'Revitalisasi Kota Lama Semarang',
                        'description' => 'Upaya pelestarian Kota Lama Semarang agar tetap menjadi ikon bersejarah yang menarik dan berdaya guna.',
                        'youtube_id' => 'khNkocgfiN0'
                    ],
                    [
                        'title' => 'Mengenal Kota Lama Semarang',
                        'description' => 'Mengungkap sejarah dan pesona Kota Lama Semarang, sebuah kawasan bersejarah yang penuh cerita dan keindahan.',
                        'youtube_id' => 'WhW0GBZiRWo'
                    ]
                ]
            ],
        ];

        foreach ($kategoriData as $kategori) {
            $gambar = null;
            $mime = null;

            if (file_exists($kategori['cover_path'])) {
                $gambar = file_get_contents($kategori['cover_path']);
                $ext = pathinfo($kategori['cover_path'], PATHINFO_EXTENSION);
                $mime = match (strtolower($ext)) {
                    'jpg', 'jpeg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                    default => null
                };
            }

            DB::table('kategori')->insert([
                'kode_kategori' => $kategori['kode_kategori'],
                'nama_kategori' => $kategori['nama_kategori'],
                'judul_kategori' => $kategori['judul_kategori'],
                'deskripsi_kategori' => $kategori['deskripsi_kategori'],
                'gambar_cover' => $gambar,
                'mime_type' => $mime,
                'field_rules' => json_encode($kategori['field_rules']),
                'video_sampul' => isset($kategori['video_sampul']) ? json_encode($kategori['video_sampul']) : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}