<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BerasFactory extends Factory
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
            'harga' => $this->faker->randomNumber(6, true),
            'berat' => $this->faker->numberBetween(25,25),
            'kualitas' => $this->faker->word(3),
            'persediaan' => $this->faker->numberBetween(40,100)
        ];
    }
}
