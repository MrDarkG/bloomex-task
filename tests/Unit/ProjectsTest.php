<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Project::factory()->count(5)->create();
    }

    public function test_get_projects(): void
    {
        $response = $this->get('/api/v1/projects');
        $response->assertStatus(200);
    }
}
