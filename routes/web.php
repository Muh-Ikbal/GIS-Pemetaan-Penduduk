<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DataPendudukController;
use App\Http\Controllers\UserViewController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\File;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::get('/', function () {
//     return view('admin_views.dashboard');
// })->name('admin.dashboard');


Route::prefix("admin")->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix("kecamatan")->group(function () {
        Route::get('/', [KecamatanController::class, 'index'])->name('kecamatan');
        Route::get('/create', [KecamatanController::class, 'create'])->name('kecamatan.create');
        Route::post('/store', [KecamatanController::class, 'store'])->name('kecamatan.store');
        Route::get('/edit/{id}', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
        Route::put('/update/{id}', [KecamatanController::class, 'update'])->name('kecamatan.update');
        Route::get('/delete/{id}', [KecamatanController::class, 'delete'])->name('kecamatan.delete');
    });

    Route::prefix("data-penduduk")->group(function () {
        Route::get('/', [DataPendudukController::class, 'index'])->name('data-penduduk.index');
        Route::get('/create', [DataPendudukController::class, 'create'])->name('data-penduduk.create');
        Route::post('/store', [DataPendudukController::class, 'store'])->name('data-penduduk.store');
        Route::get('/edit/{id}', [DataPendudukController::class, 'edit'])->name('data-penduduk.edit');
        Route::put('/update/{id}', [DataPendudukController::class, 'update'])->name('data-penduduk.update');
        Route::get('/delete/{id}', [DataPendudukController::class, 'delete'])->name('data-penduduk.delete');
    });
    Route::prefix("chart")->group(function () {
        Route::get('/penduduk', [DashboardController::class, 'chartPenduduk'])->name('chart.penduduk');
    });
});

Route::prefix("data")->group(function () {
    Route::get("data-penduduk", [UserViewController::class, 'getDataPenduduk'])->name('api.data-penduduk');
    Route::get("data-kecamatan", [UserViewController::class, 'getDataKecamatan'])->name('api.data-kecamatan');
    Route::get("kecamatan/{id}", [UserViewController::class, 'laporan'])->name('api.laporan-kecamatan');
});

// Route::get('storage/geojson/{filename}', function ($filename) {
//     $path = storage_path('app/public/geojson' . $filename);

//     if (!File::exists($path)) abort(404);

//     return response()->file($path);
// });
// Route::get('storage/kecamatan/{filename}', function ($filename) {
//     $path = storage_path('app/public/kecamatan' . $filename);

//     if (!File::exists($path)) {
//         abort(404);
//     }

//     return response()->file($path);
// });


Route::get("/{any?}", function () {
    return view("user_views.app");
})->where("any", '^(?!data|admin|storage|chart|admin_assets|images).*$');
require __DIR__ . '/auth.php';
