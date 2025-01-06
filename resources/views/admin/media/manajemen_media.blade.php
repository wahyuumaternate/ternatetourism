@extends('admin.layouts.main', ['title' => 'Galeri Photo'])
@push('css')
    <style>
        .storage-usage-info {
            display: none;
        }
    </style>
@endpush
@section('main')
    <div class="container-fluid">
        <!-- Implementasi File Manager -->
        <iframe src="{{ url('filemanager?type=Files') }}" style="width: 100%; height: 100vh; border: none; overflow: hidden;">
        </iframe>
    </div>
@endsection
