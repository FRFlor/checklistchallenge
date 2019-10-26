<?php

namespace Tests\Feature\Api\Task;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_update_their_task()
    {
        $tasks = factory(Task::class, 2)->create();

        $task = $tasks->first();

        $this->assertFalse($task->fresh()->completed);

        $this->actingAs($task->attempt->checklist->owner)
            ->patch(route('task.update', $task), [
                'completed' => true,
            ]);

        $this->assertTrue($task->fresh()->completed);
    }

    /** @test */
    public function it_returns_to_the_checklist_if_the_attempt_is_completed()
    {
        $task = factory(Task::class)->create();

        $this->actingAs($task->attempt->checklist->owner)
            ->patch(route('task.update', $task), [
                'completed' => true,
            ])
            ->assertRedirect(route('checklist.show', $task->attempt->checklist));
    }
}
