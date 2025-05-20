<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KecamatanController;


Route::get('/', function () {
    return view('admin_views.dashboard');
});

Route::prefix("kecamatan")->group(function () {
    Route::get('/', [KecamatanController::class, 'index'])->name('welcome');
    Route::get('/create', [KecamatanController::class, 'create'])->name('kecamatan.create');
    Route::post('/store', [KecamatanController::class, 'store'])->name('kecamatan.store');
});
