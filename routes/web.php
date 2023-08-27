<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\AlternatifController;
use App\Http\Controllers\Admin\AtributPenilaianController;



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


Route::get('/', [AdminController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::group(['middleware' => ['auth', 'cekLogin:admin']], function () {


    Route::resource('kriteria', KriteriaController::class)->except(['destroy', 'update']);
    Route::get('/kriteria/{id}/destroy', [KriteriaController::class, 'destroy']);
    Route::post('/kriteria/{id}/update', [KriteriaController::class, 'update']);

    Route::resource('toko', AlternatifController::class)->except(['destroy', 'update']);
    Route::get('/toko/{id}/destroy', [AlternatifController::class, 'destroy']);
    Route::post('/toko/{id}/update', [AlternatifController::class, 'update']);

    Route::get('/atribut_penilaian/{id}', [AtributPenilaianController::class, 'index'])->name('atribut_penilaian.index');
    Route::get('/atribut_penilaian/{id}/show', [AtributPenilaianController::class, 'show'])->name('atribut_penilaian.show');
    Route::get('/atribut_penilaian/{id}/create', [AtributPenilaianController::class, 'create'])->name('atribut_penilaian.create');
    Route::get('/atribut_penilaian/{id}/edit', [AtributPenilaianController::class, 'edit'])->name('atribut_penilaian.edit');
    Route::get('/atribut_penilaian/{id}/destroy', [AtributPenilaianController::class, 'destroy'])->name('atribut_penilaian.destroy');

    Route::post('/atribut_penilaian/{id}/update', [AtributPenilaianController::class, 'update'])->name('atribut_penilaian.update');
    Route::post('/atribut_penilaian/{id}/store', [AtributPenilaianController::class, 'store'])->name('atribut_penilaian.store');
    Route::get('/atribut_penilaian/{id}', [AtributPenilaianController::class, 'index'])->name('atribut_penilaian.index');

    Route::post('/penilaian/destroy/{id}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');


    Route::get('/bobot_kriteria', [KriteriaController::class, 'bobot_kriteria'])->name('bobot_kriteria.index');
    Route::post('/hitungbobot', [KriteriaController::class, 'hitungbobot'])->name('hitungbobot');
});



Route::group(['middleware' => ['auth', 'cekLogin:admin,user']], function () {

    Route::get('/penilaian/show/{id}', [PenilaianController::class, 'show'])->name('penilaian.show');
    Route::get('/penilaian/edit/{id}', [PenilaianController::class, 'edit'])->name('penilaian.edit');
    Route::post('/penilaian/store', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::get('/penilaian/filter', [PenilaianController::class, 'filter'])->name('penilaian.filter');
    Route::get('/penilaian/create', [PenilaianController::class, 'create'])->name('penilaian.create');
});






//AUTH

Route::get('/auth', [AuthController::class, 'index'])->name('auth')->middleware('guest');
Route::post('/auth', [AuthController::class, 'auth_login']);

// Route::get('/tes', [AdminController::class, 'tes']);
