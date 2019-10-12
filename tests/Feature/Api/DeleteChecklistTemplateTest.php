<?php

namespace Tests\Feature\Api;

use App\ChecklistTemplate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteChecklistTemplateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_delete_their_checklist()
    {
        $user = factory(User::class)->create();
        $checklistTemplate = factory(ChecklistTemplate::class)->create([
            'owner_id' => $user->id,
        ]);

        $this->delete(route('checklist-template.delete', $checklistTemplate))
            ->assertRedirect();

        $this->actingAs(factory(User::class)->create())
            ->delete(route('checklist-template.delete', $checklistTemplate))
            ->assertRedirect();

        $this->assertDatabaseHas('checklist_templates', [
            'id' => $checklistTemplate->id,
        ]);

        $this->actingAs($user)
            ->delete(route('checklist-template.delete', $checklistTemplate))
            ->assertRedirect();

        $this->assertDatabaseMissing('checklist_templates', [
            'id' => $checklistTemplate->id,
        ]);
    }
}
