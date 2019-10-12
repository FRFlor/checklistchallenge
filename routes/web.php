<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::post('/checklist-templates/{checklist-template}', 'ChecklistTemplateController@show')->name('checklist-template.show');
    Route::post('/checklist-templates', 'ChecklistTemplateController@store')->name('checklist-template.store');
});
