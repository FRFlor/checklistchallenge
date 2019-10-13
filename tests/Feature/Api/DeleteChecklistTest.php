<?php

namespace Tests\Feature\Api;

use App\Checklist;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteChecklistTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_delete_their_checklist()
    {
        $user = factory(User::class)->create();
        $checklist = factory(Checklist::class)->create([
            'owner_id' => $user->id,
        ]);

        $this->delete(route('checklist.delete', $checklist))
            ->assertRedirect();

        $this->actingAs(factory(User::class)->create())
            ->delete(route('checklist.delete', $checklist))
            ->assertRedirect();

        $this->assertDatabaseHas('checklists', [
            'id' => $checklist->id,
        ]);

        $this->actingAs($user)
            ->delete(route('checklist.delete', $checklist))
            ->assertRedirect();

        $this->assertDatabaseMissing('checklists', [
            'id' => $checklist->id,
        ]);
    }
}
