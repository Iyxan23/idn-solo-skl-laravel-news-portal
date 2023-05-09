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
Route::post('update_password', [App\Http\Controllers\API\AuthController::class, 'updatePassword'])->middleware('auth:sanctum');

Route::get('user/all', [App\Http\Controllers\API\UserController::class, 'getAllUser']);
Route::get('user/{id}', [App\Http\Controllers\API\UserController::class, 'getUserById']);

Route::get('category/all', [App\Http\Controllers\API\CategoryController::class, 'getAllCategories']);
Route::get('category/paged', [App\Http\Controllers\API\CategoryController::class, 'getCategoriesPaged']);
Route::post('category/create', [App\Http\Controllers\API\CategoryController::class, 'create'])->middleware('auth:sanctum');

Route::get('category/{id}', [App\Http\Controllers\API\CategoryController::class, 'getCategoryById']);

Route::get('slider/all', [App\Http\Controllers\API\SliderController::class, 'getAllSliders']);
Route::post('slider/create', [App\Http\Controllers\API\SliderController::class, 'create'])->middleware('auth:sanctum');