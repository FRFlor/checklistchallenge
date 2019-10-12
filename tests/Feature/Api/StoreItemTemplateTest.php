<?php

namespace Tests\Feature\Api;

use App\ChecklistTemplate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreItemTemplateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_add_items_to_their_checklist_template()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $checklistTemplate = factory(ChecklistTemplate::class)->create([
            'owner_id' => $user->id,
        ]);

        $this->actingAs($user)->post(route('item-template.store', $checklistTemplate), [
            'name' => 'Item',
        ])->assertSuccessful();

        $this->assertDatabaseHas('item_templates', [
            'name' => 'Item',
            'checklist_id' => $checklistTemplate->id,
        ]);
    }
}
