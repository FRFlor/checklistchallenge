<?php

namespace Tests\Feature\Api\Task;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_update_their_task()
    {
        $this->withoutExceptionHandling();

        $task = factory(Task::class)->create();

        $this->assertFalse($task->fresh()->completed);

        $this->actingAs($task->attempt->checklist->owner)
            ->patch(route('task.update', $task), [
                'completed' => true,
            ]);

        $this->assertTrue($task->fresh()->completed);
    }
}
