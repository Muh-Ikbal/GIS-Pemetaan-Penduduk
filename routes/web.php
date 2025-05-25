<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DataPendudukController;


Route::get('/', function () {
    return view('admin_views.dashboard');
})->name('admin.dashboard');

Route::get('/home', function () {
    return view("user_views.home");
});

Route::prefix("kecamatan")->group(function () {
    Route::get('/', [KecamatanController::class, 'index'])->name('kecamatan');
    Route::get('/create', [KecamatanController::class, 'create'])->name('kecamatan.create');
    Route::post('/store', [KecamatanController::class, 'store'])->name('kecamatan.store');
    Route::get('/edit/{id}', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
    Route::put('/update/{id}', [KecamatanController::class, 'update'])->name('kecamatan.update');
    Route::get('/delete/{id}', [KecamatanController::class, 'delete'])->name('kecamatan.delete');
});

Route::prefix("data-penduduk")->group(function (){
    Route::get('/', [DataPendudukController::class, 'index'])->name('data-penduduk.index');
    Route::get('/create', [DataPendudukController::class, 'create'])->name('data-penduduk.create');
    Route::post('/store', [DataPendudukController::class, 'store'])->name('data-penduduk.store');
    Route::get('/edit/{id}', [DataPendudukController::class, 'edit'])->name('data-penduduk.edit');
    Route::put('/update/{id}', [DataPendudukController::class, 'update'])->name('data-penduduk.update');
    Route::get('/delete/{id}', [DataPendudukController::class, 'delete'])->name('data-penduduk.delete');
});
