<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tagihan>
 */
class TagihanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_penggunaan' => $this->faker->numberBetween(1, 5),
            'id_pelanggan' => $this->faker->numberBetween(1,5),
            'bulan' => $this->faker->month(),
            'tahun' => $this->faker->year(),
            'jumlah_meter' => $this->faker->numberBetween(100, 1000),
            'status' => $this->faker->boolean(80),
        ];
    }
}
