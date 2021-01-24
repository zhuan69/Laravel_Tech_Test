<?php

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

Route::get('/product-list', [ProductController::class, 'indexProduct']);
Route::get('/register', [UsersController::class, 'getRegisterPage']);
Route::post('/register', [UsersController::class, 'register'])->name('register.user');
Route::get('/', [UsersController::class, 'getLoginPage'])->name('login.page');
Route::post('/', [UsersController::class, 'login'])->name('login.post');
Route::get('/top-up', [TopUpController::class, 'getTopUpPage']);
Route::post('/top-up', [TopUpController::class, 'topUp'])->name('topup.post');
