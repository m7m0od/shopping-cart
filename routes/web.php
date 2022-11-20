<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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

Route::get('/', function () {
    return redirect()->route('store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::delete('product/{product}',[ProductController::class,'destroy'])->name('product.remove');
Route::put('product/{product}',[ProductController::class,'update'])->name('product.update');
Route::get('/addToCart/{product}', [App\Http\Controllers\ProductController::class, 'addToCart'])->name('cart.add');
Route::get('/showCart', [App\Http\Controllers\ProductController::class, 'showCart'])->name('cart.show');
Route::get('/checkout/{amount}', [App\Http\Controllers\ProductController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::get('/charge', [App\Http\Controllers\ProductController::class, 'charge'])->name('cart.charge');

Route::get('/orders',[OrderController::class,'index'])->name('order.index');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
