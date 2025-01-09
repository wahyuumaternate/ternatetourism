@extends('frontend.layouts.main')
@include('frontend.layouts.navbar')
@section('body')
    <div class="container ekraf">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <img src="{{ $ekraf->logo }}" alt="Kreasi Jabar logo" class="logo mx-auto d-block" width="150">
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
