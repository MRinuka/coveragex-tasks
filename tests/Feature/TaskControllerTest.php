<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function tasks_index_shows_latest_tasks()
    {
        // Create 6 tasks
        Task::factory()->count(6)->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee(Task::latest()->first()->title);
        // Only 5 latest tasks should show
        $tasks = Task::latest()->take(5)->get();
        foreach ($tasks as $task) {
            $response->assertSee($task->title);
        }
    }

    /** @test */
    public function it_can_create_a_task_via_post()
    {
        $response = $this->post('/tasks', [
            'title' => 'Feature Test Task',
            'description' => 'Testing post request',
        ]);

        $response->assertRedirect(); // usually redirects back to tasks page
        $this->assertDatabaseHas('tasks', [
            'title' => 'Feature Test Task'
        ]);
    }

    /** @test */
    public function it_can_mark_task_done()
    {
        $task = Task::factory()->create();

        $response = $this->put("/tasks/{$task->id}/done");
        $response->assertStatus(200);  // expect 200 now
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]); // task should be gone

    }

    /** @test */
    public function blade_view_shows_task_titles()
    {
        $task = Task::factory()->create([
            'title' => 'Blade Task Test'
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Blade Task Test');
    }
}
