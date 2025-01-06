<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EbookController extends Controller
{
    /**
     * Tampilkan daftar e-book.
     */
    public function index()
    {
        $ebooks = Ebook::orderBy('created_at', 'desc')->get();
        return view('admin.media.ebooks', compact('ebooks'));
    }

    public function show($kode_buku)
    {
        // Ambil data e-book berdasarkan kode_buku
        $ebook = Ebook::where('kode_buku', $kode_buku)->firstOrFail();

        // Return ke view dengan data e-book
        return view('admin.media.ebooks_detail', compact('ebook'));
    }

    /**
     * Simpan e-book baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'required|string',
            'gambar_sampul' => 'nullable|string',
            'jumlah_halaman' => 'nullable|integer',
            'penerbit' => 'nullable|string|max:255',
            'tanggal_terbit' => 'nullable|date',
            'kategori' => 'nullable|string|max:255',
            'bahasa' => 'nullable|string|max:255',
        ]);

        Ebook::create($request->all());

        notify()->success('E-Book berhasil ditambahkan.');
        return redirect()->route('ebooks.index');
    }

    /**
     * Update e-book yang ada di database.
     */
    public function update(Request $request, $kode_buku)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
                'penulis' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'file' => 'required|string',
                'gambar_sampul' => 'nullable|string',
                'jumlah_halaman' => 'nullable|integer',
                'penerbit' => 'nullable|string|max:255',
                'tanggal_terbit' => 'nullable|date',
                'kategori' => 'nullable|string|max:255',
                'bahasa' => 'nullable|string|max:255',
        ]);

        $ebook = Ebook::where('kode_buku', $kode_buku)->firstOrFail();
        $ebook->update($request->all());

        notify()->success('E-Book berhasil diperbarui.');
        return redirect()->route('ebooks.index');
    }


    /**
     * Hapus e-book dari database.
     */
    public function destroy($kode_buku)
    {
        $ebook = Ebook::where('kode_buku', $kode_buku)->firstOrFail();
        $ebook->delete();

        notify()->success('E-Book berhasil dihapus.');
        return redirect()->route('ebooks.index');
    }

}
