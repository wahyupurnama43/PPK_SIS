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
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.updatePassword');
    Route::middleware(['jabatan:admin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::resource('wilayah', WilayahController::class);
            Route::resource('penduduk', PendudukController::class);
            Route::resource('akta-kawin', AktaKawinController::class);
            Route::resource('keluarga', KeluargaController::class);
            Route::resource('jabatan', JabatanController::class);
            Route::resource('kadus', KadusController::class);
            Route::resource('pengguna', UserController::class);
            Route::get('export', [PendudukController::class, 'export'])->name('export');
            Route::post('import', [PendudukController::class, 'import'])->name('import');
        });
    });


    Route::middleware(['jabatan:admin,perbekel desa,kelian banjar dinas,staf,sekretaris'])->group(function () {
        Route::get('list/surat', [SuratController::class, 'Adminlist'])->name('surat.Adminlist');
        Route::prefix('admin')->group(function () {
            Route::get('/verif/{id}/{aktor}', [SuratController::class, 'verif'])->name('surat.verif');
            Route::get('/surat', [SuratController::class, 'suratAdmin'])->name('admin.suratAdmin');
            Route::get('/surat/list', [SuratController::class, 'list'])->name('admin.list');
            Route::post('/surat/{slug}', [SuratController::class, 'storeSuratAdmin'])->name('admin.storeSuratAdmin');
            Route::get('/pengguna', [UserController::class, 'index'])->name('pengguna.index');
            Route::post('/pengguna/verif/{id}', [UserController::class, 'verif'])->name('pengguna.verif');
        });
    });
    Route::middleware(['jabatan:masyarakat'])->group(function () {
        Route::name('surat.')->group(function () {
            Route::get('/surat', [SuratController::class, 'index'])->name('index');
            Route::post('/surat', [SuratController::class, 'index'])->name('update');
            Route::get('/surat/list', [SuratController::class, 'list'])->name('list');
            // Route::get('/preview/{slug}', [SuratController::class, 'preview'])->name('preview');
            Route::post('/surat/{slug}', [SuratController::class, 'surat'])->name('create');
        });
    });
});

Auth::routes();
