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
    Route::get('/',                          '\Avosalmon\Application\Controllers\SprintsController@index');
    Route::get('/{id}/with/{relationships}', '\Avosalmon\Application\Controllers\SprintsController@showWith');
});
