<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();




        $data = [
            'name' => 'Alvin Rolidani',
            'username' => 'alvinrolidani',
            'password' => bcrypt('123'),
            'level' => 'superadmin'
        ];
        User::firstOrCreate($data);
    }
}
