<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\Berita;
use App\Models\Destination;
use App\Models\Media;
use App\Models\Partner;
use App\Models\StrukturDanVisi;
class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index', [
            'destinasi' => Destination::latest()->get(),
            'galeri' => Media::where('type', 'photo')->latest()->get(),
            'video' => Media::where('type', 'video')->latest()->get(),
            'berita' => Berita::orderBy('created_at', 'desc')->get(),
            'partners' => Partner::orderBy('created_at', 'desc')->get(),
        ]);
    }
    public function switchLang($lang)
    {
        if (array_key_exists($lang, config('languages'))) {
            Session::put('locale', $lang);
            App::setLocale($lang);
        }
        return redirect()->back();
    }
}
