<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('index');
Route::get('/detail/category/{slug}', [App\Http\Controllers\FrontendController::class, 'detailCategory'])->name('detail.category');
Route::get('/detail/news/{slug}', [App\Http\Controllers\FrontendController::class, 'detailNews'])->name('detail.news');

Auth::routes();

Route::match(['get', 'post'], '/register', function() {
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/category', CategoryController::class);
    Route::get('/category-search', [CategoryController::class, 'searchCategory'])->name('category.search');

    Route::resource('/news', NewsController::class);
    Route::resource('/slider', SliderController::class);
});