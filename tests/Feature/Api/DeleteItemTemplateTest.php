<?php

namespace Tests\Feature\Api;

use App\ChecklistTemplate;
use App\ItemTemplate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteItemTemplateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_delete_their_item()
    {
        $itemTemplate = factory(ItemTemplate::class)->create();

        $this->delete(route('checklist-template.delete', $itemTemplate))
            ->assertRedirect();

        $this->actingAs(factory(User::class)->create())
            ->delete(route('item-template.delete', $itemTemplate))
            ->assertRedirect();

        $this->assertDatabaseHas('item_templates', [
            'id' => $itemTemplate->id,
        ]);

        $this->actingAs($itemTemplate->checklist->owner)
            ->delete(route('item-template.delete', $itemTemplate))
            ->assertRedirect();

        $this->assertDatabaseMissing('item_templates', [
            'id' => $itemTemplate->id,
        ]);
    }
}
