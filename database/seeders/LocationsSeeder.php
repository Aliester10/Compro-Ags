<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            [
                "province" => "Aceh",
                "latitude" => 4.695135,
                "longitude" => 96.749397
            ],
            [
                "province" => "Sumatera Utara",
                "latitude" => 2.115354,
                "longitude" => 99.545097
            ],
            [
                "province" => "Sumatera Barat",
                "latitude" => -0.789275,
                "longitude" => 100.650055
            ],
            [
                "province" => "Riau",
                "latitude" => 0.511,
                "longitude" => 101.447777
            ],
            [
                "province" => "Kepulauan Riau",
                "latitude" => 3.945,
                "longitude" => 108.142866
            ],
            [
                "province" => "Jambi",
                "latitude" => -1.485,
                "longitude" => 103.738
            ],
            [
                "province" => "Sumatera Selatan",
                "latitude" => -3.319437,
                "longitude" => 104.914551
            ],
            [
                "province" => "Bengkulu",
                "latitude" => -3.57785,
                "longitude" => 102.346387
            ],
            [
                "province" => "Lampung",
                "latitude" => -5.45,
                "longitude" => 105.266
            ],
            [
                "province" => "Bangka Belitung",
                "latitude" => -2.741,
                "longitude" => 106.441
            ],
            [
                "province" => "DKI Jakarta",
                "latitude" => -6.208763,
                "longitude" => 106.845599
            ],
            [
                "province" => "Jawa Barat",
                "latitude" => -6.90389,
                "longitude" => 107.61861
            ],
            [
                "province" => "Banten",
                "latitude" => -6.120656,
                "longitude" => 106.150276
            ],
            [
                "province" => "Jawa Tengah",
                "latitude" => -7.150975,
                "longitude" => 110.140259
            ],
            [
                "province" => "DI Yogyakarta",
                "latitude" => -7.79558,
                "longitude" => 110.369492
            ],
            [
                "province" => "Jawa Timur",
                "latitude" => -7.536063,
                "longitude" => 112.238402
            ],
            [
                "province" => "Bali",
                "latitude" => -8.409518,
                "longitude" => 115.188919
            ],
            [
                "province" => "Nusa Tenggara Barat",
                "latitude" => -8.652933,
                "longitude" => 117.361647
            ],
            [
                "province" => "Nusa Tenggara Timur",
                "latitude" => -10.177328,
                "longitude" => 123.607032
            ],
            [
                "province" => "Kalimantan Barat",
                "latitude" => -0.026,
                "longitude" => 109.341
            ],
            [
                "province" => "Kalimantan Tengah",
                "latitude" => -1.681,
                "longitude" => 113.382
            ],
            [
                "province" => "Kalimantan Selatan",
                "latitude" => -3.092,
                "longitude" => 115.283
            ],
            [
                "province" => "Kalimantan Timur",
                "latitude" => 0.532,
                "longitude" => 116.357
            ],
            [
                "province" => "Kalimantan Utara",
                "latitude" => 3.045,
                "longitude" => 116.872
            ],
            [
                "province" => "Sulawesi Utara",
                "latitude" => 1.54,
                "longitude" => 124.848
            ],
            [
                "province" => "Sulawesi Tengah",
                "latitude" => -0.894,
                "longitude" => 119.852
            ],
            [
                "province" => "Sulawesi Selatan",
                "latitude" => -3.668,
                "longitude" => 119.974
            ],
            [
                "province" => "Sulawesi Tenggara",
                "latitude" => -4.129,
                "longitude" => 122.518
            ],
            [
                "province" => "Gorontalo",
                "latitude" => 0.699,
                "longitude" => 122.446
            ],
            [
                "province" => "Sulawesi Barat",
                "latitude" => -2.471,
                "longitude" => 119.232
            ],
            [
                "province" => "Maluku",
                "latitude" => -3.238,
                "longitude" => 129.482
            ],
            [
                "province" => "Maluku Utara",
                "latitude" => 0.849,
                "longitude" => 127.527
            ],
            [
                "province" => "Papua",
                "latitude" => -4.269928,
                "longitude" => 138.080353
            ],
            [
                "province" => "Papua Barat",
                "latitude" => -1.336115,
                "longitude" => 132.990944
            ],
            [
                "province" => "Papua Tengah",
                "latitude" => -3.789497,
                "longitude" => 137.700348
            ],
            [
                "province" => "Papua Selatan",
                "latitude" => -7.927292,
                "longitude" => 139.659606
            ],
            [
                "province" => "Papua Pegunungan",
                "latitude" => -3.734558,
                "longitude" => 140.695372
            ]
        ]);
    }
}
