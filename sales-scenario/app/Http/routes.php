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
    return 'vy 4: Detta är startsidan med dashboard';
});

/**
 * När man klickar på experten namn i listan
 */
Route::get('expert/{name}', function () {
    return 'vy 7: Lista med expertens låtar (OBS {name} kanske inte är unikt. id istället kanske?)';
});

/**
 * När man klickar på explore
 */
Route::get('explore', function () {
    return 'vy 7: Lista med taggar';
});

/**
 * Bloggradion.
 */
Route::get('player/{name}/{title}', function () {
    return 'vy 8: spelaren. {name} och {title} kanske inte är unikt?';
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
