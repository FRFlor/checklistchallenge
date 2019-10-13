<?php

namespace Tests\Feature\View;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateChecklistTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_checklist()
    {
        $this->actingAs(factory(User::class)->create())
            ->get(route('checklist.create'))
            ->assertSuccessful()
            ->assertSeeText('Create Checklist');
    }
}
