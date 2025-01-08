<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventsController extends Controller
{
    // Menampilkan semua event
    public function index()
    {
        $events = Events::orderBy('date', 'asc')->get();
        return view('admin.publikasi.events', compact('events')); // Menampilkan daftar event
    }

    public function create()
    {
        return view('admin.publikasi.events_create'); // Menampilkan form untuk membuat event baru
    }

    // Menampilkan detail event berdasarkan ID
    public function show($id)
    {
        $event = Events::find($id);

        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event tidak ditemukan');
        }

        return view('events.show', compact('event')); // Menampilkan detail event
    }

    // Menyimpan event baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'detail' => 'required',
            'lat' => 'required|string',
            'long' => 'required|string',
            'poster' => 'required|string',
        ]);

        Events::create($request->all());

        notify()->success('Event berhasil ditambahkan');
        return redirect()->route('events.index');
    }

    // Menampilkan form untuk mengedit event
    public function edit($id)
    {
        $event = Events::find($id);

        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event tidak ditemukan');
        }

        return view('admin.publikasi.events_edit', compact('event')); // Menampilkan form edit event
    }

    // Memperbarui event
    public function update(Request $request, $id)
    {
        $event = Events::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'location' => 'sometimes|required|string|max:255',
            'date' => 'sometimes|required|date',
            'time' => 'sometimes|required',
            'detail' => 'sometimes|required',
            'lat' => 'sometimes|required|string',
            'long' => 'sometimes|required|string',
            'poster' => 'sometimes|required|string',
        ]);

        $event->update($request->all());

        notify()->success('Event berhasil diperbarui');
        return redirect()->route('events.index');
    }

    // Menghapus event
    public function destroy($id)
    {
        $event = Events::find($id);

        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event tidak ditemukan');
        }

        $event->delete();
        notify()->success('Event berhasil dihapus');
        return redirect()->route('events.index');
    }

    public function all()
    {
        // Ambil data destinasi berdasarkan slug
        $events = Events::latest()->paginate(9);

        // Kirim data ke view
        return view('frontend.events', compact('events'));
    }

    // Metode untuk menampilkan detail acara berdasarkan slug
    public function detail($slug)
    {
        // Mengambil acara berdasarkan slug
        $event = Events::where('slug', $slug)->firstOrFail();

        // Mengembalikan view dengan data acara
        return view('frontend.detail_event', compact('event'));
    }

}
