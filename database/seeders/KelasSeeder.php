<?php

namespace Database\Seeders;

use App\Models\Kelasprak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelasprak::create([
            'kelas' => 'A',
            'hari' => 'Senin',
            'sesi' => '1 (13.00)',
        ]);
        Kelasprak::create([
            'kelas' => 'B',
            'hari' => 'Selasa',
            'sesi' => '1 (13.00)',
        ]);
        Kelasprak::create([
            'kelas' => 'C',
            'hari' => 'Selasa',
            'sesi' => '2 (15.00)',
        ]);
        Kelasprak::create([
            'kelas' => 'D',
            'hari' => 'Rabu',
            'sesi' => '1 (13.00)',
        ]);
        Kelasprak::create([
            'kelas' => 'E',
            'hari' => 'Rabu',
            'sesi' => '2 (15.00)',
        ]);
        Kelasprak::create([
            'kelas' => 'F',
            'hari' => 'Kamis',
            'sesi' => '1 (13.00)',
        ]);
        Kelasprak::create([
            'kelas' => 'G',
            'hari' => 'Kamis',
            'sesi' => '2 (15.00)',
        ]);
        Kelasprak::create([
            'kelas' => 'H',
            'hari' => 'Jumat',
            'sesi' => '1 (13.00)',
        ]);
        Kelasprak::create([
            'kelas' => 'I',
            'hari' => 'Jumat',
            'sesi' => '2 (15.00)',
        ]);
    }
}
