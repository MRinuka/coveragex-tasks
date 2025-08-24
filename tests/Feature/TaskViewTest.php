<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class TaskViewTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function tasks_index_shows_tasks()
    {
        $task = Task::factory()->create([
            'title' => 'Blade Test Task'
        ]);

        $response = $this->get('/'); 

        $response->assertSee('Blade Test Task');
        $response->assertStatus(200);
    }
}
