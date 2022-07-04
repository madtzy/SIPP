<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->unique()->name(),
            'harga' => $this->faker->numberBetween(200000,300000),
            'stok' => $this->faker->numberBetween(20,60),
            'keterangan' => $this->faker->sentence(5)
        ];
    }
}
