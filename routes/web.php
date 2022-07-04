<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminStokController;
use App\Http\Controllers\AdminBuyerController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminDashboardController;

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

Route::get('/', [ProdukController::class, 'index'])->middleware('guest');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');

Route::post('/register', [RegisterController::class, 'store']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->middleware('auth');

Route::resource('/admin/produks', AdminProdukController::class)->middleware('auth');

Route::resource('/admin/stoks', AdminStokController::class)->middleware('auth');

Route::resource('/admin/buyers', AdminBuyerController::class)->middleware('auth');

Route::get('/beli', [BuyerController::class, 'index'])->middleware('guest');

Route::post('/beli', [BuyerController::class, 'store'])->middleware('guest');


