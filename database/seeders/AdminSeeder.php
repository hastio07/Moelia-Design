<?php

namespace Database\Seeders;

use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $faker = Faker::create('id_ID');
        // $admin = [
        //     [
        //         'role_id' => 1,
        //         'nama_depan' => 'Super',
        //         'nama_belakang' => 'Admin',
        //         'email' => 'superadmin@moeliadesign.id',
        //         'phone_number' => $faker->phoneNumber,
        //         'password' => bcrypt('superadmin'),
        //     ],
        //     [
        //         'role_id' => 2,
        //         'nama_depan' => 'Admin',
        //         'nama_belakang' => 'Admin',
        //         'email' => 'admin@moeliadesign.id',
        //         'phone_number' => $faker->phoneNumber,
        //         'password' => bcrypt('admin'),
        //     ],
        //     [
        //         'role_id' => 2,
        //         'nama_depan' => 'Hastio',
        //         'nama_belakang' => 'Wahyu',
        //         'email' => 'hastiowahyu@moeliadesign.id',
        //         'phone_number' => $faker->phoneNumber,
        //         'password' => bcrypt('admin'),
        //     ],
        // ];
        // foreach ($admin as $key => $value) {
        //     Admin::create($value);
        // }

        // $faker = Faker::create('id_ID');

        // for ($i = 0; $i < 50; $i++) {
        //     $nama_depan = $faker->firstName;
        //     $nama_belakang = $faker->lastName;

        //     while (strlen($nama_depan) < 5) {
        //         $nama_depan = $faker->firstName;
        //     }

        //     while (strlen($nama_belakang) < 5) {
        //         $nama_belakang = $faker->lastName;
        //     }

        //     Admin::create([
        //         'nama_depan' => $nama_depan,
        //         'nama_belakang' => $nama_belakang,
        //         'role_id' => 2,
        //         'email' => $faker->email,
        //         'phone_number' => $faker->phoneNumber,
        //         'password' => bcrypt('admin')
        //     ]);
        // }
        Admin::factory()->count(50)->create();
    }
}
