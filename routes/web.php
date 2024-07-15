<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\TransaksiController;


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


Route::get('/test-login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/ceklogin', [LoginController::class, 'login'])->name('ceklogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboardnew', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboardnew/datalist', [DashboardController::class, 'datalist'])->name('datalist');

// Master
Route::get('/master', [MasterController::class, 'index'])->name('master');
Route::get('/master/list', [MasterController::class, 'list'])->name('list');
Route::get('/master/deleteproduct', [MasterController::class, 'deleteproduct'])->name('deleteproduct');
Route::post('/master/addproduct', [MasterController::class, 'addproduct'])->name('addproduct');
Route::post('/master/updateproduct', [MasterController::class, 'updateproduct'])->name('updateproduct');

// Transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
Route::get('/transaksi/list', [TransaksiController::class, 'listtransaksi'])->name('listtransaksi');
Route::post('/transaksi/add', [TransaksiController::class, 'addtransaksi'])->name('addtransaksi');




