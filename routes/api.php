<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
        'movies' => Api\MovieController::class,
        'directors' => Api\DirectorController::class,
        'users' => Api\MovieController::class
]);

Route::get('/movies/{start_year}/{end_year}','Api\MovieController@showBetween');
Route::get('/directors/{id}/best10movie','Api\DirectorController@bestMovies');
