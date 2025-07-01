<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PemerintahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timelineData = [
            [
                'periode' => '1945-1949',
                'nama_walikota' => 'Mr. Moch.lchsan',
                'nama_wakil_walikota' => null,
                'foto_walikota' => 'pemerintah/MrMochlchsan.jpg',
                'foto_wakil_walikota' => null,
            ],
            [
                'periode' => '1949-1951',
                'nama_walikota' => 'Mr. Koesoebiyono Tjondrowibowo',
                'nama_wakil_walikota' => null,
                'foto_walikota' => 'pemerintah/MrKoesoebiyonoTjondrowibowo.jpg',
                'foto_wakil_walikota' => null,
            ],
            [
                'periode' => '1951-1958',
                'nama_walikota' => 'RM. Hadisoebeno Sosrowerdoyo',
                'nama_wakil_walikota' => null,
                'foto_walikota' => 'pemerintah/RMHadisoebenoSosrowerdoyo.jpg',
                'foto_wakil_walikota' => null,
            ],
            [
                'periode' => '1958-1960',
                'nama_walikota' => 'Mr. Abdulmadjid Djojoadiningrat',
                'nama_wakil_walikota' => null,
                'foto_walikota' => 'pemerintah/MrAbdulmadjidDjojoadiningrat.jpg',
                'foto_wakil_walikota' => null,
            ],
            [
                'periode' => '1961-1964',
                'nama_walikota' => 'RM Soebagyono Tjondrokoesoemo',
                'nama_wakil_walikota' => null,
                'foto_walikota' => 'pemerintah/RMSoebagyonoTjondrokoesoemo.jpg',
                'foto_wakil_walikota' => null,
            ],
            [
                'periode' => '1964-1966',
                'nama_walikota' => 'Mr. Wuryanto',
                'nama_wakil_walikota' => null,
                'foto_walikota' => 'pemerintah/MrWuryanto.jpg',
                'foto_wakil_walikota' => null,
            ],
            [
                'periode' => '1966-1967',
                'nama_walikota' => 'Letkol. Soeparno',
                'nama_wakil_walikota' => null,
                'foto_walikota' => 'pemerintah/LetkolSoeparno.jpg',
                'foto_wakil_walikota' => null,
            ],
            [
                'periode' => '1967-1973',
                'nama_walikota' => 'Letkol. R.Warsito Soegiarto',
                'nama_wakil_walikota' => null,
                'foto_walikota' => 'pemerintah/LetkolRWarsitoSoegiarto.jpg',
                'foto_wakil_walikota' => null,
            ],
            [
                'periode' => '1973-1980',
                'nama_walikota' => 'Kolonel Hadijanto',
                'nama_wakil_walikota' => null,
                'foto_walikota' => 'pemerintah/KolonelHadijanto.jpg',
                'foto_wakil_walikota' => null,
            ],
            [
                'periode' => '1980-1990',
                'nama_walikota' => 'Kol. H. Iman Soeparto Tjakrajoeda SH',
                'nama_wakil_walikota' => null,
                'foto_walikota' => 'pemerintah/KolHImanSoepartoTjakrajoedaSH.jpg',
                'foto_wakil_walikota' => null,
            ],
            [
                'periode' => '1990-2000',
                'nama_walikota' => 'Kolonel H. Soetrisno Suharto',
                'nama_wakil_walikota' => null,
                'foto_walikota' => 'pemerintah/KolonelHSoetrisnoSuharto.jpg',
                'foto_wakil_walikota' => null,
            ],
            [
                'periode' => '2000-2010',
                'nama_walikota' => 'H. Sukawi Sutarip SH.',
                'nama_wakil_walikota' => 'Drs. Mahfudz Ali, M.Si.',
                'foto_walikota' => 'pemerintah/HSukawiSutaripSH.jpg',
                'foto_wakil_walikota' => 'pemerintah/DrsMahfudzAliMSi.jpg',
            ],
            [
                'periode' => '2010-2013',
                'nama_walikota' => 'Drs. H. Soemarmo HS, MSi.',
                'nama_wakil_walikota' => 'Dr. Hendrar Prihadi, S. E., M.M.',
                'foto_walikota' => 'pemerintah/DrsHSoemarmoHSMSi.jpg',
                'foto_wakil_walikota' => 'pemerintah/DrHendrarPrihadiSEMM.jpg',
            ],
            [
                'periode' => '2013-2022',
                'nama_walikota' => 'Dr. Hendrar Prihadi, S. E., M.M.',
                'nama_wakil_walikota' => 'Ir. Hj. Hevearita Gunaryanti Rahayu',
                'foto_walikota' => 'pemerintah/DrHendrarPrihadiSEMM.jpg',
                'foto_wakil_walikota' => 'pemerintah/IrHjHevearitaGunaryantiRahayu.jpg',
            ],
            [
                'periode' => '2023-Now',
                'nama_walikota' => 'Ir. Hj. Hevearita Gunaryanti Rahayu',
                'nama_wakil_walikota' => null,
                'foto_walikota' => 'pemerintah/IrHjHevearitaGunaryantiRahayu.jpg',
                'foto_wakil_walikota' => null,
            ],
        ];

        foreach ($timelineData as $item) {
            $fotoWalikota = null;
            $mimeTypeWalikota = null;
            $fotoWakilWalikota = null;
            $mimeTypeWakilWalikota = null;

            // Proses foto_walikota
            if (!is_null($item['foto_walikota']) && File::exists(public_path($item['foto_walikota']))) {
                $fotoWalikota = File::get(public_path($item['foto_walikota']));
                $ext = strtolower(pathinfo($item['foto_walikota'], PATHINFO_EXTENSION));
                $mimeTypeWalikota = match ($ext) {
                    'jpg', 'jpeg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                    default => null,
                };
            }

            // Proses foto_wakil_walikota
            if (!is_null($item['foto_wakil_walikota']) && File::exists(public_path($item['foto_wakil_walikota']))) {
                $fotoWakilWalikota = File::get(public_path($item['foto_wakil_walikota']));
                $ext = strtolower(pathinfo($item['foto_wakil_walikota'], PATHINFO_EXTENSION));
                $mimeTypeWakilWalikota = match ($ext) {
                    'jpg', 'jpeg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                    default => null,
                };
            }

            DB::table('pemerintah')->insert([
                'periode' => $item['periode'],
                'kode_kategori' => 'PEM',
                'nama_walikota' => $item['nama_walikota'],
                'nama_wakil_walikota' => $item['nama_wakil_walikota'],
                'foto_walikota' => $fotoWalikota,
                'mime_type_walikota' => $mimeTypeWalikota,
                'foto_wakil_walikota' => $fotoWakilWalikota,
                'mime_type_wakil_walikota' => $mimeTypeWakilWalikota,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}