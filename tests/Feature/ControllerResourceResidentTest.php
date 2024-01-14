<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ModelResident;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ControllerResourceResidentTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
    }
    public function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }

    public function test_update(): void
    {
        $collection = ModelResident::factory(1)->create();

        $response = $this->put('/api/resident/' . $collection->first()->id, [
            "fio" => "test123",
            "area" => 100
        ]);

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $response = $this->post('/api/resident', [
            "fio" => "test123",
            "area" => 100
        ]);

        $response->assertStatus(200);
    }

    public function test_destroy()
    {
        $collection = ModelResident::factory(1)->create();

        $response = $this->delete('/api/resident/' . $collection->first()->id);

        $response->assertStatus(200);
    }

    public function test_index()
    {
        $response = $this->get('/api/resident/');

        $response->assertStatus(200);
    }
}
