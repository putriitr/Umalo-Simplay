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
                'alamat' => 'Jl. Matraman Raya No.148, RT.1/RW.4, Kb. Manggis, Kec. Matraman, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13150',
                'maps' => 'https://www.google.com/maps/place/PT.+Arkamaya+Guna+Saharsa/@-6.2114159,106.8600596,15z/data=!4m2!3m1!1s0x0:0x1bc64c80b9328ca6?sa=X&ved=1t:2428&ictx=111',
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
