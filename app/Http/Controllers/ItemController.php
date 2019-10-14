<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Checklist $checklist
     * @return void
     */
    public function store(Request $request, Checklist $checklist)
    {
        if (! auth()->user()->is($checklist->owner)) {
            return redirect(route('checklist.index'));
        }

        $checklist->items()->create($request->all());

        return redirect(route('checklist.edit', $checklist));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Item $item
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Item $item)
    {
        if (auth()->user()->is($item->checklist->owner)) {
            $item->delete();
        }

        return redirect(route('checklist.edit', $item->checklist));
    }
}
