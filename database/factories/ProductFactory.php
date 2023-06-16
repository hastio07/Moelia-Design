<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $nama_produk = $this->faker->words(3, true);
        return [
            //
            'created_by' => $this->faker->numberBetween(1, 3),
            'nama_produk' => $nama_produk,
            'slug_produk' => str()->slug($nama_produk),
            'kategori_id' => $this->faker->numberBetween(1, 5),
            'harga_sewa' => $this->faker->randomFloat(0, 100000, 1000000),
            'rincian_produk' => fake()->words(2, true),
            'deskripsi' => $this->faker->paragraph(),
            'gambar' => $this->faker->imageUrl(100, 100, 'produk', false, 'wedding', true),
            'album_produk' => $this->faker->imageUrl(100, 100, 'produk', false, 'wedding', true),
        ];
    }

}
