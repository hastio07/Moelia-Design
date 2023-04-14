<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'role_id' => 1,
            'nama_depan' => 'Super',
            'nama_belakang' => 'Admin',
            'email' => 'superadmin@moeliadesign.my.id',
            'phone_number' => fake()->phoneNumber(),
            'password' => bcrypt('superadmin'),
        ]);
    }
}
