<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
   public function index()
   {
       $heroes = Hero::all();
       return view('admin.hero', compact('heroes'));
   }

   public function create()
   {
       return view('heroes.create');
   }

   public function store(Request $request)
   {
      // Check if heroes count is already 5
    if (Hero::count() >= 5) {
        notify()->error('Maksimal hanya 5 hero yang diperbolehkan');
        return redirect()->route('heroes.index');
    }

    $validated = $request->validate([
        'image' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'description' => 'required|string'
    ]);

    Hero::create($validated);

    notify()->success('Hero berhasil ditambahkan');
    return redirect()->route('heroes.index');
   }

   public function edit(Hero $hero)
   {
       return view('heroes.edit', compact('hero'));
   }

   public function update(Request $request, Hero $hero)
   {
       $validated = $request->validate([
           'image' => 'required|string|max:255',
           'title' => 'required|string|max:255',
           'description' => 'required|string'
       ]);

       $hero->update($validated);

       notify()->success('Hero berhasil diperbarui');
       return redirect()->route('heroes.index');
   }

   public function destroy(Hero $hero)
   {
       $hero->delete();

       notify()->success('Hero berhasil dihapus');
       return redirect()->route('heroes.index');
   }
}