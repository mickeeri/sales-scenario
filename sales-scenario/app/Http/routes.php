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
    return Redirect('/dashboard');
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

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    /**
     * Hämta ljudfil.
     * Mime = audio/x-m4a
     */
    Route::get('audio/{id}', function($id) {

        // Check if logged in.
        if (!Auth::check()) {
            App::abort(401, 'Not authenticated');
        }

        $podcast = \App\Podcast::find($id);
        $file=storage_path().'/app/podcasts/'.$podcast->filename;
        return Response::download($file);
    });
});

Route::group(['middleware' => ['web','auth']], function(){
    Route::get('/dashboard', function() {
        return "inloggad";
    });

    /**
     * När man klickar på explore
     */
    Route::get('explore', 'ExploreController@Index');

    Route::get('explore/{id}', function () {
        return 'vy 6: Lista alla experter efter vald taggid från dashboard';
    });

    /**
     * När man klickar på experten namn i listan
     */
    Route::get('expert/{id}', 'ExploreController@Expert');

    /**
     * Bloggradion.
     */
    Route::get('player/{expert}/{track}', 'PlayerController@Index');

    /**
     * Users profile.
     */
    Route::get('profile', 'ProfileController@index');
    Route::put('users/{id}', 'ProfileController@update');

});







