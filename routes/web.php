<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\EkrafController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StrukturDanVisiController;
use App\Models\Visitor;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', [FrontendController::class, 'index']);
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

// foto
Route::get('/gallery', [MediaController::class, 'frontFoto'])->name('frontFoto');
Route::get('/video', [MediaController::class, 'frontVideo'])->name('frontVideo');
Route::get('language/{lang}', [FrontendController::class, 'switchLang'])->name('lang.switch');
// // ebook
// Route::get('/ebooks', [EbookController::class, 'front'])->name('ebooks.front');
// Route::get('/ebooks/{kode_buku}', [EbookController::class, 'detail'])->name('ebooks.detail');
// Route::get('/ebooks/{kode_buku}/read', [EbookController::class, 'read'])->name('ebooks.read');
// Route::get('/ebooks/{kode_buku}/download', [EbookController::class, 'download'])->name('ebooks.download');
// fasilitas
Route::get('/fasilitas/{kategori}', [FasilitasController::class, 'front'])->name('fasilitas.front');
Route::get('/fasilitas/detail/{slug}', [FasilitasController::class, 'detail'])->name('fasilitas.detail');

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Route::get('/dashboard', function () {
//     return view('admin.index');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', function () {
    $visitorCount = Visitor::when(request('period'), function($query, $period) {
        return match($period) {
            'today' => $query->whereDate('created_at', today()),
            'month' => $query->whereMonth('created_at', now()->month),
            'year' => $query->whereYear('created_at', now()->year),
            default => $query->whereDate('created_at', today())
        };
    })->count();
 
    return view('admin.index', compact('visitorCount'));
 })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/migrate-seed', function () {
    Artisan::call('migrate:fresh --seed');
    return "Migration and seeding completed successfully!";
    });
    
// Route::get('/ebook', function () {
//     return view('frontend.ebook');
// });
// Route::get('/ebook-detail', function () {
//     return view('frontend.detail_ebook');
// });
        

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';