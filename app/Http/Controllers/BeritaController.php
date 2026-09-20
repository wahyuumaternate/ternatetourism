<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BeritaController extends Controller
{
    // Menampilkan semua berita
    public function index()
    {
        $berita = Berita::orderBy('created_at', 'desc')->get();

        return view('admin.publikasi.berita', compact('berita')); // Menampilkan daftar berita
    }

    public function create()
    {
        return view('admin.publikasi.berita_create'); // Menampilkan daftar berita
    }

    // Menampilkan detail berita berdasarkan ID
    public function show($id)
    {
        $berita = Berita::find($id);

        if (! $berita) {
            return redirect()->route('berita.index')->with('error', 'Berita tidak ditemukan');
        }

        return view('berita.show', compact('berita')); // Menampilkan detail berita
    }

    // Menyimpan berita baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:berita,slug',
            'content' => 'required',
            'image' => 'required|string',
            'excerpt' => 'nullable|string|max:255',
        ]);

        $excerpt = $request->excerpt ?? substr(strip_tags($request->content), 0, 150);

        Berita::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'image' => $request->image,
            'excerpt' => $excerpt,
            'views' => 0,
            'user_id' => auth()->id(),
        ]);

        notify()->success('Berita berhasil ditambahkan');

        return redirect()->route('berita.index');
    }

    // Menampilkan form untuk mengedit berita
    public function edit($id)
    {
        $berita = Berita::find($id);

        if (! $berita) {
            return redirect()->route('berita.index')->with('error', 'Berita tidak ditemukan');
        }

        return view('admin.publikasi.berita_edit', compact('berita')); // Menampilkan form edit berita
    }

    // Memperbarui berita
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        // dd($berita->id);
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('berita', 'slug')->ignore($id), // Abaikan slug milik record yang sedang diedit
            ],
            'content' => 'sometimes|required',
            'image' => 'sometimes|required|string',
            'excerpt' => 'sometimes|nullable|string|max:255',
        ]);

        // Tetap gunakan slug lama jika tidak ada perubahan
        $slug = $request->slug ?? $berita->slug;

        // Update excerpt jika tidak ada input
        $excerpt = $request->excerpt ?? substr(strip_tags($request->content), 0, 150);

        $berita->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $request->image,
            'excerpt' => $excerpt,
        ]);
        notify()->success('Berita berhasil diperbarui');

        return redirect()->route('berita.index');
    }

    // Menghapus berita
    public function destroy($id)
    {
        $berita = Berita::find($id);

        if (! $berita) {
            return redirect()->route('berita.index')->with('error', 'Berita tidak ditemukan');
        }

        $berita->delete();
        notify()->success('Berita berhasil dihapus');

        return redirect()->route('berita.index');
    }

    public function front($slug)
    {
        $news = Berita::where('slug', $slug)->firstOrFail();

        return view('frontend.detail_berita', [
            'news' => $news,
            'latest' => Berita::where('id', '!=', $news->id)->latest()->take(5)->get(),
        ]);
    }

    public function all()
    {
        $berita = Berita::latest()->paginate(9);

        return view('frontend.berita', compact('berita')); // Menampilkan daftar berita
    }
}
