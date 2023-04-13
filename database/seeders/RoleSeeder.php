<?php

namespace Database\Seeders;

use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = [
            [
                'level' => 'super_admin',
            ],
            [
                'level' => 'admin',
            ],
            [
                'level' => 'super_user',
            ],
        ];
        foreach ($role as $value) {
            Role::create($value);
        }
    }
}
