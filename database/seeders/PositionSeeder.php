<?php

namespace Database\Seeders;

use App\Models\PosisiModel;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'nama_posisi' => 'Kantor Desa Kalong'
        ];
        PosisiModel::create($data);
    }
}
