<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/checklist-templates/{checklistTemplate}', 'ChecklistTemplateController@show')->name('checklist-template.show');
    Route::post('/checklist-templates', 'ChecklistTemplateController@store')->name('checklist-template.store');

    Route::post('/checklist-templates/{checklistTemplate}', 'ItemTemplateController@store')->name('item-template.store');
});
