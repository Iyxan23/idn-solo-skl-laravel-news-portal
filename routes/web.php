<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
Route::get('/search-news-end', [App\Http\Controllers\FrontendController::class, 'searchNewsEnd'])->name('search.end-news');

Auth::routes();

Route::match(['get', 'post'], '/register', function() {
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/category', CategoryController::class);
    Route::get('/category-search', [CategoryController::class, 'searchCategory'])->name('category.search');
    Route::get('/news-search', [NewsController::class, 'searchNews'])->name('news.search');

    Route::get('/change-password', [ProfileController::class, 'editPassword'])->name('profile.change-password');
    Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    Route::resource('/news', NewsController::class);
    Route::resource('/slider', SliderController::class);
});

// needed to run artisan commands without shell access
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return 'link has been connected';
});

// Clear application cache:
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return 'Application cache has been cleared';
});

//Clear route cache:
Route::get('/route-cache', function () {
    Artisan::call('route:cache');
    return 'Routes cache has been cleared';
});

//Clear config cache:
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return 'Config cache has been cleared';
});

// Clear view cache:
Route::get('/view-clear', function () {
    Artisan::call('view:clear');
    return 'View cache has been cleared';
});