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

    public function show(Ekraf $ekraf)
    {
        return view('ekrafs.show', compact('ekraf'));
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
}