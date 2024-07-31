<?php

namespace Tests\Unit;

use App\Models\Tarif;
use Tests\TestCase;

class TarifTest extends TestCase
{
    /**
     * Test creating a tarif.
     *
     * @return void
     */
    public function test_create_tarif()
    {
        $tarifData = [
            'daya' => 9000,
            'tarifperkwh' => 2000,
        ];
        $tarif = Tarif::factory()->create($tarifData);
        $this->assertDatabaseHas('tarif', $tarifData);
        $this->assertEquals(9000, $tarif->daya);
        $this->assertEquals(2000, $tarif->tarifperkwh);
        $tarif->delete();
    }

    /**
     * Test updating a tarif.
     *
     * @return void
     */
    public function test_update_tarif()
    {
        $tarif = Tarif::factory()->create();
        $tarif->daya = 7500;
        $tarif->tarifperkwh = 2200;
        $tarif->save();
        $this->assertDatabaseHas('tarif', [
            'id_tarif' => $tarif->id_tarif,
            'daya' => 7500,
            'tarifperkwh' => 2200,
        ]);
        $tarif->delete();
    }

    /**
     * Test deleting a tarif.
     *
     * @return void
     */
    public function test_delete_tarif()
    {
        $tarif = Tarif::factory()->create();
        $tarifId = $tarif->id_tarif;
        $tarif->delete();
        $this->assertDatabaseMissing('tarif', ['id_tarif' => $tarifId]);
        $tarif->delete();
    }
}
