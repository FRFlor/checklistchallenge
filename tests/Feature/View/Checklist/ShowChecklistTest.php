<?php

namespace Tests\Feature\View\Checklist;

use App\Attempt;
use App\Checklist;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowChecklistTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_cannot_see_a_checklist()
    {
        $checklist = factory(Checklist::class)->create();

        $this->get(route('checklist.show', $checklist))
            ->assertRedirect();
    }

    /** @test */
    public function a_checklist_can_be_seen_by_the_owner()
    {
        $checklist = factory(Checklist::class)->create();

        $this->actingAs($checklist->owner)
            ->get(route('checklist.show', $checklist))
            ->assertSuccessful()
            ->assertSeeText($checklist->title);
    }

    /** @test */
    public function a_user_cannot_see_another_users_checklist()
    {
        $checklist = factory(Checklist::class)->create();

        $this->actingAs(factory(User::class)->create())
            ->get(route('checklist.show', $checklist))
            ->assertRedirect(route('checklist.index'));
    }

    /** @test */
    public function a_checklist_show_only_shows_incomplete_attempts()
    {
        $checklist = factory(Checklist::class)->create();

        $attemptComplete = factory(Attempt::class)->create([
            'checklist_id' => $checklist->id,
        ]);
        factory(Task::class)->create([
            'attempt_id' => $attemptComplete->id,
            'completed' => true,
        ]);

        $this->assertTrue($attemptComplete->completed);

        $attemptIncomplete = factory(Attempt::class)->create([
            'checklist_id' => $checklist->id,
        ]);
        factory(Task::class)->create([
            'attempt_id' => $attemptIncomplete->id,
            'completed' => false,
        ]);

        $this->assertFalse($attemptIncomplete->completed);

        $this->actingAs($checklist->owner)
            ->get(route('checklist.show', $checklist))
            ->assertSee(route('attempt.show', $attemptIncomplete))
            ->assertDontSee(route('attempt.show', $attemptComplete));

    }
}
