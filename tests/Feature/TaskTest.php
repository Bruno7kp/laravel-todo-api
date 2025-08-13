<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_tasks()
    {
        Task::factory()->count(3)->create();

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)->assertJsonCount(3);
    }

    public function test_can_create_task()
    {
        $data = [
            'title' => 'Test Task',
            'description' => 'Test description',
            'completed' => false,
        ];

        $response = $this->postJson('/api/tasks', $data);

        $response->assertStatus(201)->assertJsonFragment(['title' => 'Test Task']);
        $this->assertDatabaseHas('tasks', ['title' => 'Test Task']);
    }

    public function test_can_show_task()
    {
        $task = Task::factory()->create();

        $response = $this->getJson("/api/tasks/{$task->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => $task->title]);
    }

    public function test_can_update_task()
    {
        $task = Task::factory()->create();

        $data = [
            'title' => 'Updated Title',
            'description' => 'Updated description',
            'completed' => true,
        ];

        $response = $this->putJson("/api/tasks/{$task->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Updated Title']);
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'title' => 'Updated Title']);
    }

    public function test_can_delete_task()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
