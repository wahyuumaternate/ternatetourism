@extends('frontend.layouts.main')

@push('css')
    <style>
        body {
            padding-top: 100px;
            background-color: #f5f5f5;
        }

        .book-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .book-cover {
            width: 100%;
            max-height: 600px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .book-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .book-author {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 20px;
        }

        .book-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
            margin: 20px 0;
        }

        .book-info-table {
            width: 100%;
            margin: 20px 0;
        }

        .book-info-table td {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .book-info-label {
            font-weight: bold;
            color: #444;
            width: 150px;
        }

        .action-button {
            padding: 12px 30px;
            font-size: 1.1rem;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 10px;
        }

        .read-button {
            background-color: #28a745;
            color: white;
        }

        .read-button:hover {
            background-color: #218838;
        }

        .download-button {
            background-color: #0077cc;
            color: white;
        }

        .download-button:hover {
            background-color: #0066b3;
        }
    </style>
@endpush

@section('body')
    <div class="container mb-3">
        <div class="book-container">
            <div class="row">
                <!-- Book Cover Column -->
                <div class="col-md-4">
                    <img src="{{ $ebook->gambar_sampul }}" alt="Book Cover" class="book-cover">
                    <div class="mt-4 text-center">
                        @if ($ebook->file)
                            <a href="{{ $ebook->file }}" target="_blank" class="action-button read-button mb-2 me-2">Read
                                Online</a>
                            <a href="{{ $ebook->file }}" download class="action-button download-button mb-2">Download
                                PDF</a>
                        @endif
                    </div>
                </div>

                <!-- Book Details Column -->
                <div class="col-md-8">
                    <h1 class="book-title">{{ $ebook->judul }}</h1>
                    <h2 class="book-author">By {{ $ebook->penulis }}</h2>

                    <table class="book-info-table">
                        <tr>
                            <td class="book-info-label">Number of Pages</td>
                            <td>{{ $ebook->jumlah_halaman }} pages</td>
                        </tr>
                        <tr>
                            <td class="book-info-label">Publisher</td>
                            <td>{{ $ebook->penerbit }}</td>
                        </tr>
                        <tr>
                            <td class="book-info-label">Publication Date</td>
                            <td>{{ $ebook->tanggal_terbit->format('F d, Y') }}</td>
                        </tr>
                        <tr>
                            <td class="book-info-label">Category</td>
                            <td>{{ $ebook->kategori }}</td>
                        </tr>
                        <tr>
                            <td class="book-info-label">Language</td>
                            <td>{{ $ebook->bahasa }}</td>
                        </tr>
                        <tr>
                            <td class="book-info-label">Book Code</td>
                            <td>{{ $ebook->kode_buku }}</td>
                        </tr>
                        <tr>
                            <td class="book-info-label">File Format</td>
                            <td>PDF</td>
                        </tr>
                    </table>
                    <div class="book-description">
                        {{ $ebook->deskripsi }}
                    </div>

                </div>
            </div>
        </div>

        {{-- <!-- You might want to add related books section here -->
        <div class="mt-5">
            <h3 class="mb-4">You might also like</h3>
            <div class="row">
                <!-- Add related books cards here -->
            </div>
        </div> --}}
    </div>
@endsection
