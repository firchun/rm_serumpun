<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FoodMenuController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackagePriceController;
use App\Http\Controllers\ReportController;
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


Auth::routes(['verify' => true]);
Route::group(['middleware' => ['auth', 'verified']], function () {
    //home
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('home');
    //notifikasi
    Route::put('/read_notif/{id}', [NotifikasiController::class, 'read'])->name('read_notif');
    Route::put('/read_all/{id}', [NotifikasiController::class, 'read_all'])->name('read_all');
    Route::get('/notifikasi', [AdminController::class, 'notifikasi'])->name('notifikasi');
    //order
    Route::get('orders/print/{id}', [OrderController::class, 'print'])->name('orders.print');
    Route::get('orders/detail/{id}', [OrderController::class, 'show'])->name('orders.detail');
    //akun
    Route::get('user/akun', [App\Http\Controllers\UserController::class, 'akun'])->name('user.akun');
    Route::put('user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
});
// Grouping routes for admin middleware
Route::middleware(['role:kasir', 'verified'])->group(function () {
    //order
    Route::get('orders', [OrderController::class, 'index'])->name('orders');
    Route::post('orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::post('orders/storeItems', [OrderController::class, 'storeItems'])->name('orders.storeItems');
    Route::post('orders/storePayment', [OrderController::class, 'storePayment'])->name('orders.storePayment');
    Route::post('orders/lunas', [OrderController::class, 'lunas'])->name('orders.lunas');
    Route::put('orders/update/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('orders/destroy/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::delete('orders/destroyItems/{id}', [OrderController::class, 'destroyItems'])->name('orders.destroyItems');
    Route::delete('orders/destroyPayment/{id}', [OrderController::class, 'destroyPayment'])->name('orders.destroyPayment');
    //foods menu
    Route::get('foods', [FoodMenuController::class, 'index'])->name('foods');
    Route::post('foods/store', [FoodMenuController::class, 'store'])->name('foods.store');
    Route::put('foods/update/{id}', [FoodMenuController::class, 'update'])->name('foods.update');
    Route::delete('foods/destroy/{id}', [FoodMenuController::class, 'destroy'])->name('foods.destroy');
});
Route::middleware(['role:user', 'verified'])->group(function () {
    //order
    Route::get('orders/member', [OrderController::class, 'member'])->name('orders.member');
});
Route::middleware(['role:pengelola', 'verified'])->group(function () {
    //user
    Route::get('user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('user/member', [App\Http\Controllers\UserController::class, 'member'])->name('user.member');
    Route::post('user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');

    Route::delete('user/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
    //report
    Route::get('report/menu', [ReportController::class, 'menu'])->name('report.menu');
    Route::get('report/pdf_menu', [ReportController::class, 'pdf_menu'])->name('report.pdf_menu');
    Route::get('report/orders', [ReportController::class, 'orders'])->name('report.orders');
    Route::get('report/pdf_orders', [ReportController::class, 'pdf_orders'])->name('report.pdf_orders');
});
