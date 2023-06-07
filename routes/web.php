<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

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
    return view('welcome');
});



Route::group(['middleware' => 'auth'], function()
{
    Route::resources([
        'dishes' => \App\Http\Controllers\DishController::class,
        'orders' => \App\Http\Controllers\OrderController::class,
        'categories' => \App\Http\Controllers\CategoryController::class,
        'drinks' => \App\Http\Controllers\DrinkController::class,
//        'welcome' => \App\Http\Controllers\WelcomeController::class,
    ]);


});


Route::get('/cart',[App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('/add_to_cart',[App\Http\Controllers\CartController::class, 'add'])->name('addToCart');

Route::get('welcome', [WelcomeController::class, 'welcome'])->name('welcome');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::delete('remove-from-cart',[\App\Http\Controllers\DishController::class, 'remove'])->name('remove-from-cart');
