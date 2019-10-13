<?php

use App\Checklist;
use App\Item;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $nick = factory(User::class)->create([
            'name' => 'nick',
            'email' => 'nick@nickdown.com'
        ]);

        $checklists = factory(Checklist::class, 5)->create([
            'owner_id' => $nick->id,
        ]);

        $checklists->each(function ($checklist) {
           factory(Item::class, 5)->create([
               'checklist_id' => $checklist->id,
           ]);
        });
    }
}
