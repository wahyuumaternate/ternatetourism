<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->get();
        return view('admin.destinasi.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destinasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required',
            'description' => 'required|string',
            'lat' => 'required',
            'long' => 'required',
        ]);

     

        Destination::create([
            'name' => $request->name,
            'image' =>  $request->image,
            'description' => $request->description,
            'lat' => $request->lat,
            'long' => $request->long,
            'slug' => Str::slug($request->name),
        ]);

        notify()->success('Destinasi berhasil ditambahkan.');
        return redirect()->route('destinations.index');
    }


    public function edit(Destination $destination)
    {
        return view('admin.destinasi.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required',
            'description' => 'required|string',
            'lat' => 'required',
            'long' => 'required',
        ]);


        $destination->update([
            'name' => $request->name,
            'image' =>  $request->image,
            'description' => $request->description,
            'lat' => $request->lat,
            'long' => $request->long,
            'slug' => Str::slug($request->name),
        ]);

        notify()->success('Destinasi berhasil diperbarui.');
        return redirect()->route('destinations.index');
    }


    public function destroy(Destination $destination)
    {
        
        $destination->delete();
        notify()->success('Destinasi berhasil dihapus.');
        return redirect()->route('destinations.index');
    }


    public function front($slug)
    {
        // Ambil data destinasi berdasarkan slug
        $destination = Destination::where('slug', $slug)->firstOrFail();

        // Kirim data ke view
        return view('frontend.detail_destinasi', compact('destination'));
    }

}
