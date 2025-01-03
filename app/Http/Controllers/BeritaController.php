<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

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

        if (!$berita) {
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

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit berita
    public function edit($id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return redirect()->route('berita.index')->with('error', 'Berita tidak ditemukan');
        }

        return view('berita.edit', compact('berita')); // Menampilkan form edit berita
    }

    // Memperbarui berita
    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return redirect()->route('berita.index')->with('error', 'Berita tidak ditemukan');
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:berita,slug,' . $id,
            'content' => 'sometimes|required',
            'image' => 'sometimes|required|string',
            'excerpt' => 'sometimes|nullable|string|max:255',
        ]);

        $excerpt = $request->excerpt ?? substr(strip_tags($request->content), 0, 150);

        $berita->update(array_merge($request->only(['title', 'slug', 'content', 'image']), [
            'excerpt' => $excerpt,
        ]));

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    // Menghapus berita
    public function destroy($id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return redirect()->route('berita.index')->with('error', 'Berita tidak ditemukan');
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
