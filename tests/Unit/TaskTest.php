<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_task()
    {
        $task = Task::create([
            'title' => 'Unit Test Task',
            'description' => 'Testing task creation',
        ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Unit Test Task'
        ]);
    }
}
