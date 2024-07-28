<?php

namespace Tests\Feature;

use App\Models\Level;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LevelTest extends TestCase
{
    private $user;
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = User::where('username', 'admin')->where('password', 'admin')->first();
    }
    public function test_admin_can_see_data_level()
    {
        $response = $this->actingAs($this->user, 'admin')->get('/admin/level');
        $response->assertStatus(200);
        $response->assertSee('Data Level')->assertSee('Administrator');
    }
    public function test_admin_create_new_level(): void
    {
        $response = $this->actingAs($this->user, 'admin')->post('/admin/level', [
            'nama_level' => 'Recruiter'
        ]);
        $response->assertStatus(302)->assertRedirect('/admin/level');
        $this->assertDatabaseHas('level', ['nama_level' => 'Recruiter']);
    }
    public function test_admin_create_new_level_with_empty_data(): void
    {
        $response = $this->actingAs($this->user, 'admin')->post('/admin/level', [
            'nama_level' => ''
        ]);
        $response->assertStatus(302)
            ->assertSessionHasErrors(['nama_level']);
        $this->assertDatabaseMissing('level', ['nama_level' => '']);
    }
    public function test_admin_can_see_edit_level(): void
    {
        $level = Level::where('nama_level', 'Administrator')->first();
        $response = $this->actingAs($this->user, 'admin')->get('/admin/level/' . $level->id_level . '/edit');
        $response->assertStatus(200)
            ->assertSee('Edit Level')
            ->assertSee($level->nama_level);
    }
    public function test_admin_can_update_level(): void
    {
        $level = Level::where('nama_level', 'Recruiter')->first();
        $response = $this->actingAs($this->user, 'admin')->put('/admin/level/' . $level->id_level, [
            'nama_level' => 'Teknisi'
        ]);
        $response->assertRedirect('/admin/level');
        $this->assertDatabaseHas('level', ['nama_level' => 'Teknisi']);
    }
    public function test_admin_can_delete_level(): void
    {
        $level = Level::where('nama_level', 'Teknisi')->first();
        $response = $this->actingAs($this->user, 'admin')->delete('/admin/level/' . $level->id_level);
        $response->assertRedirect('/admin/level');
        $this->assertDatabaseMissing('level', ['nama_level' => 'Teknisi']);
    }
}
