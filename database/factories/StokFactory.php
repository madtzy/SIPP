<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StokFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'produk_id' => mt_rand(1,1000),
            'tanggal' => $this->faker->date(),
            'stok_sebelumnya' => $this->faker->numberBetween(1,60),
            'stok_tambah' => $this->faker->numberBetween(1,10),
            'stok_akhir' => $this->faker->numberBetween(1,60),
            'kualitas' => $this->faker->randomElement(['bagus','sedang','jelek'])
        ];
    }
}
