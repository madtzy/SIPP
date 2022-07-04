<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BuyerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'produk_id' => mt_rand(1, 1000),
            'nama' => $this->faker->name(),
            'alamat' => $this->faker->state(),
            'nomor_telp' => $this->faker->randomNumber(),
            'tanggal' => $this->faker->date(),
            'jumlah' => $this->faker->numberBetween(1,5),
            'total_bayar' => $this->faker->randomNumber(5, true),

        ];
    }
}
