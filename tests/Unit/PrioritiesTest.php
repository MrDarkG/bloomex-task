<?php

use App\Models\Priority;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PrioritiesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Priority::factory()->count(5)->create();
    }

    public function test_get_projects(): void
    {
        $response = $this->get('/api/v1/priorities');
        $response->assertStatus(200);
    }
}
