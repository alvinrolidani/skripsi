<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AturanController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\PosisiController;
use App\Http\Controllers\Admin\PositionController;


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


//PAGES

Route::group(['middleware' => ['auth', 'cekLogin:superadmin,admin']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/profil', [AdminController::class, 'profil'])->name('profil');
    Route::put('/update', [AdminController::class, 'update'])->name('update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    //staff
    Route::resource('staff', StaffController::class)->except(['destroy', 'update']);
    Route::get('/staff/{id}/destroy', [StaffController::class, 'destroy']);
    Route::post('/staff/{id}/update', [StaffController::class, 'update']);

    Route::resource('position', PosisiController::class)->except(['destroy', 'update']);
    Route::get('/position/{id}/destroy', [PosisiController::class, 'destroy']);
    Route::post('/position/{id}/update', [PosisiController::class, 'update']);

    Route::resource('kriteria', KriteriaController::class)->except(['destroy', 'update']);
    Route::get('/kriteria/{id}/destroy', [KriteriaController::class, 'destroy']);
    Route::post('/kriteria/{id}/update', [KriteriaController::class, 'update']);

    Route::resource('aturan', AturanController::class)->except(['destroy', 'update']);
    Route::get('/aturan/{id}/destroy', [AturanController::class, 'destroy']);
    Route::post('/aturan/{id}/update', [AturanController::class, 'update']);
});
// Route::get('/', [AdminController::class, 'index']);


//AUTH

Route::get('/auth', [AuthController::class, 'index'])->name('auth')->middleware('guest');
Route::post('/auth', [AuthController::class, 'auth_login']);
Route::get('/register', [AuthController::class, 'registrasi'])->name('register')->middleware('guest');

Route::post('/register', [AuthController::class, 'auth_regist'])->name('register');

// Route::get('/tes', [AdminController::class, 'tes']);
