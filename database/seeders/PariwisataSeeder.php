<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pariwisata;

class PariwisataSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Kota Lama',
                'deskripsi' => 'Kota Lama merupakan pusat perdagangan penting, dan untuk melindungi warga serta wilayahnya, dibangunlah benteng Vijfhoek. Jalan utama di dalam benteng tersebut diberi nama Heerenstraat, yang kini dikenal sebagai Jalan Letjen Soeprapto. Kota Lama dijuluki "Little Netherland" karena lanskapnya yang terpisah dan mirip dengan kota-kota di Eropa, serta kanal-kanal air yang mengelilinginya. Arsitektur bangunan di kawasan ini mengusung gaya Eropa dengan pintu utama dan jendela besar, elemen dekoratif, dan langit-langit tinggi.',
                'foto' => file_get_contents(public_path('pariwisata/kotalama.jpg')),
                'mime_type' => 'image/jpeg',
                'url_maps' => 'https://goo.gl/maps/B9gQ5BfLLh62',
                'lat' => -6.9667,
                'lng' => 110.4289
            ],
            [
                'nama' => 'Lawang Sewu',
                'deskripsi' => 'Lawang Sewu adalah bangunan bersejarah di Semarang yang dibangun pada masa kolonial Belanda. Bangunan ini memiliki banyak pintu dan jendela, sehingga dinamakan Lawang Sewu yang berarti "seribu pintu". Arsitektur bangunan ini sangat indah dengan gaya kolonial yang khas.',
                'foto' => file_get_contents(public_path('pariwisata/lawangsewu.jpg')),
                'mime_type' => 'image/jpeg',
                'url_maps' => 'https://goo.gl/maps/B9gQ5BfLLh62',
                'lat' => -6.9833,
                'lng' => 110.4156
            ],
            [
                'nama' => 'Sam Poo Kong',
                'deskripsi' => 'Sam Poo Kong adalah kelenteng tertua di Semarang yang dibangun untuk menghormati Laksamana Cheng Ho. Tempat ini menjadi destinasi wisata religi dan budaya yang populer di Semarang.',
                'foto' => file_get_contents(public_path('pariwisata/kotalama.jpg')),
                'mime_type' => 'image/jpeg',
                'url_maps' => 'https://goo.gl/maps/B9gQ5BfLLh62',
                'lat' => -6.9889,
                'lng' => 110.4078
            ],
            [
                'nama' => 'Gereja Blenduk',
                'deskripsi' => 'Gereja Blenduk adalah gereja tertua di Jawa Tengah yang memiliki arsitektur khas dengan kubah tembaga yang menjadi ciri khasnya. Bangunan ini menjadi ikon kawasan Kota Lama Semarang.',
                'foto' => file_get_contents(public_path('pariwisata/lawangsewu.jpg')),
                'mime_type' => 'image/jpeg',
                'url_maps' => 'https://goo.gl/maps/B9gQ5BfLLh62',
                'lat' => -6.9678,
                'lng' => 110.4278
            ],
            [
                'nama' => 'Tugu Muda',
                'deskripsi' => 'Tugu Muda adalah monumen bersejarah yang dibangun untuk mengenang jasa para pahlawan dalam Pertempuran Lima Hari di Semarang. Monumen ini menjadi landmark kota Semarang.',
                'foto' => file_get_contents(public_path('pariwisata/kotalama.jpg')),
                'mime_type' => 'image/jpeg',
                'url_maps' => 'https://goo.gl/maps/B9gQ5BfLLh62',
                'lat' => -6.9845,
                'lng' => 110.4134
            ],
            [
                'nama' => 'Brown Canyon',
                'deskripsi' => 'Brown Canyon adalah destinasi wisata alam yang menawarkan pemandangan mirip Grand Canyon dengan tebing-tebing coklat yang indah. Tempat ini menjadi spot foto favorit wisatawan.',
                'foto' => file_get_contents(public_path('pariwisata/lawangsewu.jpg')),
                'mime_type' => 'image/jpeg',
                'url_maps' => 'https://goo.gl/maps/B9gQ5BfLLh62',
                'lat' => -7.0456,
                'lng' => 110.4267
            ],
            [
                'nama' => 'Kampung Batik Semarang',
                'deskripsi' => 'Kampung Batik adalah kawasan yang melestarikan budaya membatik di Semarang. Di sini wisatawan dapat melihat proses pembuatan batik dan membeli berbagai produk batik khas Semarang.',
                'foto' => file_get_contents(public_path('pariwisata/kotalama.jpg')),
                'mime_type' => 'image/jpeg',
                'url_maps' => 'https://goo.gl/maps/B9gQ5BfLLh62',
                'lat' => -6.9756,
                'lng' => 110.4123
            ],
            [
                'nama' => 'Masjid Agung Jawa Tengah',
                'deskripsi' => 'Masjid Agung Jawa Tengah adalah masjid megah dengan arsitektur modern yang memadukan unsur Jawa, Islam, dan Romawi. Masjid ini memiliki menara setinggi 99 meter yang menjadi daya tarik utama.',
                'foto' => file_get_contents(public_path('pariwisata/lawangsewu.jpg')),
                'mime_type' => 'image/jpeg',
                'url_maps' => 'https://goo.gl/maps/B9gQ5BfLLh62',
                'lat' => -6.9823,
                'lng' => 110.4512
            ],
        ];

        // Insert data dengan kode otomatis
        foreach ($data as $index => $item) {
            // Generate kode pariwisata otomatis
            $kodePariwisata = 'PAR' . sprintf("%03d", $index + 1);
            
            DB::table('pariwisata')->insert([
                'kodePariwisata' => $kodePariwisata,
                'nama' => $item['nama'],
                'deskripsi' => $item['deskripsi'],
                'foto' => $item['foto'],
                'mime_type' => $item['mime_type'],
                'url_maps' => $item['url_maps'],
                'lat' => $item['lat'],
                'lng' => $item['lng'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}