<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\UsersController;
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

Route::get('/register', [UsersController::class, 'getRegisterPage'])->name('login.page');
Route::post('/register', [UsersController::class, 'register'])->name('register.user');
Route::get('/', [UsersController::class, 'getLoginPage'])->name('login.page');
Route::post('/', [UsersController::class, 'login'])->name('login.post');
Route::middleware(['authRoute'])->group(function () {
    Route::get('/product-list', [ProductController::class, 'indexProduct'])->name('product.page');
    Route::post('/product-order', [ProductController::class, 'orderProduct'])->name('product.order');
    Route::get('/top-up', [TopUpController::class, 'getTopUpPage'])->name('topup.page');
    Route::post('/top-up', [TopUpController::class, 'topUp'])->name('topup.post');
    Route::get('/order-history', [OrderController::class, 'getHistoryOrderPage'])->name('order.history');
    Route::get('/pay-order/{id}', [PaymentController::class, 'getPayOrderPage'])->name('payorder.page');
    Route::post('/pay/{id}', [PaymentController::class, 'createPayment'])->name('payment.order');
});
