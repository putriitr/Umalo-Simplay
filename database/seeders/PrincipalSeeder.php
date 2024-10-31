<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Principal;

class PrincipalSeeder extends Seeder
{
    public function run()
    {
        Principal::create([
            'gambar' => 'assets/img/users/user (1).png',
            'type' => 'principal',
            'url' => 'url1',
            'nama' => 'Principal1',
        ]);

        Principal::create([
            'gambar' => 'assets/img/users/user (2).png',
            'type' => 'principal',
            'url' => 'url2',
            'nama' => 'Principal2',
        ]);

        Principal::create([
            'gambar' => 'assets/img/users/user (3).png',
            'type' => 'principal',
            'url' => 'url3',
            'nama' => 'Principal3',
        ]);

        Principal::create([
            'gambar' => 'assets/img/users/user (4).png',
            'type' => 'principal',
            'url' => 'url4',
            'nama' => 'Principal4',
        ]);

        Principal::create([
            'gambar' => 'assets/img/users/user (5).png',
            'type' => 'principal',
            'url' => 'url5',
            'nama' => 'Principal5',
        ]);

        Principal::create([
            'gambar' => 'assets/img/users/user (6).png',
            'type' => 'principal',
            'url' => 'url6',
            'nama' => 'Principal6',
        ]);

        Principal::create([
            'gambar' => 'assets/img/users/user (7).png',
            'type' => 'principal',
            'url' => 'url7',
            'nama' => 'Principal7',
        ]);

        Principal::create([
            'gambar' => 'assets/img/users/user (8).png',
            'type' => 'principal',
            'url' => 'url8',
            'nama' => 'Principal8',
        ]);

        Principal::create([
            'gambar' => 'assets/img/users/user (9).png',
            'type' => 'principal',
            'url' => 'url9',
            'nama' => 'Principal9',
        ]);

        Principal::create([
            'gambar' => 'assets/img/users/user (10).png',
            'type' => 'principal',
            'url' => 'url10',
            'nama' => 'Principal10',
        ]);

        Principal::create([
            'gambar' => 'assets/img/users/user (11).png',
            'type' => 'principal',
            'url' => 'url11',
            'nama' => 'Principal11',
        ]);
    }
}
