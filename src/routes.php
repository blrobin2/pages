<?php

/**
 *  Login and Passwords
 */
Route::get('login', 'BruceCms\Pages\AuthenticationController@getLogin');
Route::post('login', 'BruceCms\Pages\AuthenticationController@postLogin');
Route::get('logout', 'BruceCms\Pages\AuthenticationController@getLogout');

Route::controllers([
    'password' => 'App\Http\Controllers\Auth\PasswordController',
]);

/**
 * Admin Manager
 */
Route::resource('admins', 'BruceCms\Pages\AuthenticationController');

/**
 * Sitemap
 */
Route::get('sitemap.xml', 'BruceCms\Pages\PagesController@sitemap');

/**
 * Page Content Manager
 */
Route::get('pages', 'BruceCms\Pages\PagesController@index');

/** Sort the pages */
Route::post('pages/sort', 'BruceCms\Pages\PagesController@sort');

/** Set the parent page */
Route::post('pages/{pages}/parent', 'BruceCms\Pages\PagesController@setParent');

/** Create a new Page */
Route::get('pages/create', ['as' => 'createPage', 'uses' => 'BruceCms\Pages\PagesController@create']);

/**  Save a new Page */
Route::post('pages', 'BruceCms\Pages\PagesController@store');

/** Redirect empty route to home page */
Route::get('/', function () {
    return redirect()->action('\BruceCms\Pages\PagesController@show', ['home']);
});

/** View a single page (the heart of the CMS) */
Route::get('{pages}', 'BruceCms\Pages\PagesController@show');

/** Edit an existing Page */
Route::get('{pages}/edit', 'BruceCms\Pages\PagesController@edit');

/** Update an existing Page */
Route::patch('{pages}', ['as'=>'updatePage', 'uses'=>'BruceCms\Pages\PagesController@update']);

/** Delete a Page */
Route::delete('{pages}', 'BruceCms\Pages\PagesController@destroy');
