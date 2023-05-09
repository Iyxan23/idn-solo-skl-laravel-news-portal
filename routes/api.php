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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('logout', [App\Http\Controllers\API\AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/user/all', [App\Http\Controllers\API\UserController::class, 'getAllUser']);
Route::get('/user/{id}', [App\Http\Controllers\API\UserController::class, 'getUserById']);