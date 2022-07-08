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
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PrediksiController;


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



Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index']);
        Route::resource('produks', AdminProdukController::class);
        Route::resource('stoks', AdminStokController::class);
        Route::resource('buyers', AdminBuyerController::class);
        Route::prefix('laporan')->group(function () {
            Route::get('penjualan', [LaporanController::class, 'penjualan']);
            Route::get('persediaan', [LaporanController::class, 'persediaan']);
            Route::get('kualitas', [LaporanController::class, 'kualitas']);
        });

        Route::prefix('prediksi')->group(function () {
            Route::get('harian', [PrediksiController::class, 'harian']);
            Route::get('mingguan', [PrediksiController::class, 'mingguan']);
            Route::get('bulanan', [PrediksiController::class, 'bulanan']);
            Route::get('duamingguan', [PrediksiController::class, 'duamingguan']);
            Route::post('fuzzification', [PrediksiController::class, 'fuzzification'])->name('fuzzification');
        });



    });
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', [ProdukController::class, 'index']);
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/register', [RegisterController::class, 'index']);
    Route::get('/beli', [BuyerController::class, 'index']);
    Route::post('/beli', [BuyerController::class, 'store']);
});

