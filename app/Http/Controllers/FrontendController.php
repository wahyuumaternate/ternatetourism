<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Destination;
use App\Models\Events;
use App\Models\Fasilitas;
use App\Models\Media;
use App\Models\Partner;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->get();
        $upcomingEvents = Events::whereDate('date', '>=', today())->orderBy('date')->take(4)->get();
        $pastEvents = $upcomingEvents->isEmpty() ? Events::latest('date')->take(3)->get() : collect();
        $facilities = Fasilitas::whereIn('kategori', ['cafe-restorant', 'umkm'])->latest()->take(3)->get();

        return view('frontend.index', [
            'destinations' => $destinations,
            'featuredDestinations' => $destinations->take(7),
            'upcomingEvents' => $upcomingEvents,
            'pastEvents' => $pastEvents,
            'partners' => Partner::latest()->get(),
            'stories' => Berita::latest()->take(3)->get(),
            'facilities' => $facilities,
            'gallery' => Media::where('type', 'photo')->latest()->take(9)->get(),
            'culinaryImage' => Fasilitas::where('kategori', 'cafe-restorant')->whereNotNull('gambar')->value('gambar'),
            'spiceImage' => Destination::where('name', 'like', '%Cengkeh%')->value('image'),
            'mapPoints' => $this->mapPoints($destinations, $upcomingEvents->isEmpty() ? $pastEvents : $upcomingEvents),
        ]);
    }

    /**
     * Titik peta dari destinasi dan event yang punya koordinat valid.
     *
     * @return array<int, array{type: string, name: string, lat: float, lng: float, image: string, url: string, description: string}>
     */
    private function mapPoints(Collection $destinations, Collection $events): array
    {
        $points = [];

        foreach ($destinations as $destination) {
            $points[] = [
                'type' => 'destination',
                'name' => Str::before($destination->name, ':'),
                'lat' => $destination->lat,
                'lng' => $destination->long,
                'image' => $destination->image ? asset($destination->image) : '',
                'url' => route('destinasi.show', $destination->slug),
                'description' => Str::limit(trim(strip_tags((string) $destination->description)), 110),
            ];
        }

        foreach ($events as $event) {
            $points[] = [
                'type' => 'event',
                'name' => $event->name,
                'lat' => $event->lat,
                'lng' => $event->long,
                'image' => $event->poster ? asset($event->poster) : '',
                'url' => route('event.detail', $event->slug),
                'description' => $event->location,
            ];
        }

        return collect($points)
            ->filter(fn (array $point) => is_numeric($point['lat']) && is_numeric($point['lng']))
            ->map(fn (array $point) => [...$point, 'lat' => (float) $point['lat'], 'lng' => (float) $point['lng']])
            ->values()
            ->all();
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
