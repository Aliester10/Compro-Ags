<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('compro_parameter')->insert([
            [
                'email' => 'info@labtek.id',
                'no_telepon' => '(021) 85850913',
                'no_wa' => '+62 852-1791-1213',
                'alamat' => 'Perkantoran Mitra Matraman Jl. Matraman Raya.148 Blok A2 No. 3, Kb. Manggis, Kec. Matraman, Daerah Khusus Ibukota Jakarta 13150',
                'maps' => 'https://maps.app.goo.gl/9n5DJ9L4nUVFDCZg9',
                'visi' => 'Perusahaan rintisan teknologi yang menyediakan solusi inovatif untuk tumbuh dan memberikan nilai tambah bagi industri Anda.',
                'misi' => 'Dengan memberikan pelayanan terbaik melalui inovasi sehingga Anda mendapatkan solusi yang tepat dalam memenuhi setiap kebutuhan dengan orientasi yang detail dan juga garansi yang dapat diandalkan.',
                'instagram' => 'None',
                'linkedin' => 'https://www.linkedin.com/company/arkamaya-guna-saharsa/?originalSubdomain=id',
                'ekatalog' => 'https://e-katalog.lkpp.go.id/info/penyedia/444815?komoditasId=812',
                'nama_perusahaan' => 'PT Arkamaya Guna Saharsa',
                'sejarah_singkat' => 'Arkamaya Guna Saharsa adalah perusahaan rintisan teknologi yang digerakkan oleh inovasi, yang berdedikasi untuk memberdayakan industri dengan solusi transformatif. Kami mengkhususkan diri dalam mengoptimalkan kinerja industri melalui merek kami, Labtek dan Labverse. Produk-produk ini dirancang untuk meningkatkan efektivitas, efisiensi, dan kualitas, memberikan nilai tambah melalui teknologi mutakhir. Misi kami adalah memberikan hasil yang unggul dengan memperkenalkan kemajuan teknologi baru atau menata ulang solusi yang sudah ada untuk memenuhi kebutuhan industri yang terus berkembang ..',
            ]
        ]);
    }
}
