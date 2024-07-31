<?php

namespace Tests\Unit;

use App\Models\Pelanggan;
use App\Models\Tarif;
use Tests\TestCase;

class PelangganTest extends TestCase
{
    /**
     * Test creating a pelanggan.
     *
     * @return void
     */
    public function test_create_pelanggan()
    {
        $pelangganData = [
            'username' => 'testuser',
            'password' => 'secret',
            'nomor_kwh' => '123456789',
            'nama_pelanggan' => 'John Doe',
            'alamat' => 'Jl. H. Ridi',
            'id_tarif' => 1,
        ];
        $pelanggan = Pelanggan::factory()->create($pelangganData);
        $this->assertDatabaseHas('pelanggan', [
            'username' => 'testuser',
            'password' => 'secret',
            'nomor_kwh' => '123456789',
            'nama_pelanggan' => 'John Doe',
            'alamat' => 'Jl. H. Ridi',
            'id_tarif' => 1,
        ]);
        $pelanggan->delete();
    }

    /**
     * Test updating a pelanggan.
     *
     * @return void
     */
    public function test_update_pelanggan()
    {
        $pelanggan = Pelanggan::factory()->create();
        $pelanggan->alamat = 'Jl. H. Ridi';
        $pelanggan->save();
        $this->assertDatabaseHas('pelanggan', [
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'alamat' => 'Jl. H. Ridi',
        ]);
        $pelanggan->delete();
    }
    /**
     * Test deleting a pelanggan.
     *
     * @return void
     */
    public function test_delete_pelanggan()
    {
        $pelanggan = Pelanggan::factory()->create();
        $pelangganId = $pelanggan->id_pelanggan;
        $pelanggan->delete();
        $this->assertDatabaseMissing('pelanggan', ['id_pelanggan' => $pelangganId]);
    }
    /**
     * Test the relationship with Tarif.
     *
     * @return void
     */
    public function test_pelanggan_tarif_relationship()
    {
        $tarif = Tarif::factory()->create();
        $pelanggan = Pelanggan::factory()->create(['id_tarif' => $tarif->id_tarif]);
        $this->assertEquals($tarif->id_tarif, $pelanggan->tarif->id_tarif);
        $pelanggan->delete();
        $tarif->delete();
    }
}
