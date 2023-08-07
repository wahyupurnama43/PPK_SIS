<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KadusController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\AktaKawinController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

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

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::prefix('admin')->group(function () {
        Route::resource('wilayah', WilayahController::class);
        Route::resource('penduduk', PendudukController::class);
        Route::resource('akta-kawin', AktaKawinController::class);
        Route::resource('keluarga', KeluargaController::class);
        Route::resource('jabatan', JabatanController::class);
        Route::resource('kadus', KadusController::class);
        Route::resource('pengguna', UserController::class);
    });

    Route::name('surat.')->group(function () {
        Route::get('/surat', [SuratController::class, 'index'])->name('index');
        Route::get('/surat/{slug}', [SuratController::class, 'surat'])->name('create');
    });
});

Auth::routes();
