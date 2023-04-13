<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{

    protected $model = Admin::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nama_depan = fake()->firstName();
        $nama_belakang = fake()->lastName();
        while (strlen($nama_depan) < 5) {
            $nama_depan = fake()->firstName();
        }
        while (strlen($nama_belakang) < 5) {
            $nama_belakang = fake()->lastName();
        }
        return [
            //
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'role_id' => 2,
            'email' => fake()->unique()->email(),
            'phone_number' => fake()->phoneNumber(),
            'password' => bcrypt('admin')
        ];
    }
}
