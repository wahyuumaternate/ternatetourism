@extends('frontend.layouts.main')

@push('meta')
    <!-- SEO Meta Tags -->
    <title>{{ $news->title }} - Wonderful Ternate</title>
    <meta name="description" content="{{ Str::limit(strip_tags($news->content), 160) }}">
    <meta name="keywords" content="{{ implode(',', ['news', $news->title, 'travel', 'tourism']) }}">
    <meta name="author" content="Your Website Name">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $news->title }} - Your Website Name">
    <meta property="og:description" content="{{ Str::limit(strip_tags($news->content), 160) }}">
    <meta property="og:image" content="{{ $news->image }}">
    <meta property="og:url" content="{{ route('berita.detail', $news->slug) }}">
    <meta property="og:site_name" content="Your Website Name">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $news->title }} - Your Website Name">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($news->content), 160) }}">
    <meta name="twitter:image" content="{{ $news->image }}">
@endpush


@section('body')
    <div class="container my-5 pt-5">
        <div class="card">
            <img src="{{ $news->image }}" alt="{{ $news->title }}" class="card-img-top mt-5">
            <div class="card-body">
                <h5 class="card-title">{{ $news->title }} - <small
                        class="text-muted">{{ $news->created_at->format('d M Y') }}</small></h5>
                <p class="card-text">{!! $news->content !!}</p>
                {{-- <p class="card-text"><small class="text-muted">{{ $news->created_at->format('d M Y') }}</small></p> --}}
            </div>
        </div>
    </div>
@endsection
