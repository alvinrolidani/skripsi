<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('nama_toko' => 'Putra Busana', 'lokasi_toko' => 'Pasar Jasinga'),
            array('nama_toko' => 'Yoan Busana', 'lokasi_toko' => 'Pasar Jasinga'),
            array('nama_toko' => 'Tita Collection', 'lokasi_toko' => 'Pasar Jasinga'),
            array('nama_toko' => 'Bae Busana', 'lokasi_toko' => 'Pasar Jasinga'),
            array('nama_toko' => 'Dea\'s Collection', 'lokasi_toko' => 'Pasar Jasinga'),
            array('nama_toko' => 'Mahkota Adiron', 'lokasi_toko' => 'Pasar Rangkasbitung'),
            array('nama_toko' => 'Sinar Adiron Jaya', 'lokasi_toko' => 'Pasar Rangkasbitung'),
            array('nama_toko' => 'An Naba Adiron', 'lokasi_toko' => 'Pasar Rangkasbitung'),
            array('nama_toko' => 'Mega Adiron', 'lokasi_toko' => 'Pasar Rangkasbitung'),
            array('nama_toko' => 'Whisper Inspiration', 'lokasi_toko' => 'Pasar Rangkasbitung'),
            array('nama_toko' => 'Eni Collection', 'lokasi_toko' => 'Pasar Jasinga',)
        );
        DB::table('alternatif')->insert($data);
    }
}
