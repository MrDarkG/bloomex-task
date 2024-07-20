<?php

namespace Tests\Unit;


use App\Models\Issue;
use App\Models\Priority;
use App\Models\Project;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IssuesTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        Project::factory()->count(5)->create();
        Status::factory()->count(5)->create();
        Priority::factory()->count(5)->create();
        Issue::factory()->count(5)->create();
    }

    public function test_get_issues(): void
    {
        $response = $this->get('/api/v1/issues');
        $response->assertStatus(200);
    }

    public function test_create_issue(): void
    {
        $response = $this->post('/api/v1/issues', [
            'subject' => 'Test issue',
            'status_id' => 1,
            'priority_id' => 1,
            'project_id' => 1
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('issues', [
            'subject' => 'Test issue',
            'status_id' => 1,
            'priority_id' => 1,
            'project_id' => 1
        ]);
    }

    public function test_update_issue(): void
    {
        $issue = Issue::first();
        $response = $this->put('/api/v1/issues', [
            'id' => $issue->id,
            'subject' => 'Test issue updated',
            'status_id' => 1,
            'priority_id' => 1,
            'project_id' => 1
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('issues', [
            'id' => $issue->id,
            'subject' => 'Test issue updated',
            'status_id' => 1,
            'priority_id' => 1,
            'project_id' => 1
        ]);
    }

    public function test_delete_issue(): void
    {
        $issue = Issue::first();
        $response = $this->delete('/api/v1/issues/' . $issue->id);
        $response->assertStatus(200);

        $this->assertDatabaseMissing('issues', [
            'id' => $issue->id
        ]);
    }

    public function test_get_issue(): void
    {
        $issue = Issue::first();
        $response = $this->get('/api/v1/issues/' . $issue->id);
        $response->assertStatus(200);
    }
}
