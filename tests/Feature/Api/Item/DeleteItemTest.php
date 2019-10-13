<?php

namespace Tests\Feature\Api\Item;

use App\Checklist;
use App\Item;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_delete_their_item()
    {
        $item = factory(Item::class)->create();

        $this->delete(route('item.delete', $item))
            ->assertRedirect();

        $this->actingAs(factory(User::class)->create())
            ->delete(route('item.delete', $item))
            ->assertRedirect();

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
        ]);

        $this->actingAs($item->checklist->owner)
            ->delete(route('item.delete', $item))
            ->assertRedirect();

        $this->assertDatabaseMissing('items', [
            'id' => $item->id,
        ]);
    }
}
