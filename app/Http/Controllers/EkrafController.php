<?php
// app/Http/Controllers/EkrafController.php
namespace App\Http\Controllers;

use App\Models\Ekraf;
use App\Models\EkrafCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkrafController extends Controller
{
    public function index()
    {
        $ekrafs = Ekraf::with('category')->get();
        return view('admin.ekraf.index', compact('ekrafs'));
    }

    public function create()
    {
        $categories = EkrafCategories::all();
        return view('admin.ekraf.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:ekraf_categories,id',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'social_media' => 'nullable|string',
            'jumlah_produk' => 'required|string'
        ]);

        if ($request->has('logo')) {
            $validated['logo'] = $request->logo;
        }

        Ekraf::create($validated);
        
        notify()->success('EKRAF berhasil ditambahkan');
       return redirect()->route('ekrafs.index');
    }

    public function show($slug)
    {
        // Mencari ekraf berdasarkan slug
        $ekraf = Ekraf::where('slug', $slug)->firstOrFail();

        return view('frontend.detail_ekraf', compact('ekraf'));
    }

    public function edit(Ekraf $ekraf)
    {
        $categories = EkrafCategories::all();
        return view('admin.ekraf.edit', compact('ekraf', 'categories'));
    }

    public function update(Request $request, Ekraf $ekraf)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:ekraf_categories,id',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'social_media' => 'nullable|string',
            'jumlah_produk' => 'required|string'
        ]);

        if ($request->has('logo')) {
           
            $validated['logo'] = $request->logo;
        }

        $ekraf->update($validated);
        
        notify()->success('EKRAF berhasil diperbarui');
        return redirect()->route('ekrafs.index');
    }

    public function destroy(Ekraf $ekraf)
    {
        if ($ekraf->logo) {
            Storage::disk('public')->delete($ekraf->logo);
        }
        
        $ekraf->delete();
        
        notify()->success('EKRAF berhasil dihapus');
        return redirect()->route('ekrafs.index');
    }

    public function front()
    {
        $totalEkraf = Ekraf::count();
        $allCategories = EkrafCategories::withCount('ekraf')->get();
        $ekrafs = Ekraf::with('category')->paginate(12);
    
        return view('frontend.ekraf', compact(
            'totalEkraf',
            'allCategories',
            'ekrafs'
        ));
    }
    
    public function filterByCategory($categorySlug)
{
    // Cari kategori berdasarkan slug
    $category = EkrafCategories::where('slug', $categorySlug)->first();

    // Jika kategori tidak ditemukan, kembalikan ke halaman utama dengan pesan error
    if (!$category) {
        return redirect()->route('ekraf.index')->with('error', 'Kategori tidak ditemukan.');
    }

    // Ambil data ekraf berdasarkan kategori
    $ekrafs = Ekraf::where('category_id', $category->id)->paginate(10);

    // Kembalikan ke view dengan data yang difilter
    return view('frontend.ekraf', [
        'ekrafs' => $ekrafs,
        'category' => $category,
        'allCategories' => EkrafCategories::withCount('ekrafs')->get(), // Semua kategori untuk sidebar/filter
    ]);
}


    public function category($slug)
    {
        $category = EkrafCategories::where('slug', $slug)->firstOrFail();
        $totalEkraf = Ekraf::count();
        $allCategories = EkrafCategories::withCount('ekraf')->get();
        $ekrafs = Ekraf::with('category')
            ->where('category_id', $category->id)
            ->paginate(12);
    
        return view('frontend.ekraf', compact(
            'category',
            'totalEkraf',
            'allCategories',
            'ekrafs'
        ));
    }

    public function search(Request $request)
{
    $query = $request->input('query');

    // Lakukan pencarian berdasarkan nama ekraf atau kategori
    $ekrafs = Ekraf::where('name', 'like', "%$query%")
                ->orWhereHas('category', function ($q) use ($query) {
                    $q->where('name', 'like', "%$query%");
                })
                ->with('category')
                ->get();

    return response()->json([
        'data' => $ekrafs
    ]);
}

}