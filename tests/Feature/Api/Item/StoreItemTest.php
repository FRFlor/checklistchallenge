<?php

namespace Tests\Feature\Api\Item;

use App\Checklist;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_add_items_to_their_checklist()
    {
        $user = factory(User::class)->create();
        $checklist = factory(Checklist::class)->create([
            'owner_id' => $user->id,
        ]);

        $this->post(route('item.store', $checklist), [
            'name' => 'Item',
        ])->assertRedirect();

        $this->actingAs(factory(User::class)->create())->post(route('item.store', $checklist), [
            'name' => 'Item',
        ])->assertRedirect(route('checklist.index'));

        $this->assertDatabaseMissing('items', [
            'name' => 'Item',
            'checklist_id' => $checklist->id,
        ]);

        $this->actingAs($user)->post(route('item.store', $checklist), [
            'name' => 'Item',
        ])->assertRedirect(route('checklist.edit', $checklist));

        $this->assertDatabaseHas('items', [
            'name' => 'Item',
            'checklist_id' => $checklist->id,
        ]);
    }
}
