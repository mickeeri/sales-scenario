<?php

Route::get('/', function () {
    return Redirect('/dashboard');
});

/*
|--------------------------------------------------------------------------
| Application routes that does NOT require authentication
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => 'web'], function () {

    Route::auth();
});

/*
|--------------------------------------------------------------------------
| Application routes that REQUIRES authentication
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['web','auth']], function(){

    Route::get('/dashboard', 'DashboardController@index');

    Route::get('explore', 'ExploreController@index');
    Route::get('explore/{id}', 'ExploreController@index');

    Route::get('expert/{id}', 'ExploreController@expert');

    Route::get('player/{expert}/{track}', 'PlayerController@index');
    Route::get('player/history', 'PlayerController@history');

    Route::get('profile', 'ProfileController@index');
    Route::put('users/{id}', 'ProfileController@update');
});







