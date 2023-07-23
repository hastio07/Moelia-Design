<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => 3,
            'nama_depan' => 'Hastio',
            'nama_belakang' => 'Wahyu',
            'email' => 'hastio@moeliadesign.my.id',
            'phone' => fake()->phoneNumber(),
            'password' => bcrypt('@hast1o'),
        ]);

    }
}
