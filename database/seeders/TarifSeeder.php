<?php

namespace Database\Seeders;

use App\Models\Tarif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Tarif::factory(5)->create();
        $data = [
            ['daya' => 900, 'tarifperkwh' => '1352'],
            ['daya' => 1300, 'tarifperkwh' => '1444.70'],
            ['daya' => 2200, 'tarifperkwh' => '1444.70'],
            ['daya' => 3500, 'tarifperkwh' => '1699.53'],
            ['daya' => 6600, 'tarifperkwh' => '1699.53']
        ];
        foreach ($data as $d) {
            Tarif::factory()->create([
                'daya' => $d['daya'],
                'tarifperkwh' => $d['tarifperkwh'],
            ]);
        }
    }
}
