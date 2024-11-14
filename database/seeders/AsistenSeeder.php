<?php

namespace Database\Seeders;

use App\Models\Asisten;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsistenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Asisten::create([
            'nim' => '2218001',
            'nama' => 'Dio Masafan Mufio Rois',
            'email' => '2218001@scholar.itn.ac.id',
        ]);
        Asisten::create([
            'nim' => '2218045',
            'nama' => 'Ahmad Ari Firmansyah',
            'email' => '2218045@scholar.itn.ac.id',
        ]);
        Asisten::create([
            'nim' => '2218046',
            'nama' => 'Putri Mulan Mirenty',
            'email' => '2218046@scholar.itn.ac.id',
        ]);
        Asisten::create([
            'nim' => '2218058',
            'nama' => 'Rahardian Tria Alfatih',
            'email' => '2218058@scholar.itn.ac.id',
        ]);
        Asisten::create([
            'nim' => '2218062',
            'nama' => 'Bimo Satrio Putra',
            'email' => '2218062@scholar.itn.ac.id',
        ]);
        Asisten::create([
            'nim' => '2218049',
            'nama' => 'Firky Pribadi',
            'email' => '2218049@scholar.itn.ac.id',
        ]);
        Asisten::create([
            'nim' => '2218056',
            'nama' => 'Rahmat Dani Firmansyah',
            'email' => '2218056@scholar.itn.ac.id',
        ]);
        Asisten::create([
            'nim' => '2218060',
            'nama' => 'Mohammad Joenathan Tito A. P',
            'email' => '2218060@scholar.itn.ac.id',
        ]);
        Asisten::create([
            'nim' => '2318058',
            'nama' => 'Muhammad Afif Ramadhan',
            'email' => '2318058@scholar.itn.ac.id',
        ]);
        Asisten::create([
            'nim' => '2318106',
            'nama' => 'Khoirotun Nisa',
            'email' => '2318106@scholar.itn.ac.id',
        ]);
        Asisten::create([
            'nim' => '2318062',
            'nama' => 'Shabrina Dwiputri',
            'email' => '2318062@scholar.itn.ac.id',
        ]);
        Asisten::create([
            'nim' => '2318082',
            'nama' => 'Luthfatul Ika Zahro',
            'email' => '2318082@scholar.itn.ac.id',
        ]);
        Asisten::create([
            'nim' => '2318060',
            'nama' => 'Muhammad Maridzal Adi Putra',
            'email' => '2318060@scholar.itn.ac.id',
        ]);
        Asisten::create([
            'nim' => '2318055',
            'nama' => 'Rayhan Ainurron Falaqi',
            'email' => '2318055@scholar.itn.ac.id',
        ]);

    }
}
