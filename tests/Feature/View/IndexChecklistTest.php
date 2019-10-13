<?php

namespace Tests\Feature\View;

use App\Checklist;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexChecklistTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_their_checklists()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $checklists = factory(Checklist::class, 2)->create([
            'owner_id' => $user->id,
        ]);

        $response = $this->actingAs($user)
            ->get(route('checklist.index'))
            ->assertSuccessful();

        $checklists->each(function ($checklist) use ($response) {
            $response->assertSee($checklist->name);
        });
    }
}
