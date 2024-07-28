<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggan>
 */
class PelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->userName(),
            'password' => $this->faker->password(),
            'nomor_kwh' => $this->faker->randomNumber(9),
            'nama_pelanggan' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'id_tarif' => $this->faker->numberBetween(1, 5)
        ];
    }
}
