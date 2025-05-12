<?php

use App\Http\Controllers\AcaraController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('pengunjung',[PengunjungController::class,'index'])->name('pengunjung.index');
Route::get('pengunjung/v',[PengunjungController::class,'index2'])->name('tampilkan.pengunjung');

Route::get('acara',[AcaraController::class,'index'])->name('acara.index');

Route::get('barang',[BarangController::class,'index'])->name('barang.index');
Route::get('barang/v',[BarangController::class,'index2'])->name('tampilkan.barang');

Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('exportpengunjung/{acara_id}',[ExportController::class,'export_pengunjung'])->name('export.pengunjung');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
