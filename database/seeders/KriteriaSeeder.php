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

                'nama_kriteria' => 'Pelunasan Hutang',
                'bobot_kriteria' => 0,
                'atribut_kriteria' => 'benefit'

            ],
            [

                'nama_kriteria' => 'Jumlah Pengambilan Barang',
                'bobot_kriteria' => 0,
                'atribut_kriteria' => 'benefit'

            ],
            [

                'nama_kriteria' => 'Pembayaran Setoran (Perminggu)',
                'bobot_kriteria' => 0,
                'atribut_kriteria' => 'benefit'

            ],
            [

                'nama_kriteria' => 'Lokasi Toko',
                'bobot_kriteria' => 0,
                'atribut_kriteria' => 'benefit'

            ],

            [

                'nama_kriteria' => 'Jarak Tempuh',
                'bobot_kriteria' => 0,
                'atribut_kriteria' => 'cost'

            ]
        ];
        KriteriaModel::insert($data);
    }
}
