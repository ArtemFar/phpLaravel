<?php

use App\Http\Controllers\Account\IndexController as AccountController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\OrdersController as AdminOrdersController;
use App\Http\Controllers\Admin\ResourcesController as AdminResourcesController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SocialProvidersController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

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

//Welcom
Route::get('/', [WelcomeController::class, 'index'])
    ->name('welcome');

/*
Route::get('/', function () {
    return view('welcome');
});
*/

//Category
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])
    ->where('id', '\d+')
    ->name('categories.show');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/account', AccountController::class)->name('account');
    //Admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is.admin'], static function () {
        Route::get('/', AdminController::class)->name('index');
        Route::get('/parser', ParserController::class)->name('parser');
        Route::resource('/categories', AdminCategoryController::class);
        Route::resource('/news', AdminNewsController::class);
        Route::resource('/orders', AdminOrdersController::class);
        Route::resource('/users', AdminUsersController::class);
        Route::resource('/resources', AdminResourcesController::class);
    });
});

//Order
Route::get('/order-form', [OrderController::class, 'showForm'])->name('order-form.showForm');
Route::post('/order-form', [OrderController::class, 'processForm'])->name('order-form.processForm');


//News
Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/news/{id}/{categories_id}', [NewsController::class, 'show'])
    ->where('id', '\d+')
    ->where('categories_id', '\d+')
    ->name('news.show');


// Guests routes

Route::group(['middleware' => 'guest'], function () {
    Route::get('/{driver}/redirect', [SocialProvidersController::class, 'redirect'])
        ->where('driver', '\w+')
        ->name('social-providers.redirect');

    Route::get('/{driver}/callback', [SocialProvidersController::class, 'callback'])
        ->where('driver', '\w+')
        ->name('social-providers.callback');
});

//Test
Route::get('/test', function (\Illuminate\Http\Request $request) {
    return response()->download('robots.txt');
});

//Session
Route::get('/session', function () {
    $key = 'test';

    if (session()->has($key)) {
        // session()->forget($key);
        dd(session()->all(), session()->get($key));
    }

    session()->put($key, 'Some value');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
