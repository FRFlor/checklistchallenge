<?php

namespace Tests\Feature\Api;

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
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $checklist = factory(Checklist::class)->create([
            'owner_id' => $user->id,
        ]);

        $this->actingAs($user)->post(route('item.store', $checklist), [
            'name' => 'Item',
        ])->assertSuccessful();

        $this->assertDatabaseHas('items', [
            'name' => 'Item',
            'checklist_id' => $checklist->id,
        ]);
    }
}
