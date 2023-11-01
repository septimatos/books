<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;


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

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::group(['middleware' => ['auth:sanctum'], 'namespace' => 'App\Http\Controllers'], function () {
    Route::resources([
        'books' => BookController::class,
        'genres' => GenreController::class,
        'authors' => AuthorController::class,
    ]);
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    Route::get('/guest/authorsList', 'GuestController@authorsList');
    Route::get('/guest/genresList', 'GuestController@genresList');
    Route::get('/guest/booksList', 'GuestController@booksList');

    Route::get('/guest/booksByGenreIdList/{id}', 'GuestController@booksByGenreIdList');
    Route::get('/guest/booksByAuthorIdList/{id}', 'GuestController@booksByAuthorIdList');

});