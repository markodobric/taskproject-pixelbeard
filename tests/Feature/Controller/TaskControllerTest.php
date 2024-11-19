<?php declare(strict_types=1);

namespace Tests\Feature\Controller;

use App\Models\Task;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    public function test_create_task_success(): void
    {
        $response = $this->postJson(
            route('api.tasks.create'),
            [
                'title' => 'Task 1',
                'description' => 'Task desc...',
                'completed' => true,
            ]
        );

        $response
            ->assertCreated()
            ->assertJson([
                'data' => [
                    'title' => 'Task 1',
                    'description' => 'Task desc...',
                    'completed' => true,
                ],
            ]);
    }

    public function test_create_task_without_required_fields(): void
    {
        $response = $this->postJson(
            route('api.tasks.create'),
            [
                'title' => 'Task 1',
            ]
        );

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'description' => 'The description field is required.',
            ]);
    }

    public function test_update_task_success(): void
    {
        $task = Task::factory()->create();

        $this->assertFalse($task->completed);

        $response = $this->putJson(
            route('api.tasks.update', ['task' => $task->id]),
            ['completed' => true]
        );

        $response
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'title' => $task->title,
                    'description' => $task->description,
                    'completed' => true,
                ],
            ]);
    }

    public function test_update_task_without_required_fields(): void
    {
        $task = Task::factory()->create();

        $response = $this->putJson(
            route('api.tasks.update', ['task' => $task->id]),
            ['wrong_field' => 'wrong_value']
        );

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'title' => 'The title field is required when none of description / completed are present.',
                'description' => 'The description field is required when none of title / completed are present.',
                'completed' => 'The completed field is required when none of title / description are present.'
            ]);
    }

    public function test_list_all_tasks(): void
    {
        /** @var Task $task1 */
        [$task1, $task2, $task3, $task4, $task5] = Task::factory()->count(5)->create();

        $this->assertDatabaseCount(Task::class, 5);

        $response = $this->getJson(route('api.tasks.list'));

        $response->assertSuccessful()
            ->assertJson(fn (AssertableJson $json) =>
            $json
                ->has('data', 5)
                ->has('data.0', fn (AssertableJson $json) =>
                $json
                    ->where('id', $task1->id)
                    ->where('title', $task1->title)
                    ->where('description', $task1->description)
                    ->where('completed', $task1->completed)
                    ->where('created_by', $task1->createdBy->name)
                    ->etc()
                )
            );
    }

    public function test_delete_task_success(): void
    {
        $task = Task::factory()->create();

        $this->assertDatabaseHas(Task::class, ['id' => $task->id]);

        $response = $this->deleteJson(route('api.tasks.delete', ['task' => $task->id]));

        $response->assertNoContent();

        $this->assertDatabaseMissing(Task::class, ['id' => $task->id]);
    }

    public function test_task_show_task_success(): void
    {
        $task = Task::factory()->create();

        $response = $this->getJson(route('api.tasks.show', ['task' => $task->id]));

        $response
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'id' => $task->id,
                    'title' => $task->title,
                    'description' => $task->description,
                    'completed' => $task->completed,
                ],
            ]);
    }

    public function test_task_show_task_not_found(): void
    {
        $response = $this->getJson(route('api.tasks.show', ['task' => 999]));

        $response->assertNotFound();
    }
}
