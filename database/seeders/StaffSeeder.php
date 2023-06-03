<?php

namespace Database\Seeders;


use App\Models\StaffModel;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();



        for ($i = 0; $i < 100; $i++) {

            $data = [
                'nama_staff' => $faker->name(),
                'posisi_id' => 1,

            ];
            StaffModel::firstOrCreate($data);
        }
    }
}
