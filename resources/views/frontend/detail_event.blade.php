@extends('frontend.layouts.app')

@php
    $start = \Illuminate\Support\Carbon::parse($event->date . ' ' . $event->time);
    $plain = Str::limit(trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags((string) $event->detail)))), 155);
    $hasCoords = is_numeric($event->lat) && is_numeric($event->long);
@endphp

@section('title', $event->name . ' — ' . __('wt.brand'))
@section('description', $plain)
@section('og_image', asset($event->poster))

@push('head')
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Event',
            'name' => $event->name,
            'startDate' => $start->toIso8601String(),
            'image' => asset($event->poster),
            'description' => $plain,
            'location' => ['@type' => 'Place', 'name' => $event->location],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('body')
    <x-front.page-header :eyebrow="__('wt.nav_events')" :title="$event->name" :subtitle="$event->location" :image="$event->poster" />

    <div class="mx-auto grid max-w-7xl gap-12 px-4 py-16 sm:px-6 lg:grid-cols-3 lg:px-8 lg:py-24">
        <article class="lg:col-span-2">
            <p class="eyebrow">{{ __('wt.pg_event_detail') }}</p>
            <div class="rich mt-4">{!! $event->detail !!}</div>
        </article>

        <aside class="space-y-6">
            <div class="card p-6">
                <p class="eyebrow">{{ __('wt.pg_event_when') }}</p>
                <p class="mt-2 font-display text-3xl text-volcanic">{{ $start->translatedFormat('d F Y') }}</p>
                <p class="text-volcanic/65">{{ $start->format('H:i') }}</p>
                <p class="eyebrow mt-6">{{ __('wt.pg_event_where') }}</p>
                <p class="mt-2 font-semibold text-volcanic">{{ $event->location }}</p>
            </div>

            @if ($hasCoords)
                <div id="detail-map" class="card h-72 w-full" role="application" aria-label="{{ __('wt.pg_location') }}"></div>
            @endif

            <a href="{{ route('events.all') }}" class="btn-outline w-full">{{ __('wt.all_events') }}</a>
        </aside>
    </div>
@endsection

@if ($hasCoords)
    @push('head')
        <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}">
    @endpush
    @push('scripts')
        <script src="{{ asset('leaflet/leaflet.js') }}"></script>
        <script>
            const point = [{{ (float) $event->lat }}, {{ (float) $event->long }}];
            const map = L.map('detail-map', { scrollWheelZoom: false }).setView(point, 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 18, attribution: '&copy; OpenStreetMap contributors' }).addTo(map);
            L.circleMarker(point, { radius: 10, color: '#fff', weight: 2, fillColor: '#0B6E69', fillOpacity: 1 }).addTo(map);
        </script>
    @endpush
@endif
