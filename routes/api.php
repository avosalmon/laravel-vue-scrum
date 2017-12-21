<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('sprints')->group(function () {
    Route::get('/',                                   '\Avosalmon\Application\Controllers\SprintsController@index');
    Route::get('/with/{relationships}',               '\Avosalmon\Application\Controllers\SprintsController@with');
    Route::post('/',                                  '\Avosalmon\Application\Controllers\SprintsController@store');
    Route::put('/{id}',                               '\Avosalmon\Application\Controllers\SprintsController@update');
    Route::get('/{id}/with/{relationships}',          '\Avosalmon\Application\Controllers\SprintsController@showWith');
    Route::post('/{sprint_id}/users/{user_id}',       '\Avosalmon\Application\Controllers\SprintUsersController@store');
    Route::put('/{sprint_id}/users/{user_id}',        '\Avosalmon\Application\Controllers\SprintUsersController@update');
    Route::post('/{sprint_id}/projects/{project_id}', '\Avosalmon\Application\Controllers\SprintProjectsController@store');
    Route::put('/{sprint_id}/projects/{project_id}',  '\Avosalmon\Application\Controllers\SprintProjectsController@update');
});

Route::prefix('users')->group(function () {
    Route::get('/', '\Avosalmon\Application\Controllers\UsersController@index');
});

Route::prefix('projects')->group(function () {
    Route::get('/', '\Avosalmon\Application\Controllers\ProjectsController@index');
});
