<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
            'image' => $request->image,
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
            'image' => $request->image,
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
        $destination = Destination::where('slug', $slug)->firstOrFail();

        return view('frontend.detail_destinasi', [
            'destination' => $destination,
            'nearby' => $this->nearby($destination),
        ]);
    }

    /**
     * Tiga destinasi terdekat berdasarkan jarak haversine dari koordinat di database.
     *
     * @return Collection<int, array{destination: Destination, km: float}>
     */
    private function nearby(Destination $destination)
    {
        if (! is_numeric($destination->lat) || ! is_numeric($destination->long)) {
            return collect();
        }

        return Destination::where('id', '!=', $destination->id)->get()
            ->filter(fn (Destination $other) => is_numeric($other->lat) && is_numeric($other->long))
            ->map(fn (Destination $other) => [
                'destination' => $other,
                'km' => $this->haversineKm((float) $destination->lat, (float) $destination->long, (float) $other->lat, (float) $other->long),
            ])
            ->sortBy('km')
            ->take(3)
            ->values();
    }

    private function haversineKm(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;

        return 6371 * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }

    public function all()
    {
        // Ambil data destinasi berdasarkan slug
        $destination = Destination::latest()->paginate(9);

        // Kirim data ke view
        return view('frontend.destinasi', compact('destination'));
    }
}
