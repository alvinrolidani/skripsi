<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CripsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            [

                'kriteria_id' => 1,
                'nama_atribut' => 'Lunas',
                'bobot' => 1
            ],
            [

                'kriteria_id' => 1,
                'nama_atribut' => 'Tidak Lunas',
                'bobot' => '0',
            ],
            [

                'kriteria_id' => 4,
                'nama_atribut' => 'Strategis',
                'bobot' => 1,
            ],
            [

                'kriteria_id' => 4,
                'nama_atribut' => 'Tidak Strategis',
                'bobot' => 0
            ],
            [

                'kriteria_id' => 3,
                'nama_atribut' => 'Sangat Rajin',
                'bobot' => 5
            ],
            [

                'kriteria_id' => 3,
                'nama_atribut' => 'Rajin',
                'bobot' => 4
            ],
            [
                'kriteria_id' => 3,
                'nama_atribut' => 'Cukup Rajin',
                'bobot' => 3
            ],
            [
                'kriteria_id' => 3,
                'nama_atribut' => 'Tidak Rajin',
                'bobot' => 2
            ],
            [
                'kriteria_id' => 3,
                'nama_atribut' => 'Sangat Tidak Rajin',
                'bobot' => 1
            ],
            [
                'kriteria_id' => 5,
                'nama_atribut' => '> 40 Km',
                'bobot' => 5
            ],
            [
                'kriteria_id' => 5,
                'nama_atribut' => '41 - 50 Km',
                'bobot' => 4
            ],
            [
                'kriteria_id' => 5,
                'nama_atribut' => '31 - 40 Km',
                'bobot' => 3
            ],
            [
                'kriteria_id' => 5,
                'nama_atribut' => '21 - 30 Km',
                'bobot' => 2
            ],
            [
                'kriteria_id' => 5,
                'nama_atribut' => '0 - 10 ',
                'bobot' => 1
            ]

        ];
        DB::table('atribut_penilaian')->insert($data);
    }
}
