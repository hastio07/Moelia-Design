<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category_product = fake()->unique()->word();
        return [
            //
            'nama_kategori' => $category_product,
            'slug_kategori' => str()->slug($category_product),
        ];
    }
}
