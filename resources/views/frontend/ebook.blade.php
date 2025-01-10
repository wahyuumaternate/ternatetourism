@extends('frontend.layouts.main')

@push('css')
    <style>
        body {
            padding-top: 100px;
            background-color: #f5f5f5;
        }

        .book-card {
            position: relative;
            height: 600px;
            /* Increased height */
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .book-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .book-card:hover .book-image {
            transform: scale(1.05);
        }

        .book-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 30px 20px;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
            color: white;
        }

        .book-title {
            font-size: 1.5rem;
            /* Larger font size */
            font-weight: bold;
            margin-bottom: 10px;
            color: white;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .book-author {
            color: #e0e0e0;
            font-size: 1.1rem;
            /* Larger font size */
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .book-button {
            width: 100%;
            padding: 12px;
            /* Larger padding */
            border: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 1.1rem;
            /* Larger font size */
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }



        .read-button {
            background-color: #ff6500;
            color: white;
        }

        .read-button:hover {
            background-color: #ff66009d;
        }

        .container {
            max-width: 1400px;
            /* Wider container */
        }
    </style>
@endpush

@section('body')
    <div class="container mt-5">
        <div class="row">
            {{-- @php
                $dummyBooks = [
                    [
                        'title' => 'La Roue du Temps',
                        'author' => 'Robert Jordan',
                        'cover_image' =>
                            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQK2MgdZYfiIQ1P-Zj__GAim99DCnywsRykUA&s',
                        'status' => 'available',
                    ],
                    [
                        'title' => 'The Adventures of Sherlock Holmes',
                        'author' => 'Arthur Conan Doyle',
                        'cover_image' => 'http://127.0.0.1:8000/storage/files/1/EBOOK%20COVER.jpg',
                        'status' => 'readable',
                    ],
                    [
                        'title' => 'La Roue du Temps',
                        'author' => 'Robert Jordan',
                        'cover_image' =>
                            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQK2MgdZYfiIQ1P-Zj__GAim99DCnywsRykUA&s',
                        'status' => 'available',
                    ],
                    [
                        'title' => 'The Adventures of Sherlock Holmes',
                        'author' => 'Arthur Conan Doyle',
                        'cover_image' => 'http://127.0.0.1:8000/storage/files/1/EBOOK%20COVER.jpg',
                        'status' => 'readable',
                    ],
                    [
                        'title' => 'La Roue du Temps',
                        'author' => 'Robert Jordan',
                        'cover_image' =>
                            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQK2MgdZYfiIQ1P-Zj__GAim99DCnywsRykUA&s',
                        'status' => 'available',
                    ],
                    [
                        'title' => 'The Adventures of Sherlock Holmes',
                        'author' => 'Arthur Conan Doyle',
                        'cover_image' => 'http://127.0.0.1:8000/storage/files/1/EBOOK%20COVER.jpg',
                        'status' => 'readable',
                    ],
                    [
                        'title' => 'La Roue du Temps',
                        'author' => 'Robert Jordan',
                        'cover_image' =>
                            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQK2MgdZYfiIQ1P-Zj__GAim99DCnywsRykUA&s',
                        'status' => 'available',
                    ],
                    [
                        'title' => 'The Adventures of Sherlock Holmes',
                        'author' => 'Arthur Conan Doyle',
                        'cover_image' => 'http://127.0.0.1:8000/storage/files/1/EBOOK%20COVER.jpg',
                        'status' => 'readable',
                    ],
                    [
                        'title' => 'La Roue du Temps',
                        'author' => 'Robert Jordan',
                        'cover_image' =>
                            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQK2MgdZYfiIQ1P-Zj__GAim99DCnywsRykUA&s',
                        'status' => 'available',
                    ],
                    [
                        'title' => 'The Adventures of Sherlock Holmes',
                        'author' => 'Arthur Conan Doyle',
                        'cover_image' => 'http://127.0.0.1:8000/storage/files/1/EBOOK%20COVER.jpg',
                        'status' => 'readable',
                    ],
                    [
                        'title' => 'La Roue du Temps',
                        'author' => 'Robert Jordan',
                        'cover_image' =>
                            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQK2MgdZYfiIQ1P-Zj__GAim99DCnywsRykUA&s',
                        'status' => 'available',
                    ],
                    [
                        'title' => 'The Adventures of Sherlock Holmes',
                        'author' => 'Arthur Conan Doyle',
                        'cover_image' => 'http://127.0.0.1:8000/storage/files/1/EBOOK%20COVER.jpg',
                        'status' => 'readable',
                    ],
                    [
                        'title' => 'La Roue du Temps',
                        'author' => 'Robert Jordan',
                        'cover_image' =>
                            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQK2MgdZYfiIQ1P-Zj__GAim99DCnywsRykUA&s',
                        'status' => 'available',
                    ],
                    [
                        'title' => 'The Adventures of Sherlock Holmes',
                        'author' => 'Arthur Conan Doyle',
                        'cover_image' => 'http://127.0.0.1:8000/storage/files/1/EBOOK%20COVER.jpg',
                        'status' => 'readable',
                    ],
                ];
            @endphp --}}
            <div class="row align-items-center mb-5">
                <div class="col-md-8">
                    <h1 class="fw-bold section-title" data-aos="fade-right">E-Books</h1>
                    <p class="text-muted" data-aos="fade-left">
                        Discover a world of knowledge through our digital library
                    </p>
                </div>
            </div>
            @foreach ($ebooks as $book)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="book-card">
                        <img src="{{ $book->gambar_sampul }}" alt="{{ $book->judul }}" class="book-image">
                        <div class="book-info">
                            <h3 class="book-title">{{ $book->judul }}</h3>
                            <p class="book-author">{{ $book->penulis }}</p>

                            <a href="{{ route('ebooks.detail', $book->kode_buku) }}"
                                class="book-button read-button">Read</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
