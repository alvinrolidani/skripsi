<?php

namespace Database\Seeders;

use App\Models\KriteriaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
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
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Produktivitas'
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Perilaku Kerja'
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Pengembangan Diri'
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Keterampilan'
            ]
        ];
        KriteriaModel::insert($data);
    }
}
