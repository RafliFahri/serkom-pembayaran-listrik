<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembayaran>
 */
class PembayaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_tagihan' => $this->faker->numberBetween(1, 5),
            'id_pelanggan' => $this->faker->numberBetween(1, 5),
            'tanggal_pembayaran' => $this->faker->date('Y-m-d'),
            'bulan_bayar' => $this->faker->month('now'),
            'biaya_admin' => $this->faker->randomNumber(7),
            'total_bayar' => $this->faker->randomNumber(7),
            'id_user' => $this->faker->numberBetween(6, 10),
        ];
    }
}
