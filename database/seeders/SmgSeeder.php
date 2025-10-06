<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SmgSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedMasaLalu();
        $this->seedMasaDepan();
    }

    private function seedMasaLalu(): void
    {
        $data = [
            [
                'kode_lokasi' => 'SML001',
                'judul' => 'Tugu Muda',
                'deskripsi' => "<strong>Tugu Muda</strong> terletak di pusat Kota Semarang, di persimpangan lima jalan utama, menjadi monumen ikonik yang mengenang perjuangan kemerdekaan. Dibangun pada tahun 1953, tugu ini awalnya dikenal sebagai \"Vrijheidsmonument\" pada masa kolonial.\n\nMonumen ini didedikasikan untuk mengenang <strong>Pertempuran Lima Hari Semarang</strong> (14-19 Oktober 1945), di mana para pemuda berjuang melawan penjajah. Transformasi fisik dan maknanya mencerminkan semangat kemerdekaan Indonesia.",
                'foto_sebelum' => 'smg-masa-lalu-sekarang/tugu-muda-1953.jpg',
                'foto_sesudah' => 'smg-masa-lalu-sekarang/tugu-muda-2024.jpg',
                'label_sebelum' => 'Vrijheidsmonument',
                'label_sesudah' => 'Tugu Muda',
                'tahun_sebelum' => '1953',
                'tahun_sesudah' => '2024',
            ],
            [
                'kode_lokasi' => 'SML002',
                'judul' => 'Lawang Sewu',
                'deskripsi' => "<strong>Lawang Sewu</strong> adalah gedung bersejarah milik PT Kereta Api Indonesia (Persero), dibangun sebagai kantor pusat Nederlandsch-Indische Spoorweg Maatschappij (NIS). Dikenal dengan ratusan pintu dan jendelanya, bangunan ini adalah mahakarya arsitektur Art Nouveau.\n\nDari masa kolonial hingga menjadi museum heritage, Lawang Sewu telah menyaksikan berbagai era, termasuk pendudukan Jepang dan perjuangan kemerdekaan, menjadikannya simbol ketahanan dan keindahan sejarah.",
                'foto_sebelum' => 'smg-masa-lalu-sekarang/lawangsewutahun1930.jpg',
                'foto_sesudah' => 'smg-masa-lalu-sekarang/lawangsewu2024.jpg',
                'label_sebelum' => 'Kantor NIS',
                'label_sesudah' => 'Museum Heritage',
                'tahun_sebelum' => '1930',
                'tahun_sesudah' => '2024',
            ],
            [
                'kode_lokasi' => 'SML003',
                'judul' => 'Kota Lama',
                'deskripsi' => "<strong>Kawasan Kota Lama</strong> adalah jantung perekonomian masa kolonial yang kini menjelma menjadi destinasi wisata heritage terpopuler. Dengan arsitektur Eropa yang autentik dan penataan kota yang terencana, kawasan ini dijuluki \"Little Netherlands\".\n\nTransformasi dari pusat perdagangan kolonial menjadi kawasan wisata budaya menunjukkan bagaimana warisan sejarah dapat dilestarikan sambil memberikan nilai ekonomi bagi masyarakat modern.",
                'foto_sebelum' => 'img/kota-lama-sejarah.jpg',
                'foto_sesudah' => 'img/kota-lama-sekarang.jpg',
                'label_sebelum' => 'Pusat Dagang',
                'label_sesudah' => 'Little Netherlands',
                'tahun_sebelum' => '1900',
                'tahun_sesudah' => '2024',
            ],
            [
                'kode_lokasi' => 'SML004',
                'judul' => 'Gereja Blenduk',
                'deskripsi' => "<strong>Gereja Blenduk</strong>, atau <em>Gereja GPIB Immanuel</em>, adalah ikon arsitektur religius di Kota Lama. Dibangun tahun 1753, gereja ini terkenal dengan kubah besar berwarna merah bata yang menjadi ciri khas utamanya.\n\nDari masa kolonial Belanda hingga kini, gereja ini tetap menjadi pusat kegiatan rohani dan simbol toleransi. Keindahan arsitekturnya menjadikannya salah satu landmark Semarang yang mendunia.",
                'foto_sebelum' => 'img/gereja-blenduk-sejarah.jpg',
                'foto_sesudah' => 'img/gereja-blenduk-sekarang.jpg',
                'label_sebelum' => 'Oud Kerk',
                'label_sesudah' => 'Gereja Blenduk',
                'tahun_sebelum' => '1753',
                'tahun_sesudah' => '2024',
            ],
            [
                'kode_lokasi' => 'SML005',
                'judul' => 'Simpang Lima',
                'deskripsi' => "<strong>Simpang Lima</strong> adalah alun-alun modern Kota Semarang yang mulai dibangun tahun 1969. Lokasi ini menjadi pusat aktivitas warga, tempat berkumpul, olahraga, hiburan, hingga pusat kuliner malam.\n\nDari hamparan tanah lapang menjadi pusat kota yang ramai, Simpang Lima mencerminkan perkembangan urbanisasi Semarang sekaligus ruang sosial yang hidup hingga kini.",
                'foto_sebelum' => 'img/simpang-lima-sejarah.jpg',
                'foto_sesudah' => 'img/simpang-lima-sekarang.jpg',
                'label_sebelum' => 'Lapangan Pancasila',
                'label_sesudah' => 'Simpang Lima',
                'tahun_sebelum' => '1969',
                'tahun_sesudah' => '2024',
            ],
            [
                'kode_lokasi' => 'SML006',
                'judul' => 'Masjid Agung Jawa Tengah',
                'deskripsi' => "<strong>Masjid Agung Jawa Tengah</strong> dibangun pada 2001-2006 dengan arsitektur megah yang memadukan gaya Jawa, Islam, dan Romawi. Salah satu cirinya adalah enam payung hidrolik raksasa yang bisa dibuka seperti di Masjid Nabawi, Madinah.\n\nMasjid ini kini menjadi pusat wisata religi sekaligus landmark spiritual modern Semarang.",
                'foto_sebelum' => 'img/majt-sejarah.jpg',
                'foto_sesudah' => 'img/majt-sekarang.jpg',
                'label_sebelum' => 'Pembangunan MAJT',
                'label_sesudah' => 'Masjid Agung Jawa Tengah',
                'tahun_sebelum' => '2001',
                'tahun_sesudah' => '2024',
            ],
            [
                'kode_lokasi' => 'SML007',
                'judul' => 'Sam Poo Kong',
                'deskripsi' => "<strong>Klenteng Sam Poo Kong</strong> adalah tempat bersejarah yang diyakini menjadi persinggahan Laksamana Cheng Ho pada abad ke-15. Kompleks klenteng ini awalnya merupakan gua batu tempat Cheng Ho beristirahat.\n\nKini, Sam Poo Kong telah berkembang menjadi tempat ibadah sekaligus destinasi wisata budaya yang memadukan sejarah Tionghoa, Jawa, dan Islam.",
                'foto_sebelum' => 'img/sam-poo-kong-sejarah.jpg',
                'foto_sesudah' => 'img/sam-poo-kong-sekarang.jpg',
                'label_sebelum' => 'Sam Po Tay Djien',
                'label_sesudah' => 'Sam Poo Kong',
                'tahun_sebelum' => '1400',
                'tahun_sesudah' => '2024',
            ],
            [
                'kode_lokasi' => 'SML008',
                'judul' => 'Stasiun Tawang',
                'deskripsi' => "<strong>Stasiun Tawang</strong>, dibuka tahun 1868, adalah salah satu stasiun tertua di Indonesia. Dibangun oleh NIS, stasiun ini menjadi pintu utama perdagangan dan mobilitas di Semarang.\n\nMeskipun sering dilanda rob, stasiun ini tetap berfungsi hingga sekarang dan sedang direvitalisasi sebagai warisan transportasi modern.",
                'foto_sebelum' => 'img/stasiun-tawang-sejarah.jpg',
                'foto_sesudah' => 'img/stasiun-tawang-sekarang.jpg',
                'label_sebelum' => 'NIS Station',
                'label_sesudah' => 'Stasiun Tawang',
                'tahun_sebelum' => '1868',
                'tahun_sesudah' => '2024',
            ],
            [
                'kode_lokasi' => 'SML009',
                'judul' => 'Museum Mandala Bhakti',
                'deskripsi' => "<strong>Museum Mandala Bhakti</strong> awalnya adalah Raad van Justitie (Pengadilan Tinggi) pada masa Belanda, dibangun tahun 1930 dengan arsitektur neoklasik. Setelah kemerdekaan, gedung ini dialihfungsikan menjadi museum perjuangan TNI.\n\nKini museum ini menyimpan koleksi sejarah militer Indonesia, menjadikannya saksi perjalanan bangsa.",
                'foto_sebelum' => 'img/mandala-bhakti-sejarah.jpg',
                'foto_sesudah' => 'img/mandala-bhakti-sekarang.jpg',
                'label_sebelum' => 'Raad van Justitie',
                'label_sesudah' => 'Museum Mandala Bhakti',
                'tahun_sebelum' => '1930',
                'tahun_sesudah' => '2024',
            ],
            [
                'kode_lokasi' => 'SML010',
                'judul' => 'Kampung Batik Semarang',
                'deskripsi' => "<strong>Kampung Batik Semarang</strong> dulunya adalah sentra batik sejak abad ke-19, namun sempat hilang akibat kebakaran tahun 1940-an. Kini kawasan ini direvitalisasi menjadi pusat kerajinan batik dan wisata budaya.\n\nKampung ini melestarikan tradisi batik Semarangan dengan motif khas, menjadi bukti semangat kebangkitan UMKM.",
                'foto_sebelum' => 'img/kampung-batik-sejarah.jpg',
                'foto_sesudah' => 'img/kampung-batik-sekarang.jpg',
                'label_sebelum' => 'Sentra Batik Lama',
                'label_sesudah' => 'Kampung Batik Semarang',
                'tahun_sebelum' => '1900',
                'tahun_sesudah' => '2024',
            ],
            [
                'kode_lokasi' => 'SML011',
                'judul' => 'Kampung Pelangi',
                'deskripsi' => "<strong>Kampung Pelangi</strong> awalnya adalah perkampungan kumuh di bantaran Kali Semarang. Tahun 2017, kawasan ini diubah dengan mengecat rumah-rumah warga penuh warna, menjadikannya destinasi wisata baru.\n\nTransformasi ini menjadi bukti inovasi urban berbasis partisipasi warga dan kreativitas, yang mengangkat citra positif kota.",
                'foto_sebelum' => 'img/kampung-pelangi-sejarah.jpg',
                'foto_sesudah' => 'img/kampung-pelangi-sekarang.jpg',
                'label_sebelum' => 'Perkampungan Kumuh',
                'label_sesudah' => 'Kampung Pelangi',
                'tahun_sebelum' => '2016',
                'tahun_sesudah' => '2024',
            ],
        ];

        foreach ($data as $item) {
            $fotoSebelum = null;
            $mimeSebelum = null;
            $fotoSesudah = null;
            $mimeSesudah = null;

            if ($item['foto_sebelum'] && File::exists(public_path($item['foto_sebelum']))) {
                $fotoSebelum = File::get(public_path($item['foto_sebelum']));
                $ext = strtolower(pathinfo($item['foto_sebelum'], PATHINFO_EXTENSION));
                $mimeSebelum = $ext === 'png' ? 'image/png' : 'image/jpeg';
            }

            if ($item['foto_sesudah'] && File::exists(public_path($item['foto_sesudah']))) {
                $fotoSesudah = File::get(public_path($item['foto_sesudah']));
                $ext = strtolower(pathinfo($item['foto_sesudah'], PATHINFO_EXTENSION));
                $mimeSesudah = $ext === 'png' ? 'image/png' : 'image/jpeg';
            }

            DB::table('smgMasaLalu')->insert([
                'kode_lokasi' => $item['kode_lokasi'],
                'judul' => $item['judul'],
                'deskripsi' => $item['deskripsi'],
                'foto_sebelum' => $fotoSebelum,
                'mime_type_sebelum' => $mimeSebelum,
                'foto_sesudah' => $fotoSesudah,
                'mime_type_sesudah' => $mimeSesudah,
                'label_sebelum' => $item['label_sebelum'],
                'label_sesudah' => $item['label_sesudah'],
                'tahun_sebelum' => $item['tahun_sebelum'],
                'tahun_sesudah' => $item['tahun_sesudah'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function seedMasaDepan(): void
    {
        $data = [
            [
                'kode_video' => 'SMD001',
                'judul' => 'Implementasi Smart City dan SPBE ke Kota Semarang',
                'video' => 'QRx7mcsaUhI',
                'deskripsi' => 'Wali Kota Semarang Hendrar Prihadi sejak 2013 mencanangkan Semarang Smart City untuk meningkatkan kualitas pelayanan publik melalui teknologi informasi dan komunikasi.',
            ],
            [
                'kode_video' => 'SMD002',
                'judul' => 'Program Semarang Smart City',
                'video' => 'N_46mWMdmvQ',
                'deskripsi' => 'Video ini menjelaskan program Semarang Smart City yang mencakup berbagai inovasi teknologi untuk meningkatkan efisiensi layanan kota dan kualitas hidup masyarakat.',
            ],
            [
                'kode_video' => 'SMD003',
                'judul' => 'Transformasi Digital Semarang',
                'video' => 'crkJHJgA8uo',
                'deskripsi' => 'Dokumentasi perjalanan transformasi digital Kota Semarang menuju smart city yang berkelanjutan dengan berbagai inovasi dan terobosan teknologi.',
            ],
        ];

        foreach ($data as $item) {
            DB::table('smgMasaDepan')->insert([
                'kode_video' => $item['kode_video'],
                'judul' => $item['judul'],
                'video' => $item['video'],
                'deskripsi' => $item['deskripsi'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}