<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EkrafController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StrukturDanVisiController;
use App\Models\Berita;
use App\Models\Destination;
use App\Models\Media;
use App\Models\StrukturDanVisi;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {

    return view('frontend.index',[
        'destinasi'=>Destination::latest()->get(),
        'galeri'=>Media::where('type','photo')->latest()->get(),
        'video'=>Media::where('type','video')->latest()->get(),
        'berita'=>Berita::orderBy('created_at', 'desc')->get(),
    ]);
});

// Route::get('/visi-misi', function () {
//     return view('frontend.visi_misi',[
//         'visi_misi'=>StrukturDanVisi::where('slug','visi-misi')->first(),
//     ]);
// });
Route::get('/profil/{slug}', [StrukturDanVisiController::class, 'profil'])->name('profil');

Route::get('/destinasi/{slug}', [DestinationController::class, 'front'])->name('destinasi.show');
Route::get('/berita/{slug}', [BeritaController::class, 'front'])->name('berita.detail');
Route::get('/destinasi', [DestinationController::class, 'all'])->name('destinasi.all');
Route::get('/events', [EventsController::class, 'all'])->name('events.all');
Route::get('/berita', [BeritaController::class, 'all'])->name('berita.all');
// Rute untuk halaman detail acara menggunakan slug
Route::get('/event/{slug}', [EventsController::class, 'detail'])->name('event.detail');

Route::get('/ekraf', [EkrafController::class, 'front'])->name('ekraf.index');
Route::get('/ekraf/category/{slug}', [EkrafController::class, 'category'])->name('ekraf.category');
Route::get('/ekraf/search', [EkrafController::class, 'search'])->name('ekraf.search');
Route::get('/ekraf/category/{category}', [EkrafController::class, 'filterByCategory'])->name('ekraf.filterByCategory');
Route::get('/ekraf/{slug}', [EkrafController::class, 'show'])->name('ekraf.show');


Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';