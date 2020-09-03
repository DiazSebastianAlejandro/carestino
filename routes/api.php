<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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

// Route::middleware('auth:api')->post('/user', 'UserController@show');

// Route::middleware('auth:api')->post('/oauth/clients', 'UserController@show');

Route::group([
    'prefix' => 'Api',
    'as' => 'api.',
    'middleware' => ['auth:api']
], function () {
Route::post('/mailvalidator', 'Api\AuthController@mailValidator' )->name('validator');
});

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login')->name('login');