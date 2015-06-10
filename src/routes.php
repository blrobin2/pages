<?php

/**
 * Page Content Manager
 */
Route::get('pages', 'BruceCms\Pages\PagesController@index');

/** Sort the pages */
Route::post('pages/sort', 'BruceCms\Pages\PagesController@sort');

/** Create a new Page */
Route::get('pages/create', ['as' => 'createPage', 'uses' => 'BruceCms\Pages\PagesController@create']);

/**  Save a new Page */
Route::post('pages', 'BruceCms\Pages\PagesController@store');

/** Point empty route to home page */
Route::get('/', function(){
    return view('layouts.home');
});


/** View a single page (the heart of the CMS) */
Route::get('{pages}', 'BruceCms\Pages\PagesController@show');

/** Edit an existing Page */
Route::get('{pages}/edit', 'BruceCms\Pages\PagesController@edit');

/** Update an existing Page */
Route::patch('{pages}', ['as'=>'updatePage', 'uses'=>'BruceCms\Pages\PagesController@update']);

/** Delete a Page */
Route::delete('{pages}', 'BruceCms\Pages\PagesController@destroy');