<?php

namespace Tests\Feature\View\Attempt;

use App\Attempt;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowAttemptTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_see_their_attempt()
    {
        $attempt = factory(Attempt::class)->create();

        $this->actingAs($attempt->checklist->owner)
            ->get(route('attempt.show', $attempt))
            ->assertSuccessful();
    }
}
