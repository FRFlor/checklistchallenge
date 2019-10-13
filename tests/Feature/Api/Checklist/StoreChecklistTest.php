<?php

namespace Tests\Feature\Api\Checklist;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreChecklistTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_checklist()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $this->actingAs($user)->post(route('checklist.store'), [
            'name' => 'Checklist',
        ])->assertRedirect();

        $this->assertDatabaseHas('checklists', [
            'name' => 'Checklist',
            'owner_id' => $user->id,
        ]);
    }

    /** @test */
    public function a_guest_cannot_create_a_checklist()
    {
        $this->post(route('checklist.store'), [
            'name' => 'Checklist',
        ])->assertRedirect();
    }
}
