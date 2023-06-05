<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\kriteriaController;
use App\Http\Controllers\SubController;
use App\Http\Controllers\DokumentController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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


// Route::get('', function () {
//     return view('login');
// });

Route::get('', function () {
    return view('beranda');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'auth'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->middleware(['auth']);



Route::get('/', [BerandaController::class, 'index'])->middleware('auth');
Route::get('/beranda', [BerandaController::class, 'index'])->middleware('auth');

Route::get('/informasi', [InformasiController::class, 'index'])->middleware('auth');

Route::get('/kriteria', [KriteriaController::class, 'index'])->middleware('auth');
Route::get('/kriteria-add', [KriteriaController::class, 'create'])->middleware(['auth', 'must-admin-or-pic']);
Route::post('/kriteria', [KriteriaController::class, 'store'])->middleware(['auth', 'must-admin-or-pic']);
Route::put('/kriteria-edit/{id}', [KriteriaController::class, 'edit'])->middleware(['auth', 'must-admin-or-pic']);
Route::put('/kriteria/{id}', [KriteriaController::class, 'update'])->middleware(['auth', 'must-admin-or-pic']);
Route::get('/kriteria-delete/{id}', [KriteriaController::class, 'delete'])->middleware(['auth', 'must-admin-or-pic']);
Route::delete('/kriteria-destroy/{id}', [KriteriaController::class, 'destroy'])->middleware(['auth', 'must-admin']);

Route::get('/sub', [SubController::class, 'index'])->middleware('auth');
Route::get('/sub-add', [SubController::class, 'create'])->middleware(['auth', 'must-admin-or-pic']);
Route::post('/sub', [SubController::class, 'store'])->middleware(['auth', 'must-admin-or-pic']);
Route::put('/sub-edit/{id}', [SubController::class, 'edit'])->middleware(['auth', 'must-admin-or-pic']);
Route::put('/sub/{id}', [SubController::class, 'update'])->middleware(['auth', 'must-admin-or-pic']);
Route::get('/sub-delete/{id}', [SubController::class, 'delete'])->middleware(['auth', 'must-admin-or-pic']);
Route::delete('/sub-destroy/{id}', [SubController::class, 'destroy'])->middleware(['auth', 'must-admin-or-pic']);

Route::get('/dokument', [DokumentController::class, 'index'])->middleware('auth');
Route::get('/dokument/{id}', [DokumentController::class, 'show'])->middleware(['auth', 'must-admin-or-pic']);
Route::get('/dokument-add', [DokumentController::class, 'create'])->middleware(['auth', 'must-admin-or-pic']);
Route::post('/dokument', [DokumentController::class, 'store'])->middleware(['auth', 'must-admin-or-pic']);
Route::put('/dokument-edit/{id}', [DokumentController::class, 'edit'])->middleware(['auth', 'must-admin-or-pic']);
Route::put('/dokument/{id}', [DokumentController::class, 'update'])->middleware(['auth', 'must-admin-or-pic']);
Route::get('/dokument-delete/{id}', [DokumentController::class, 'delete'])->middleware(['auth', 'must-admin-or-pic']);
Route::delete('/dokument-destroy/{id}', [DokumentController::class, 'destroy'])->middleware(['auth', 'must-admin-or-pic']);
