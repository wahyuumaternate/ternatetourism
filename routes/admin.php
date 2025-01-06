<?php
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\MediaController;
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

    //
    Route::get('/foto', [MediaController::class, 'index'])->name('media.index');
    Route::get('/vidio', [MediaController::class, 'indexVidio'])->name('indexVidio.index');
    Route::post('/foto', [MediaController::class, 'store'])->name('media.store');
    Route::put('/foto/{media}', [MediaController::class, 'update'])->name('media.update');
    Route::delete('/foto/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
    // 
    Route::get('ebooks', [EbookController::class, 'index'])->name('ebooks.index'); // Halaman daftar e-book
    Route::post('ebooks', [EbookController::class, 'store'])->name('ebooks.store'); // Tambah e-book
    Route::put('ebooks/{kode_buku}', [EbookController::class, 'update'])->name('ebooks.update'); // Update e-book
    Route::delete('ebooks/{kode_buku}', [EbookController::class, 'destroy'])->name('ebooks.destroy'); // Hapus e-book
    Route::get('ebooks/{kode_buku}', [EbookController::class, 'show'])->name('ebooks.show');
    Route::get('media', [MediaController::class, 'manajemen'])->name('manajemen.media.index'); // Halaman daftar e-book
    // 
    Route::resource('destinations', DestinationController::class)->parameters([
        'destinations' => 'destination:slug',
    ]);;

});
