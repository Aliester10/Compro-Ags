<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bidang_perusahaan')->insert([
            [
                'name' => 'Sekolah Menengah Atas',
            ],
            [
                'name' => 'Sekolah Menengah Kejuruan',
            ],
            [
                'name' => 'Universitas Negeri',
            ],
            [
                'name' => 'Universitas Swasta',
            ],
            [
                'name' => 'Sekolah Kedinasan',
            ],
            [
                'name' => 'Institute of Technology',
            ],
            [
                'name' => 'Laboratorium Medis',
            ],
            [
                'name' => 'Laboratorium Penelitian',
            ],
            [
                'name' => 'Industri Peralatan Laboratorium',
            ],
            [
                'name' => 'Rumah Sakit',
            ],
            [
                'name' => 'Apotek',
            ],
            [
                'name' => 'Klinik Kesehatan',
            ],
            [
                'name' => 'Pemerintahan',
            ],
            [
                'name' => 'Kementerian',
            ],
            [
                'name' => 'Lembaga Pendidikan',
            ],
            [
                'name' => 'Distribusi Peralatan Medis',
            ],
            [
                'name' => 'Penelitian Ilmiah',
            ],
            [
                'name' => 'Teknik Kimia',
            ],
            [
                'name' => 'Bioteknologi',
            ],
            [
                'name' => 'Layanan Pengujian',
            ]
        ]);
    }
}
