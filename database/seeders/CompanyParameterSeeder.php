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
                'email' => 'info@simplay.co.id',
                'no_telepon' => '(021) 22097542',
                'no_wa' => '+62 821-69998-0001',
                'alamat' => 'Jalan Raya Pondok Gede nomor 81 B, Kel. Lubang Buaya, Kec. Cipayung, Kota Adm. Jakarta Timur, Provinsi DKI Jakarta 13810',
                'maps' => 'https://www.google.com/maps/place/PT.+Arkamaya+Guna+Saharsa/@-6.2114159,106.8600596,15z/data=!4m2!3m1!1s0x0:0x1bc64c80b9328ca6?sa=X&ved=1t:2428&ictx=111',
                'visi' => 'Perusahaan rintisan teknologi yang menyediakan solusi inovatif untuk tumbuh dan memberikan nilai tambah bagi industri Anda.',
                'misi' => 'Dengan memberikan pelayanan terbaik melalui inovasi sehingga Anda mendapatkan solusi yang tepat dalam memenuhi setiap kebutuhan dengan orientasi yang detail dan juga garansi yang dapat diandalkan.',
                'instagram' => 'None',
                'linkedin' => 'https://www.linkedin.com/company/arkamaya-guna-saharsa/?originalSubdomain=id',
                'ekatalog' => 'https://e-katalog.lkpp.go.id/info/penyedia/444815?komoditasId=812',
                'nama_perusahaan' => 'PT Simplay Abyakta Mediatek',
                'sejarah_singkat' => 'SIMPLAY YOUR DIGITAL SOLUTIONS adalah perusahaan yang bergerak di bidang Perdagangan serta Penyedia barang Elektronik dan Peralatan Pendukungnya yang didirikan pada tahun 2020. Kami menyediakan solusi bisnis yang inovatif kepada perusahaan yang menjadi konsumen kami...',
            ]
        ]);
    }
}
s
