@extends('frontend.layouts.main')
@push('meta')
    <!-- SEO Meta Tags -->
    <title>{{ $ekraf->name }} - Ekonomi Kreatif Wonderful Ternate</title>
    <meta name="description"
        content="{{ $ekraf->name }} - {{ $ekraf->category->name }}. {{ Str::limit(strip_tags($ekraf->description), 120) }}">
    <meta name="keywords"
        content="{{ $ekraf->name }}, {{ $ekraf->category->name }}, ekonomi kreatif ternate, produk lokal ternate, umkm ternate, {{ Str::slug($ekraf->category->name) }} ternate">
    <meta name="author" content="{{ $ekraf->name }}">
    <meta name="robots" content="index, follow">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="business.business">
    <meta property="og:title" content="{{ $ekraf->name }} - Ekonomi Kreatif Wonderful Ternate">
    <meta property="og:description"
        content="{{ $ekraf->name }} - {{ $ekraf->category->name }}. {{ Str::limit(strip_tags($ekraf->description), 120) }}">
    <meta property="og:image" content="{{ $ekraf->logo }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Wonderful Ternate">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $ekraf->name }} - Ekonomi Kreatif Wonderful Ternate">
    <meta name="twitter:description"
        content="{{ $ekraf->name }} - {{ $ekraf->category->name }}. {{ Str::limit(strip_tags($ekraf->description), 120) }}">
    <meta name="twitter:image" content="{{ $ekraf->logo }}">
    <!-- Additional Meta Tags for Location -->
    <meta name="geo.region" content="ID-MU">
    <meta name="geo.placename" content="Ternate">
    <meta name="geo.position" content="0.7833;127.3667">
    <meta name="ICBM" content="0.7833, 127.3667">
    <!-- Business Specific Meta Tags -->
    <meta property="business:contact_data:street_address" content="Ternate">
    <meta property="business:contact_data:locality" content="Ternate">
    <meta property="business:contact_data:region" content="Maluku Utara">
    <meta property="business:contact_data:postal_code" content="">
    <meta property="business:contact_data:country_name" content="Indonesia">
    @if ($ekraf->phone)
        <meta property="business:contact_data:phone_number" content="{{ $ekraf->phone }}">
    @endif
    @if ($ekraf->email)
        <meta property="business:contact_data:email" content="{{ $ekraf->email }}">
    @endif
    @if ($ekraf->website)
        <meta property="business:contact_data:website" content="{{ $ekraf->website }}">
    @endif
    <meta property="business:hours:day" content="Monday through Sunday">
@endpush
@include('frontend.layouts.navbar')
@section('body')
    <div class="container ekraf">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <img src="{{ $ekraf->logo }}" alt="{{ $ekraf->name }}" class="logo mx-auto d-block" width="150">
                <h1 class="text-center">{{ $ekraf->name }}</h1>
                <p class="text-center">{{ $ekraf->category->name }}</p>
                <table class="info-table mx-auto">
                    <tr>
                        <th>No Telpon</th>
                        <td>: {{ $ekraf->phone ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>:{{ $ekraf->email ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Sosial Media</th>
                        <td>:{{ $ekraf->social_media ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Website</th>
                        <td>: <a target="blank" href="{{ $ekraf->website ?? '#' }}">{{ $ekraf->website ?? 'N/A' }}</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Jumlah Produk</th>
                        <td>:{{ $ekraf->jumlah_produk }}</td>
                    </tr>
                </table>
                <div class="tab-content mt-3">
                    <h3>Deskripsi</h3>
                    {!! $ekraf->description !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .ekraf {
            margin-top: 100px;
        }
    </style>
@endpush
