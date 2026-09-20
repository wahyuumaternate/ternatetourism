@extends('frontend.layouts.app')

@php
    $title = Str::before($destination->name, ':');
    $subtitle = Str::contains($destination->name, ':') ? trim(Str::after($destination->name, ':')) : null;
    $plain = Str::limit(trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags((string) $destination->description)))), 155);
    $hasCoords = is_numeric($destination->lat) && is_numeric($destination->long);
@endphp

@section('title', $title . ' — ' . __('wt.brand'))
@section('description', $plain)
@section('og_image', asset($destination->image))

@push('head')
    <script type="application/ld+json">
        {!! json_encode(array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'TouristAttraction',
            'name' => $title,
            'description' => $plain,
            'image' => asset($destination->image),
            'url' => url()->current(),
            'geo' => $hasCoords ? ['@type' => 'GeoCoordinates', 'latitude' => (float) $destination->lat, 'longitude' => (float) $destination->long] : null,
        ]), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('body')
    <x-front.page-header :eyebrow="__('pesan.destination')" :title="$title" :subtitle="$subtitle" :image="$destination->image" />

    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-12 px-4 py-16 sm:px-6 lg:grid-cols-3 lg:px-8 lg:py-24">
        <article class="min-w-0 lg:col-span-2">
            <p class="eyebrow">{{ __('wt.pg_overview') }}</p>
            <div class="rich mt-4">{!! \App\Helpers\RichText::clean($destination->description) !!}</div>

            <div class="mt-10 flex flex-wrap items-center gap-3 border-t border-black/10 pt-6">
                <span class="text-sm font-semibold text-volcanic">{{ __('wt.pg_share') }}:</span>
                @foreach (['Facebook' => 'https://www.facebook.com/sharer/sharer.php?u=', 'WhatsApp' => 'https://api.whatsapp.com/send?text=', 'X' => 'https://twitter.com/intent/tweet?url='] as $network => $shareUrl)
                    <a href="{{ $shareUrl . urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="btn-outline !px-4 !py-2">{{ $network }}</a>
                @endforeach
            </div>
        </article>

        <aside class="min-w-0 space-y-8">
            @if ($hasCoords)
                <div>
                    <p class="eyebrow">{{ __('wt.pg_location') }}</p>
                    <div id="detail-map" class="card mt-4 h-72 w-full" role="application" aria-label="{{ __('wt.pg_location') }}"></div>
                    <p class="mt-3 text-sm text-volcanic/60">{{ __('wt.pg_coords') }}: {{ $destination->lat }}, {{ $destination->long }}</p>
                </div>
            @endif

            @if ($nearby->isNotEmpty())
                <div>
                    <p class="eyebrow">{{ __('wt.pg_nearby') }}</p>
                    <ul class="mt-4 space-y-3">
                        @foreach ($nearby as $place)
                            <li>
                                <a href="{{ route('destinasi.show', $place['destination']->slug) }}" class="card flex items-center gap-4 p-3 transition hover:-translate-y-0.5">
                                    <x-front.picture :src="$place['destination']->image" :alt="Str::before($place['destination']->name, ':')" sizes="80px" class="h-16 w-16 shrink-0 rounded-xl object-cover" />
                                    <div class="min-w-0">
                                        <p class="truncate font-semibold text-volcanic">{{ Str::before($place['destination']->name, ':') }}</p>
                                        <p class="text-sm text-volcanic/60">≈ {{ number_format($place['km'], 1, ',', '.') }} km</p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </aside>
    </div>

    <section class="dark-surface bg-volcanic px-4 py-20 text-center text-white">
        <a href="{{ route('destinasi.all') }}" class="btn-primary">{{ __('wt.pg_explore_more') }} &rarr;</a>
    </section>
@endsection

@if ($hasCoords)
    @push('head')
        <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}">
    @endpush
    @push('scripts')
        <script src="{{ asset('leaflet/leaflet.js') }}"></script>
        <script>
            const point = [{{ (float) $destination->lat }}, {{ (float) $destination->long }}];
            const map = L.map('detail-map', { scrollWheelZoom: false }).setView(point, 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 18, attribution: '&copy; OpenStreetMap contributors' }).addTo(map);
            L.circleMarker(point, { radius: 10, color: '#fff', weight: 2, fillColor: '#0B6E69', fillOpacity: 1 }).addTo(map);
        </script>
    @endpush
@endif
