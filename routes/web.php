<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SparepartController;
use App\Http\Controllers\Admin\JasaController;
use App\Http\Controllers\Admin\DiagnosaController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\KonsumenController;
use App\Http\Controllers\Admin\RekamServisController;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data (Eksklusif Admin)
    Route::resource('sparepart', SparepartController::class);
    Route::resource('jasa', JasaController::class);
    Route::resource('diagnosa', DiagnosaController::class);

    // Operasional (Konsumen & Rekam Servis)
    Route::resource('konsumen', KonsumenController::class);
    Route::resource('rekam-servis', RekamServisController::class);
    Route::get('/rekam-servis/{id}/koreksi', [RekamServisController::class, 'formKoreksi'])->name('rekam-servis.koreksi-form');
    Route::post('/rekam-servis/{id}/koreksi', [RekamServisController::class, 'simpanKoreksi'])->name('rekam-servis.koreksi');
    Route::get('/rekam-servis/{id}/nota', [RekamServisController::class, 'cetakNota'])->name('rekam-servis.nota');

    // Laporan Keuangan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});
