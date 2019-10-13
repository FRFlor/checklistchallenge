<?php

namespace Tests\Feature\Api\Attempt;

use App\Attempt;
use App\Checklist;
use App\Item;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreAttemptTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_an_attempt_from_one_of_their_checklists()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $checklist = factory(Checklist::class)->create([
            'owner_id' => $user->id,
        ]);
        $items = factory(Item::class, 3)->create([
            'checklist_id' => $checklist->id,
        ]);

        $this->actingAs($user)
            ->post(route('attempt.store', $checklist))
            ->assertSuccessful();

        $this->assertDatabaseHas('attempts', [
            'name' => $checklist->name,
            'checklist_id' => $checklist->id,
        ]);

        $attempt = Attempt::query()->first();

        $items->each(function ($item) use ($attempt) {
            $this->assertDatabaseHas('tasks', [
                'name' => $item->name,
                'attempt_id' => $attempt->id,
            ]);
        });
    }
}
