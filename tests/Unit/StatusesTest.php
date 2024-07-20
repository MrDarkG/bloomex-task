<?php

use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Status::factory()->count(5)->create();
    }

    public function test_get_projects(): void
    {
        $response = $this->get('/api/v1/statuses');
        $response->assertStatus(200);
    }
}
