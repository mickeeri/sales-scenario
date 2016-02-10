<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * Startsida efter innlogning
 */

Route::get('/', function () {
    return View('home');
});


Route::get('dashboard', function () {
    return 'vy 4: Detta är startsidan med dashboard';
});

/**
 * När man klickar på explore
 */
Route::get('explore', function () {
    return 'vy 6: Lista alla experter med alla taggar';
});

Route::get('explore/{id}', function () {
    return 'vy 6: Lista alla experter efter vald taggid från dashboard';
});

/**
 * När man klickar på experten namn i listan
 */
Route::get('expert/{id}', function () {
    return 'vy 7: Lista med expertens ljudbloggar';
});


/**
 * Bloggradion.
 */
Route::get('player/{expert}/{track}', function () {
    return View('player');
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

// Route::group(['middleware' => ['web']], function () {
//     //
// });

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
