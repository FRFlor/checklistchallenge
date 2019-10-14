<?php

namespace App\Http\Controllers;

use App\Attempt;
use App\Checklist;
use Illuminate\Http\Request;

class AttemptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Checklist $checklist
     * @return void
     */
    public function store(Request $request, Checklist $checklist)
    {
        $attempt = $checklist->attempts()->create([
            'name' => $checklist->name,
        ]);

        $attempt->tasks()->createMany($checklist->items->pluck('name')->map(function ($value) {
            return ['name' => $value];
        }));

        return redirect(route('attempt.show', $attempt));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attempt  $attempt
     * @return \Illuminate\Http\Response
     */
    public function show(Attempt $attempt)
    {
        if (! auth()->user()->is($attempt->checklist->owner)) {
            return redirect(route('checklist.index'));
        }

        return view('attempt.show', compact('attempt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attempt  $attempt
     * @return \Illuminate\Http\Response
     */
    public function edit(Attempt $attempt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attempt  $attempt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attempt $attempt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attempt  $attempt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attempt $attempt)
    {
        //
    }
}
