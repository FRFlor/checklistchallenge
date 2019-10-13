<?php

namespace App\Http\Controllers;

use App\ChecklistTemplate;
use App\ItemTemplate;
use Illuminate\Http\Request;

class ItemTemplateController extends Controller
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
     * @param Request $request
     * @param ChecklistTemplate $checklistTemplate
     * @return void
     */
    public function store(Request $request, ChecklistTemplate $checklistTemplate)
    {
        $itemTemplate = $checklistTemplate->items()->create($request->all());

        return view('checklist-template.show', compact('checklistTemplate'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemTemplate  $itemTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(ItemTemplate $itemTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemTemplate  $itemTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemTemplate $itemTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemTemplate  $itemTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemTemplate $itemTemplate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ItemTemplate $itemTemplate
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(ItemTemplate $itemTemplate)
    {
        if (auth()->user()->is($itemTemplate->checklist->owner)) {
            $itemTemplate->delete();
        }

        return redirect(route('checklist-template.show', $itemTemplate->checklist));
    }
}
