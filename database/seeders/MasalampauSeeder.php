<?php

namespace Database\Seeders;

use App\Models\Masalampau;
use Illuminate\Database\Seeder;

class MasalampauSeeder extends Seeder
{
    public function run()
    {
        Masalampau::create([
            'judul' => 'Tugu Muda',
            'image_lalu' => '/smg-masa-lalu-sekarang/tugumuda1953.jpg',
            'image_sekarang' => '/smg-masa-lalu-sekarang/tugumuda2024.jpg',
            'labels' => json_encode(['year' => '1953']),
            'description' => json_encode([
                "<strong>Tugu Muda</strong> terletak di pusat Kota Semarang, di persimpangan lima jalan utama, menjadi monumen ikonik yang mengenang perjuangan kemerdekaan. Dibangun pada tahun 1953, tugu ini awalnya dikenal sebagai \"Vrijheidsmonument\" pada masa kolonial.",
                "Monumen ini didedikasikan untuk mengenang <strong>Pertempuran Lima Hari Semarang</strong> (14-19 Oktober 1945), di mana para pemuda berjuang melawan penjajah. Transformasi fisik dan maknanya mencerminkan semangat kemerdekaan Indonesia."
            ])
        ]);

        Masalampau::create([
            'judul' => 'Lawang Sewu',
            'image_lalu' => '/smg-masa-lalu-sekarang/lawangsewutahun1930.jpg',
            'image_sekarang' => '/smg-masa-lalu-sekarang/lawangsewu2024.jpg',
            'labels' => json_encode(['year' => '1930']),
            'description' => json_encode([
                "<strong>Lawang Sewu</strong> adalah gedung bersejarah milik PT Kereta Api Indonesia (Persero), dibangun sebagai kantor pusat Nederlandsch-Indische Spoorweg Maatschappij (NIS). Dikenal dengan ratusan pintu dan jendelanya, bangunan ini adalah mahakarya arsitektur Art Nouveau.",
                "Dari masa kolonial hingga menjadi museum heritage, Lawang Sewu telah menyaksikan berbagai era, termasuk pendudukan Jepang dan perjuangan kemerdekaan, menjadikannya simbol ketahanan dan keindahan sejarah."
            ])
        ]);

        Masalampau::create([
            'judul' => 'Kota Lama',
            'image_lalu' => '/img/kota-lama-sejarah.jpg',
            'image_sekarang' => '/img/kota-lama-sekarang.jpg',
            'labels' => json_encode(['year' => '1900']),
            'description' => json_encode([
                "<strong>Kawasan Kota Lama</strong> adalah jantung perekonomian masa kolonial yang kini menjelma menjadi destinasi wisata heritage terpopuler. Dengan arsitektur Eropa yang autentik dan penataan kota yang terencana, kawasan ini dijuluki \"Little Netherlands\".",
                "Transformasi dari pusat perdagangan kolonial menjadi kawasan wisata budaya menunjukkan bagaimana warisan sejarah dapat dilestarikan sambil memberikan nilai ekonomi bagi masyarakat modern."
            ])
        ]);

        Masalampau::create([
            'judul' => 'Stasiun Tawang',
            'image_lalu' => '/img/stasiun-tawang-lama.jpg',
            'image_sekarang' => '/img/stasiun-tawang-sekarang.jpg',
            'labels' => json_encode(['year' => '1868']),
            'description' => json_encode([
                "<strong>Stasiun Tawang</strong> adalah pionir transportasi kereta api di Jawa Tengah, menjadi saksi hidup revolusi transportasi yang mengubah wajah perekonomian Nusantara. Sebagai stasiun tertua di Semarang, ia menjadi penghubung vital jalur Semarang-Yogyakarta-Solo.",
                "Keunikan Stasiun Tawang terletak pada kemampuannya mempertahankan fungsi operasional sambil melestarikan nilai historis. Hingga kini, stasiun ini tetap melayani perjalanan sambil menjadi destinasi wisata heritage yang memikat."
            ])
        ]);

        Masalampau::create([
            'judul' => 'Stasiun Semarang NIS',
            'image_lalu' => '/smg-masa-lalu-sekarang/stasiunsemarangnis1905.png',
            'image_sekarang' => '/smg-masa-lalu-sekarang/KampungSpoorland2024.jpg',
            'labels' => json_encode(['year' => '1905']),
            'description' => json_encode([
                "<strong>Stasiun Samarang NIS</strong>, atau dikenal sebagai Stasiun Kemidjen NIS, dibangun pada 17 Juni 1864 sebagai salah satu stasiun kereta api tertua di Indonesia. Stasiun ini menjadi pusat penting transportasi pada masa kolonial Belanda.",
                "Kini, lokasi ini telah bertransformasi menjadi <strong>Kampung Spoorland</strong>, sebuah kawasan wisata yang menggabungkan nilai sejarah dengan daya tarik modern, menawarkan pengalaman budaya dan edukasi bagi pengunjung."
            ])
        ]);

        Masalampau::create([
            'judul' => 'Mercusuar Willem',
            'image_lalu' => '/smg-masa-lalu-sekarang/mercusuarwillem1915.jpg',
            'image_sekarang' => '/smg-masa-lalu-sekarang/mercusuarwillem2024.jpg',
            'labels' => json_encode(['year' => '1915']),
            'description' => json_encode([
                "<strong>Mercusuar Willem</strong> didirikan pada masa kolonial Belanda antara tahun 1879 hingga 1884, berfungsi sebagai penanda navigasi penting di pantai Semarang. Struktur ini menjadi saksi perkembangan pelabuhan kota.",
                "Hingga kini, mercusuar ini tetap berdiri sebagai simbol ketahanan maritim, menarik wisatawan yang ingin menelusuri warisan bahari Semarang."
            ])
        ]);

        Masalampau::create([
            'judul' => 'Wisma Perdamaian',
            'image_lalu' => '/smg-masa-lalu-sekarang/wismaperdamaian1920.jpg',
            'image_sekarang' => '/smg-masa-lalu-sekarang/wismaperdamaian2024.jpg',
            'labels' => json_encode(['year' => '1920']),
            'description' => json_encode([
                "<strong>Wisma Perdamaian</strong>, dahulu dikenal sebagai Residence de Gubernur van Java’s Noordoosthoek, adalah bangunan kolonial abad ke-19 yang mencerminkan keanggunan arsitektur Belanda.",
                "Kini, bangunan ini menjadi simbol warisan budaya, sering digunakan untuk acara resmi dan kunjungan wisata, mempertahankan pesona sejarahnya sambil relevan di era modern."
            ])
        ]);

        Masalampau::create([
            'judul' => 'Stasiun Poncol Semarang',
            'image_lalu' => '/smg-masa-lalu-sekarang/stasiunponcol1927.jpg',
            'image_sekarang' => '/smg-masa-lalu-sekarang/stasiunponcol2024.jpg',
            'labels' => json_encode(['year' => '1927']),
            'description' => json_encode([
                "<strong>Stasiun Semarang Poncol</strong>, yang secara resmi bernama 'Semarang West', terletak di daerah Poncol, Semarang. Stasiun ini menjadi bagian penting dari jaringan kereta api sejak awal abad ke-20.",
                "Dengan arsitektur klasiknya, stasiun ini terus beroperasi sebagai penghubung transportasi sambil mempertahankan nilai historis sebagai salah satu warisan kolonial."
            ])
        ]);

        Masalampau::create([
            'judul' => 'Balai Kota Semarang',
            'image_lalu' => '/smg-masa-lalu-sekarang/balaikota1920.jpg',
            'image_sekarang' => '/smg-masa-lalu-sekarang/balaikota2024.jpg',
            'labels' => json_encode(['year' => '1920']),
            'description' => json_encode([
                "<strong>Balai Kota Semarang</strong> awalnya merupakan villa milik keluarga Gimberg di Jalan Pemuda No. 148, dibangun pada era kolonial. Bangunan ini kemudian diubah menjadi pusat pemerintahan kota.",
                "Dengan arsitektur klasiknya, Balai Kota tetap menjadi landmark penting yang memadukan fungsi administratif dengan nilai sejarah yang kaya."
            ])
        ]);

        Masalampau::create([
            'judul' => 'Jalan Pahlawan',
            'image_lalu' => '/smg-masa-lalu-sekarang/jalanpahlawan1920.jpg',
            'image_sekarang' => '/smg-masa-lalu-sekarang/jalanpahlawan2024.jpg',
            'labels' => json_encode(['year' => '1920']),
            'description' => json_encode([
                "<strong>Jalan Pahlawan</strong>, yang dulu dikenal sebagai Oei Tiong Ham Weg di kawasan Candi Baru, Semarang, adalah salah satu arteri penting kota pada masa kolonial.",
                "Kini, jalan ini menjadi simbol modernitas dan sejarah, menghubungkan berbagai landmark penting sambil menyimpan kenangan masa lalu."
            ])
        ]);

        Masalampau::create([
            'judul' => 'Jalan Tanjakan Gombel',
            'image_lalu' => '/smg-masa-lalu-sekarang/tanjakangombel1920.jpg',
            'image_sekarang' => '/smg-masa-lalu-sekarang/tanjakangombel2024.jpg',
            'labels' => json_encode(['year' => '1920']),
            'description' => json_encode([
                "<strong>Jalan Tanjakan Gombel</strong> awalnya merupakan kawasan makam pecinan leluhur para etnis Tionghoa di Semarang, mencerminkan kekayaan budaya masyarakat Tionghoa pada masa itu.",
                "Kini, jalan ini dikenal sebagai salah satu jalur ikonik dengan pemandangan kota yang menakjubkan, menjadi destinasi populer bagi warga lokal dan wisatawan."
            ])
        ]);
    }
}