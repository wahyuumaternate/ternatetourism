<?php
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\StrukturDanVisiController;
use Illuminate\Support\Facades\Route;



Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::resource('berita', BeritaController::class);
    Route::resource('events', EventsController::class);

    // 
    Route::get('/visi-misi', [StrukturDanVisiController::class, 'visimisi'])->name('visimisi.index');
    Route::put('/visi-misi', [StrukturDanVisiController::class, 'visimisiUpdate'])->name('visimisi.update');
    Route::get('/struktur-organisasi', [StrukturDanVisiController::class, 'struktur'])->name('struktur.index');
    Route::put('/struktur-organisasi', [StrukturDanVisiController::class, 'strukturUpdate'])->name('struktur.update');
});
