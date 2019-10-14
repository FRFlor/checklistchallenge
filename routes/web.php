<?php

Route::get('/', function () {
    if (auth()->check()) {
        return redirect(route('checklist.index'));
    }
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::patch('/tasks/{task}', 'TaskController@update')->name('task.update');

    Route::post('/checklists/{checklist}/attempt', 'AttemptController@store')->name('attempt.store');
    Route::get('/attempt/{attempt}', 'AttemptController@show')->name('attempt.show');

    Route::get('/checklists', 'ChecklistController@index')->name('checklist.index');
    Route::get('/checklists/create', 'ChecklistController@create')->name('checklist.create');
    Route::get('/checklists/{checklist}', 'ChecklistController@show')->name('checklist.show');
    Route::post('/checklists', 'ChecklistController@store')->name('checklist.store');
    Route::delete('/checklists/{checklist}', 'ChecklistController@destroy')->name('checklist.delete');

    Route::post('/checklists/{checklist}', 'ItemController@store')->name('item.store');
    Route::delete('/items/{item}', 'ItemController@destroy')->name('item.delete');
});
