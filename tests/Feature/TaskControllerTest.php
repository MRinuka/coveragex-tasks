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
        
        $tasks = Task::latest()->take(5)->get();
        foreach ($tasks as $task) {
            $response->assertSee($task->title);
        }
    }

    

    /** @test */
    public function it_can_create_a_task_via_Add_Task_Button()
    {
        $response = $this->post('/tasks', [
            'title' => 'Feature Test Task',
            'description' => 'Testing post request',
        ]);

        $response->assertRedirect(); 
        $this->assertDatabaseHas('tasks', [
            'title' => 'Feature Test Task'
        ]);
    }

    /** @test */
    public function it_can_create_a_task_with_description()
    {
        $response = $this->post('/tasks', [
            'title' => 'Feature Test Task',
            'description' => 'Feature description',
        ]);

        $response->assertRedirect(); 
        $this->assertDatabaseHas('tasks', [
            'title' => 'Feature Test Task',
            'description' => 'Feature description',
        ]);
    }

    /** @test */
    public function it_requires_a_title_when_creating_task()
    {
        $response = $this->post('/tasks', [
            'title' => '', 
            'description' => '',
        ]);

        $response->assertSessionHasErrors('title');
        $this->assertDatabaseCount('tasks', 0); 
    }


    /** @test */
    public function it_can_mark_task_done()
    {
        $task = Task::factory()->create();

        $response = $this->put("/tasks/{$task->id}/done");
        $response->assertStatus(200);  
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]); 

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
