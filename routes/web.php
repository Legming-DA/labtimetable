<?php

use App\Http\Controllers\AsistenController;
use App\Http\Controllers\CobaMetodeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HariController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KetersediaanController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PenjadwalanController;
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

// Route::get('/', function () {
//     return view('dashboard');
// });
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/konfigurasi', function () {
    return view('konfigurasi.konfigurasi');
});

Route::get('/generate', function () {
    return view('generate.generate');
});

Route::get('/login', function () {
    return view('login');
});

// Route::get('/tersedia', function () {
//     return view('ketersediaan.ketersediaan');
// });

// Route::get('/kelas', function () {
//     return view('kelas.kelas');
// });

// Route::get('/hari', function () {
//     return view('hari.hari');
// });

// Route::get('/jadwal', function () {
//         return view('penjadwalan');
//     });

// Route::get('/penjadwalan', [PenjadwalanController::class, 'index']);
Route::match(['get', 'post'], '/penjadwalan', [PenjadwalanController::class, 'index'])->name('generate.new.solution');


Route::resource('asisten', AsistenController::class);
Route::resource('kelasprak', KelasController::class);
Route::resource('hari', HariController::class);
Route::resource('ketersediaan', KetersediaanController::class);
// Route::resource('konfigurasi', KonfigurasiController::class);
// Route::get('/konfigurasi/{id}/edit', [KonfigurasiController::class, 'edit'])->name('konfigurasi.edit');
// Route::put('/konfigurasi/{id}', [KonfigurasiController::class, 'update'])->name('konfigurasi.update');
Route::get('/konfigurasi', [KonfigurasiController::class, 'index'])->name('konfigurasi');
Route::post('/konfigurasi', [KonfigurasiController::class, 'store'])->name('konfigurasi.store');

// Route::match(['get', 'post'], '/coba', [CobaMetodeController::class, 'index'])->name('generate.new.solusi');
Route::get('/coba', [CobaMetodeController::class, 'scheduleAssistants']);
Route::get('/jadwal', [CobaMetodeController::class, 'jadwalAsisten']);