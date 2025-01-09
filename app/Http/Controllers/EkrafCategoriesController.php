<?php
// app/Http/Controllers/EkrafCategoriesController.php
namespace App\Http\Controllers;

use App\Models\EkrafCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EkrafCategoriesController extends Controller
{
    public function index()
    {
        $categories = EkrafCategories::all();
        return view('admin.ekraf.ekraf_category', compact('categories'));
    }

    public function create()
    {
        return view('ekraf-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        EkrafCategories::create($validated);
        
           
        notify()->success('Kategori berhasil ditambahkan');
        return redirect()->route('ekraf-categories.index');
    }

    public function show(EkrafCategories $ekrafCategory)
    {
        return view('ekraf-categories.show', compact('category'));
    }

    public function edit(EkrafCategories $ekrafCategory)
    {
        return view('ekraf-categories.edit', compact('category'));
    }

    public function update(Request $request, EkrafCategories $ekrafCategory)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $ekrafCategory->update($validated);
        
           
        notify()->success('Kategori berhasil diperbarui');
        return redirect()->route('ekraf-categories.index');
    }

    public function destroy(EkrafCategories $ekrafCategory)
    {
        $ekrafCategory->delete();
        notify()->success('Kategori berhasil dihapus');
        return redirect()->route('ekraf-categories.index');
    }
}