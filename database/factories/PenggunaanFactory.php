<?php

namespace Database\Factories;


use App\Models\Penggunaan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penggunaan>
 */
class PenggunaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pelanggan' => $this->faker->numberBetween(1, 10),
            'bulan' => $this->faker->month('now'),
            'tahun' => $this->faker->year('now'),
            'meter_awal' => $this->faker->randomNumber(4),
            'meter_akhir' => $this->faker->randomNumber(4)
        ];
    }

}
