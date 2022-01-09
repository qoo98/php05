<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\UpdateController;


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

// Route::get('/shops', 'ShopController@index')->name('shop.list');
Route::get('/shops', [ShopController::class, 'index'])->name('shop.list');
// Route::get('/shop/new', 'ShopController@create')->name('shop.new');
Route::get('/shops/new', [ShopController::class, 'create'])->name('shop.new');
// Route::post('/shop', 'ShopController@store')->name('shop.store');
Route::post('/shop', [ShopController::class, 'store'])->name('shop.store');

Route::get('/shop/profile', [ShopController::class, 'profile'])->name('profile');
Route::post('/shop/profile', [ShopController::class, 'profile'])->name('profile');


Route::get('/password/change', [ChangePasswordController::class, 'edit']);
Route::patch('/password/change', [ChangePasswordController::class, 'update'])->name('password.change');

Route::post('/name/change', [UpdateController::class, 'updatename'])->name('name.update');



// Route::get('/shop/{id}', 'ShopController@show')->name('shop.detail');
Route::get('/lists/{lists_id}', [ShopController::class, 'show'])->name('shop.detail');
// Route::delete('/shop/{id}', 'ShopController@destroy')->name('shop.destroy');
Route::get('shop/delete', [UpdateController::class, 'destroy'])->name('user.destroy');

Route::get('/', function () {
    return redirect('/shops');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home', function () {
    return redirect('/shops');
});