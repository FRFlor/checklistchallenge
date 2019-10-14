<?php

namespace Tests\Feature\View\Checklist;

use App\Checklist;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditChecklistTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_edit_their_checklist()
    {
        $checklist = factory(Checklist::class)->create();

        $this->get(route('checklist.edit', $checklist))
            ->assertRedirect();

        $this->actingAs(factory(User::class)->create())
            ->get(route('checklist.edit', $checklist))
            ->assertRedirect();

        $this->actingAs($checklist->owner)
            ->get(route('checklist.edit', $checklist))
            ->assertSuccessful();
    }
}
