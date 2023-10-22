<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FoodMenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackagePriceController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SubdivisionController;
use App\Http\Controllers\TransportationController;

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


Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('home');
    Route::get('user/akun', [App\Http\Controllers\UserController::class, 'akun'])->name('user.akun');
});
// Grouping routes for admin middleware
Route::middleware(['role:admin,super_admin'])->group(function () {
    //foods menu
    Route::get('orders', [OrderController::class, 'index'])->name('orders');
    Route::post('orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::post('orders/storeItems', [OrderController::class, 'storeItems'])->name('orders.storeItems');
    Route::post('orders/storePayment', [OrderController::class, 'storePayment'])->name('orders.storePayment');
    Route::post('orders/lunas', [OrderController::class, 'lunas'])->name('orders.lunas');
    Route::get('orders/print/{id}', [OrderController::class, 'print'])->name('orders.print');
    Route::get('orders/detail/{id}', [OrderController::class, 'show'])->name('orders.detail');
    Route::put('orders/update/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('orders/destroy/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::delete('orders/destroyItems/{id}', [OrderController::class, 'destroyItems'])->name('orders.destroyItems');
    Route::delete('orders/destroyPayment/{id}', [OrderController::class, 'destroyPayment'])->name('orders.destroyPayment');
    //foods menu
    Route::get('foods', [FoodMenuController::class, 'index'])->name('foods');
    Route::post('foods/store', [FoodMenuController::class, 'store'])->name('foods.store');
    Route::put('foods/update/{id}', [FoodMenuController::class, 'update'])->name('foods.update');
    Route::delete('foods/destroy/{id}', [FoodMenuController::class, 'destroy'])->name('foods.destroy');
    //user
    Route::get('user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::post('user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::put('user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::delete('user/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
});
