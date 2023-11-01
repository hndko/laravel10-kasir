<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/jenis-barang', [JenisBarangController::class, 'index'])->name('jenis-barang');
    Route::post('/jenis-barang/store', [JenisBarangController::class, 'store'])->name('jenis-barang.store');
    Route::post('/jenis-barang/update/{id}', [JenisBarangController::class, 'update'])->name('jenis-barang.update');
    Route::delete('/jenis-barang/destroy/{id}', [JenisBarangController::class, 'destroy'])->name('jenis-barang.destroy');
});

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
