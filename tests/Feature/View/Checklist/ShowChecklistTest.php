<?php

namespace Tests\Feature\View\Checklist;

use App\Checklist;
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
            ->assertRedirect(route('home'));
    }
}
