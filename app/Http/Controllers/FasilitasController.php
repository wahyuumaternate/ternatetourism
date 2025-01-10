<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FasilitasController extends Controller
{
   public function index()
   {
       $fasilitas = Fasilitas::latest()->get();
       $kategori = 'Semua';
       return view('admin.fasilitas.index', compact('fasilitas','kategori'));
   }
    // public function kategori(Fasilitas $fasilitas)
    // {
    //     dd($fasilitas);
    //     // $query = Fasilitas::where('kategori', $fasilitas->kategori)->latest();
    //     // $query = Fasilitas::latest();
        
    //     // if ($fasilitas->kategori && $fasilitas->kategori !== 'all') {
    //     //     $query->where('kategori', $fasilitas->kategori);
    //     // }

    //     // $fasilitas = $query->get();
    //     if ( $fasilitas) {
    //         $fasilitas = Fasilitas::where('kategori', $fasilitas->kategori)->latest()->get();
    //         # code...
           
    //     }else{
    //         notify()->error('Fasilitas Belum Ada');
    //         return back();
    //     }
    //     return view('admin.fasilitas.index', compact('fasilitas'));
    // }
    public function kategori($kategori = null)
{
    $query = Fasilitas::latest();
    
    if ($kategori && $kategori !== 'all') {
        $query->where('kategori', $kategori);
    }

    $fasilitas = $query->paginate(10);
    return view('admin.fasilitas.index', compact('fasilitas','kategori'));
}

   public function create()
   {
       return view('admin.fasilitas.create_update');
   }

   public function store(Request $request)
   {
       $request->validate([
           'name' => 'required|max:255',
           'gambar' => 'required',
           'deskripsi' => 'required',
           'kategori' => 'required|in:hotel,travel,cafe-restorant,umkm,guide,rent-car'
       ]);

       Fasilitas::create([
           'name' => $request->name,
           'slug' => Str::slug($request->name),
           'gambar' => $request->gambar,
           'deskripsi' => $request->deskripsi,
           'kategori' => $request->kategori
       ]);

       notify()->success('Fasilitas berhasil ditambahkan');
       return redirect()->route('fasilitas.index');
   }

   public function show(Fasilitas $fasilitas)
   {
       return view('admin.fasilitas.index', compact('fasilitas'));
   }

   public function edit(Fasilitas $fasilitas)
   {
       return view('admin.fasilitas.create_update', compact('fasilitas'));
   }

   public function update(Request $request, Fasilitas $fasilitas)
   {
       $request->validate([
           'name' => 'required|max:255',
           'gambar' => 'required',
           'deskripsi' => 'required',
           'kategori' => 'required|in:hotel,travel,cafe-restorant,umkm,guide,rent-car'
       ]);

       $fasilitas->update([
           'name' => $request->name,
           'slug' => Str::slug($request->name),
           'gambar' => $request->gambar,
           'deskripsi' => $request->deskripsi,
           'kategori' => $request->kategori
       ]);

       notify()->success('Fasilitas berhasil diperbarui');
       return redirect()->back();
   }

   public function destroy(Fasilitas $fasilitas)
   {
       $fasilitas->delete();
       notify()->success('Fasilitas berhasil dihapus');
       return redirect()->back();
   }

   public function front($kategori = null)
   {
       $query = Fasilitas::latest();
       
       if ($kategori && $kategori !== 'all') {
           $query->where('kategori', $kategori);
       }
   
       $facilities = $query->get();
    
       return view('frontend.fasilitas', compact('facilities'));
   }
   public function detail($slug)
{
    $facility = Fasilitas::where('slug', $slug)->firstOrFail();
    return view('frontend.fasilitas_detail', compact('facility'));
}
}