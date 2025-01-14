<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::where('type','photo')->latest()->get();
        return view('admin.media.foto', compact('media'));
    }
    public function manajemen()
    {
       
        return view('admin.media.manajemen_media');
    }

    public function indexVidio()
    {
        $media = Media::where('type','video')->latest()->get();
        return view('admin.media.vidio', compact('media'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'type' => 'required',
            'file' => 'required',
            'description' => 'nullable|max:255'
        ]);

        
        Media::create([
            'title' => $request->title,
            'type' => $request->type,
            'file' => $request->file,
            'description' => $request->description,
        ]);

        notify()->success('Media berhasil ditambahkan');
        return redirect()->back();
    }

    public function update(Request $request, Media $media)
    {
        $request->validate([
            'title' => 'required|max:255',
            'type' => 'required|in:photo,video',
            'file' => 'required',
            'description' => 'nullable|max:255'
        ]);

        $data = [
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'file' => $request->file,
        ];

        // if ($request->hasFile('file')) {
        //     if (Storage::exists(str_replace('storage/', 'public/', $media->file))) {
        //         Storage::delete(str_replace('storage/', 'public/', $media->file));
        //     }

        //     $file = $request->file('file');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $file->storeAs('public/media', $fileName);
        //     $data['file'] = 'storage/media/' . $fileName;
        // }

        $media->update($data);

        notify()->success('Media berhasil diupdate');
        return redirect()->back();
    }

    public function destroy(Media $media)
    {
        if (Storage::exists(str_replace('storage/', 'public/', $media->file))) {
            Storage::delete(str_replace('storage/', 'public/', $media->file));
        }

        $media->delete();

        notify()->success('Media berhasil dihapus');
        return redirect()->back();
    }

    public function frontFoto()
    {
        $media = Media::where('type','photo')->latest()->paginate(9); // Menampilkan 9 foto per halaman
        return view('frontend.foto', compact('media'));
    }
    public function frontVideo()
    {
        $video = Media::where('type','video')->latest()->paginate(9); // Menampilkan 9 foto per halaman
        return view('frontend.video', compact('video'));
    }
}
