<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/checklists', 'ChecklistController@index')->name('checklist.index');
    Route::get('/checklists/create', 'ChecklistController@create')->name('checklist.create');
    Route::get('/checklists/{checklist}', 'ChecklistController@show')->name('checklist.show');
    Route::post('/checklists', 'ChecklistController@store')->name('checklist.store');
    Route::delete('/checklists/{checklist}', 'ChecklistController@destroy')->name('checklist.delete');

    Route::post('/checklists/{checklist}', 'ItemController@store')->name('item.store');
    Route::delete('/items/{item}', 'ItemController@destroy')->name('item.delete');
});
