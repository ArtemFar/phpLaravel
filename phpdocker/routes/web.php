<?php

use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SocialProvidersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::prefix('admin')->name('admin.')->middleware(['auth','is.admin'])->group(function () {
    Route::get('/', AdminController::class)->name('index');
    Route::get('/parser', ParserController::class)->name('parser');
    Route::get('/users', [AdminUsersController::class, 'index'])->name('users');
    Route::get('/users/toggleAdmin/{user}', [AdminUsersController::class, 'toggleAdmin'])->name('toggleAdmin');

    Route::resource('/news', AdminNewsController::class);
    Route::resource('/categories', AdminCategoryController::class);
});

Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{news}/show', [NewsController::class, 'show'])->name('show');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/vkontakte/redirect', [SocialProvidersController::class, 'redirect'])
        ->name('social-providers.redirect');

    Route::get('/vkontakte/callback', [SocialProvidersController::class, 'callback'])
        ->name('social-providers.callback');
});



Auth::routes();
//TODO распишите эти маршруты

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
