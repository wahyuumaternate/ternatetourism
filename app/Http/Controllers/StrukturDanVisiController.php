<?php

namespace App\Http\Controllers;

use App\Models\StrukturDanVisi;
use Illuminate\Http\Request;

class StrukturDanVisiController extends Controller
{
    public function visimisi(){
        $visi = StrukturDanVisi::find(1);

        return view('admin.profil.visi_misi', compact('visi')); // Menampilkan detail event
    }

    public function visimisiUpdate(Request $request)
    {
        $visi = StrukturDanVisi::find(1);

        $request->validate([
            'content' => 'required|string|max:255',
        ]);
    
        if ($request->has('content')) {
            $visi->update([
                'content' => $request->input('content')
            ]);
        }

        notify()->success('Visi & Misi berhasil diperbarui');
        return redirect()->back();
    }
    public function struktur(){
       $struktur = StrukturDanVisi::find(2);

        return view('admin.profil.struktur', compact('struktur')); // Menampilkan detail event
    }

    public function strukturUpdate(Request $request)
    {
       $struktur = StrukturDanVisi::find(2);

        $request->validate([
            'content' => 'required|string|max:255',
        ]);
    
        if ($request->has('content')) {
           $struktur->update([
                'content' => $request->input('content')
            ]);
        }

        notify()->success('Visi & Misi berhasil diperbarui');
        return redirect()->back();
    }
}
