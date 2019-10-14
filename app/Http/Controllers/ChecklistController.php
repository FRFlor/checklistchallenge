<?php

namespace App\Http\Controllers;

use App\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checklists = auth()->user()->checklists;

        return view('checklist.index', compact('checklists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('checklist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checklist = auth()->user()->checklists()->create($request->all());

        return redirect(route('checklist.show', $checklist));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist)
    {
        if (! auth()->user()->is($checklist->owner)) {
            return redirect(route('checklist.index'));
        }

        return view('checklist.show', compact('checklist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist)
    {
        if (! auth()->user()->is($checklist->owner)) {
            return redirect(route('checklist.index'));
        }
        return view('checklist.edit', compact('checklist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checklist $checklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Checklist $checklist
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Checklist $checklist)
    {
        if (auth()->user()->is($checklist->owner)) {
            $checklist->delete();
        }

        return redirect(route('checklist.index'));
    }
}
