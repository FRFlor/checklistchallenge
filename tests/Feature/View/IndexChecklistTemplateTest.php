<?php

namespace Tests\Feature\View;

use App\ChecklistTemplate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexChecklistTemplateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_their_checklist_templates()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $checklistTemplates = factory(ChecklistTemplate::class, 2)->create([
            'owner_id' => $user->id,
        ]);

        $response = $this->actingAs($user)
            ->get(route('checklist-template.index'))
            ->assertSuccessful();

        $checklistTemplates->each(function ($checklist) use ($response) {
            $response->assertSee($checklist->name);
        });
    }
}
