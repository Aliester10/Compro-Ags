<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            [
                'nama' => 'Hidrolika',
            ],
            [
                'nama' => 'Beton',
            ],
            [
                'nama' => 'Tanah',
            ],
            [
                'nama' => 'Aspal',
            ],
            [
                'nama' => 'Bebatuan',
            ],
            [
                'nama' => 'Manajemen Konstruksi',
            ],
            [
                'nama' => 'Semen',
            ],
            [
                'nama' => 'Kebumian',
            ],
            [
                'nama' => 'Listrik',
            ],
            [
                'nama' => 'Mekanik',
            ],
            [
                'nama' => 'Material',
            ],
            [
                'nama' => 'Industri',
            ],
            [
                'nama' => 'Kelautan',
            ],
            [
                'nama' => 'Perkapalan',
            ],
            [
                'nama' => 'Perkeretaapian',
            ],
        ]);
    }
}
