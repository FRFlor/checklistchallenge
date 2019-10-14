<?php

namespace Tests\Unit;

use App\Attempt;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttemptTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_is_complete_when_all_the_tasks_are_complete()
    {
        $attempt = factory(Attempt::class)->create();
        $tasks = factory(Task::class, 2)->create([
            'attempt_id' => $attempt->id,
        ]);
        $this->assertFalse($attempt->completed);

        $tasks[0]->update(['completed' => true]);
        $this->assertFalse($attempt->fresh()->completed);

        $tasks[1]->update(['completed' => true]);

        $this->assertTrue($attempt->fresh()->completed);

    }
}
