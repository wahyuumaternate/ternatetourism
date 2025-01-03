<?php
use App\Http\Controllers\BeritaController;
use Illuminate\Support\Facades\Route;



Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::resource('berita', BeritaController::class);
});
