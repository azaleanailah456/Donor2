<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DarahController;
use App\Http\Controllers\ResponseController;


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

Route::get('/', [DarahController::class, 'index'])->name('home');

Route::get('login', function () {
    return view('login');
})->name('login');

Route::post('store', [DarahController::class, 'store'])->name('store');
Route::post('/auth', [DarahController::class, 'auth'])->name('auth');
Route::delete('delete/{id}', [DarahController::class, 'destroy'])->name('delete');

Route::middleware(['isLogin', 'CekRole:petugas'])->group(function() {
    Route::get('/data/petugas', [DarahController::class, 'dataPetugas'])->name('data.petugas');
    Route::delete('delete/{id}', [DarahController::class, 'destroy'])->name('delete');
    Route::get('/response/edit/{darah_id}', [ResponseController::class, 'edit'])->name('response.edit');
    Route::patch('/response/update/{darah_id}', [ResponseController::class, 'update'])->name('response.update');
});

Route::middleware(['isLogin', 'CekRole:admin,petugas'])->group(function() {
    Route::get('logout', [DarahController::class, 'logout'])->name('logout');
});

Route::middleware('isLogin', 'CekRole:admin')->group(function() {
    Route::get('data', [DarahController::class, 'data'])->name('data');
    Route::get('/export/pdf', [DarahController::class, 'exportPDF'])->name('export.pdf');
    Route::get('/created/pdf/{id}', [DarahController::class, 'createdPDF'])->name('created.pdf');
    Route::get('/export/excel', [DarahController::class, 'exportExcel'])->name('export.excel');
});
