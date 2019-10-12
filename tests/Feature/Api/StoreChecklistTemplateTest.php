<?php

namespace Tests\Feature\Api;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreChecklistTemplateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_checklist_template()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->post(route('checklist-template.store'), [
            'name' => 'Checklist',
        ])->assertRedirect();

        $this->assertDatabaseHas('checklist_templates', [
            'name' => 'Checklist',
            'owner_id' => $user->id,
        ]);
    }

    /** @test */
    public function a_guest_cannot_create_a_checklist_template()
    {
        $this->post(route('checklist-template.store'), [
            'name' => 'Checklist',
        ])->assertRedirect();
    }
}
