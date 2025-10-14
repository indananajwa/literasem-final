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
                'url_maps' => 'https://maps.app.goo.gl/Y8GbbTvxr45orH7YA',
                'lat' => -6.9680668841051565,
                'lng' => 110.42838301834843
            ],
            [
                'nama' => 'Lawang Sewu',
                'deskripsi' => 'Lawang Sewu adalah bangunan bersejarah di Semarang yang dibangun pada masa kolonial Belanda. Bangunan ini memiliki banyak pintu dan jendela, sehingga dinamakan Lawang Sewu yang berarti "seribu pintu". Arsitektur bangunan ini sangat indah dengan gaya kolonial yang khas.',
                'foto' => file_get_contents(public_path('pariwisata/lawangsewu.jpg')),
                'mime_type' => 'image/jpeg',
                'url_maps' => 'https://maps.app.goo.gl/NMhMrqKEmexaMdeW7',
                'lat' => -6.9838581084117495, 
                'lng' => 110.4107483230353
            ],
            [
                'nama' => 'Sam Poo Kong',
                'deskripsi' => 'Sam Poo Kong adalah kelenteng tertua di Semarang yang dibangun untuk menghormati Laksamana Cheng Ho. Tempat ini menjadi destinasi wisata religi dan budaya yang populer di Semarang.',
                'foto' => file_get_contents(public_path('ibadah/sampokong.jpg')),
                'mime_type' => 'image/jpeg',
                'url_maps' => 'https://maps.app.goo.gl/fGqEy6FriFrFWvEVA',
                'lat' => -6.995334262597111, 
                'lng' => 110.39848030795409
            ],
            [
                'nama' => 'Gereja Blenduk',
                'deskripsi' => 'Gereja Blenduk adalah gereja tertua di Jawa Tengah yang memiliki arsitektur khas dengan kubah tembaga yang menjadi ciri khasnya. Bangunan ini menjadi ikon kawasan Kota Lama Semarang.',
                'foto' => file_get_contents(public_path('smg-masa-lalu-sekarang/gereja-blenduk-sekarang.jpg')),
                'mime_type' => 'image/jpeg',
                'url_maps' => 'https://maps.app.goo.gl/mEYjKnuJd7WrzCP16',
                'lat' => -6.968157082489774, 
                'lng' => 110.42755176438092
            ],
            [
                'nama' => 'Puri Maerokoco',
                'deskripsi' => 'Puri Maerokoco merupakan salah satu destinasi wisata edukatif dan rekreatif di Kota Semarang yang sering disebut sebagai "Taman Mini Jawa Tengah". Tempat ini menampilkan miniatur 35 anjungan dari kabupaten dan kota di seluruh Jawa Tengah, lengkap dengan arsitektur khas daerah, hasil kerajinan, dan potensi pariwisatanya. Selain sebagai pusat informasi budaya dan promosi daerah, Puri Maerokoco juga dilengkapi dengan danau buatan tempat wisatawan dapat berkeliling menggunakan perahu. Suasana taman yang rindang, area bermain anak, hingga spot foto di tepi air menjadikan tempat ini cocok untuk wisata keluarga. Pada waktu-waktu tertentu, lokasi ini juga digunakan untuk berbagai pameran, festival budaya, dan kegiatan edukasi sekolah.',
                'foto' => file_get_contents(public_path('pariwisata/purimaerokoco.jpg')),
                'mime_type' => 'image/jpeg',
                'url_maps' => 'https://maps.app.goo.gl/UkNTKJ7gqBuRMwTAA',
                'lat' => -6.960854148225545,
                'lng' => 110.38928573678972
            ],
            [
                'nama' => 'Kampung Batik Semarang',
                'deskripsi' => 'Kampung Batik Semarang merupakan kawasan wisata budaya yang menjadi pusat pelestarian dan pengembangan seni membatik khas Semarang. Di tempat ini, pengunjung dapat menyaksikan langsung proses pembuatan batik mulai dari tahap menggambar motif, mencanting, hingga pewarnaan. Selain itu, banyak rumah warga yang beralih fungsi menjadi galeri dan toko batik yang menjual berbagai produk unik dengan motif yang terinspirasi dari ikon-ikon Kota Semarang seperti Lawang Sewu dan Tugu Muda. Suasana kampung yang penuh warna dengan mural bertema batik di dinding-dinding rumah menjadikan kawasan ini menarik untuk spot foto dan wisata edukatif. Kampung Batik juga kerap menjadi lokasi pelatihan, pameran, serta festival batik yang melibatkan perajin lokal dan pelajar sebagai bentuk upaya melestarikan warisan budaya tradisional.',
                'foto' => file_get_contents(public_path('pariwisata/Kampung-Batik-Gedong.jpg')),
                'mime_type' => 'image/jpeg',
                'url_maps' => 'https://maps.app.goo.gl/uqYd8L7wxNv8Qkq4A',
                'lat' => -6.968626503203061, 
                'lng' => 110.43186919446188
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