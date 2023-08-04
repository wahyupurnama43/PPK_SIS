<?php

use App\Http\Controllers\PendudukController;
use App\Http\Controllers\WilayahController;
use App\Models\Wilayah;
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
Route::post('/kk', [PendudukController::class, 'getKK'])->name('api.kk');
Route::post('/akta-kawin', [PendudukController::class, 'getAktaKawin'])->name('api.aktaKawin');
