<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);


	// Route::get('billing', function () {
	// 	return view('billing');
	// })->name('billing');


	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	// Route::get('user-management', function () {
	// 	return view('laravel-examples/user-management');
	// })->name('user-management');
    Route::get('user-management',[UsersController::class,'index'])->name('user-management');
    Route::get('user-edit/{id}',[UsersController::class,'edit_user'])->name('user-edit');
    Route::resource('user',UsersController::class);
    Route::resource('category',CatController::class);
    Route::get('cat-edit/{id}',[CatController::class,'edit_cat'])->name('cat-edit');
    Route::resource('product',ProductController::class);
    Route::get('product-edit/{id}',[ProductController::class,'edit_product'])->name('product-edit');
    Route::resource('card', CartController::class);
    Route::get('edit_cart',[CartController::class,'edit_cart'])->name('edit_cart');
    Route::get('dashboard',[HomeController::class,'home'])->name('dashboard');


	// Route::get('dashboard', function () {
	// 	return view('dashboard');
	// })->name('dashboard');


	// Route::get('category-management', function () {
	// 	return view('tables');
	// })->name('category-management');

    // Route::get('product', function () {
	// 	return view('product');
	// })->name('product');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
