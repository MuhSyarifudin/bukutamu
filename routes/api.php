<?php

use App\Http\Controllers\Api\AcaraApiController;
use App\Http\Controllers\Api\PengunjungApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('pengunjung/json/{id}',[PengunjungApiController::class,'index'])->name('pengunjung.index.json');
Route::post('pengunjung/post-json',[PengunjungApiController::class,'store'])->name('pengunjung.store.json');
Route::get('pengunjung/show/{id}', [PengunjungApiController::class, 'edit'])->name('pengunjung.edit');
Route::put('pengunjung/update-json',[PengunjungApiController::class,'update'])->name('pengunjung.update.json');
Route::delete('pengunjung/delete-json/{id}',[PengunjungApiController::class,'destroy'])->name('pengunjung.delete.json');

Route::get('acara/json',[AcaraApiController::class,'index'])->name('acara.index.json');
Route::post('acara/post-json',[AcaraApiController::class,'store'])->name('acara.store.json');
Route::get('acara/show/{id}',[AcaraApiController::class,'edit'])->name('acara.edit');
Route::delete('acara/delete-json/{id}',[AcaraApiController::class,'destroy'])->name('acara.delete.json');
Route::put('acara/update-json',[AcaraApiController::class,'update'])->name('acara.update.json');