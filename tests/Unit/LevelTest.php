<?php

namespace Tests\Unit;

use App\Models\Level;
use Tests\TestCase;

class LevelTest extends TestCase
{
    /**
     * Test creating a level.
     *
     * @return void
     */
    public function test_create_level()
    {
        $levelData = [
            'nama_level' => "Staf Testing"
        ];
        $level = Level::factory()->create($levelData);
        $this->assertDatabaseHas('level', $levelData);
        $this->assertEquals('Staf Testing', $level->nama_level);
        $level->delete();
    }
    /**
     * Test updating a level.
     *
     * @return void
     */
    public function test_update_level()
    {
        $level = Level::factory()->create();
        $level->nama_level = 'Manager';
        $level->save();
        $this->assertDatabaseHas('level', ['id_level' => $level->id_level, 'nama_level' => 'Manager']);
        $level->delete();
    }
    /**
     * Test deleting a level.
     *
     * @return void
     */
    public function test_delete_level()
    {
        $level = Level::factory()->create();
        $levelId = $level->id_level;
        $level->delete();
        $this->assertDatabaseMissing('level', ['id_level' => $levelId]);
    }
}
