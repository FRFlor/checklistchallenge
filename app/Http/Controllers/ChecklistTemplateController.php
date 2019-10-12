<?php

namespace App\Http\Controllers;

use App\ChecklistTemplate;
use Illuminate\Http\Request;

class ChecklistTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checklistTemplates = auth()->user()->checklistTemplates;

        return view('checklist-template.index', compact('checklistTemplates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('checklist-template.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $template = auth()->user()->checklistTemplates()->create($request->all());

        return redirect(route('checklist-template.show', $template));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChecklistTemplate  $checklistTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(ChecklistTemplate $checklistTemplate)
    {
        if (! auth()->user()->is($checklistTemplate->owner)) {
            return redirect(route('home'));
        }

        return view('checklist-template.show', compact('checklistTemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChecklistTemplate  $checklistTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(ChecklistTemplate $checklistTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChecklistTemplate  $checklistTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChecklistTemplate $checklistTemplate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ChecklistTemplate $checklistTemplate
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(ChecklistTemplate $checklistTemplate)
    {
        if (auth()->user()->is($checklistTemplate->owner)) {
            $checklistTemplate->delete();
        }

        return redirect(route('checklist-template.index'));
    }
}
