<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'admin',
            'password' => 'admin',
            'nama_admin' => 'Ahmad Sofyan',
            'id_level' => 1
        ]);
//        User::factory(4)->create();
    }
}
