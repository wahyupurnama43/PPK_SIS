<?php

use App\Http\Controllers\PendudukController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\WilayahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/wilayah', [WilayahController::class, 'getWilayah'])->name('api.wilayah');
Route::get('/notify', [SuratController::class, 'notify'])->name('api.notify');
Route::post('/kk', [PendudukController::class, 'getKK'])->name('api.kk');
Route::post('/nik', [PendudukController::class, 'getNik'])->name('api.nik');
Route::post('/akta-kawin', [PendudukController::class, 'getAktaKawin'])->name('api.aktaKawin');
