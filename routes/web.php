<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\Admin\ProfileController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile/{id}', ProfileController::class,)->name('profile');

Route::middleware('auth', 'role:admin')->prefix('admin')->group(function () {
    // Route::resource('/pendaftaran', PasienController::class);
    Route::resource('/users', UserController::class)->except('create', 'edit');
    Route::resource('/roles', RoleController::class)->except('create', 'edit');
});
Route::middleware('auth', 'role:pendaftaran,admin')->group(function () {
    Route::resource('/pendaftaran', PasienController::class);
    route::get('/periksa/{id}', [PasienController::class, 'periksa'])->name('pendaftaran.periksa');
});
Route::middleware('auth', 'role:poli,admin')->prefix('kunjungan')->group(function () {
    route::get('/periksa', [KunjunganController::class, 'index'])->name('kunjungan.index');
    route::get('/periksa/{id}/edit', [KunjunganController::class, 'edit'])->name('kunjungan.edit');
    Route::put('/periksa/{id}', [KunjunganController::class, 'update'])->name('kunjungan.update');
    Route::delete('/periksa/{id}', [KunjunganController::class, 'destroy'])->name('kunjungan.destroy');
    route::get('/rekammedis', [RekamMedisController::class, 'index'])->name('rekammedis.index');
    route::get('/registrasi', [RekamMedisController::class, 'registrasi'])->name('rekammedis.registrasi');
    route::get('/rekammedis/penyakit_terbesar', [RekamMedisController::class, 'diagnosa'])->name('rekammedis.penyakit_terbesar');
    route::get('/rekammedis/lb-1', [RekamMedisController::class, 'lb_1'])->name('rekammedis.lb_1');
    route::get('/rekammedis/{id}', [RekamMedisController::class, 'rekamMedisDetail'])->name('rekammedis.detail');
    // Route::resource('/pendaftaran', PasienController::class);
    // route::get('/periksa/{id}', [PasienController::class, 'periksa'])->name('pendaftaran.periksa');
});
