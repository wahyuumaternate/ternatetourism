@extends('admin.layouts.main', ['title' => 'E-Book ' . $ebook->judul])

@section('main')
    <div class="container mt-4">
        <!-- Judul dan Pengarang -->
        <div class="text-center mb-4">
            <h2>{{ $ebook->judul }}</h2>
            <p>Oleh <strong>{{ $ebook->penulis }}</strong></p>
        </div>

        <!-- Pratinjau dan Deskripsi -->
        <div class="row">
            <!-- Gambar Sampul -->
            <div class="col-md-4 text-center">
                <img src="{{ asset($ebook->gambar_sampul) }}" alt="Sampul E-Book" class="img-fluid shadow-sm">
                <div class="mt-3">
                    <a href="{{ asset($ebook->file) }}" target="_blank" class="btn btn-primary">
                        <i class="bi bi-book"></i> Pratinjau
                    </a>
                </div>
            </div>

            <!-- Detail E-Book -->
            <div class="col-md-8">
                <h4 class="mb-3">Tentang Edisi Ini</h4>
                <div class="card p-3 shadow-sm">
                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Judul</strong></div>
                        <div class="col-md-8">: {{ $ebook->judul }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Penulis</strong></div>
                        <div class="col-md-8">: {{ $ebook->penulis }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Penerbit</strong></div>
                        <div class="col-md-8">: {{ $ebook->penerbit }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Tanggal Terbit</strong></div>
                        <div class="col-md-8">: {{ \Carbon\Carbon::parse($ebook->tanggal_terbit)->format('d M Y') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Kategori</strong></div>
                        <div class="col-md-8">: {{ $ebook->kategori }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Bahasa</strong></div>
                        <div class="col-md-8">: {{ $ebook->bahasa }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Jumlah Halaman</strong></div>
                        <div class="col-md-8">: {{ $ebook->jumlah_halaman }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Deskripsi</strong></div>
                        <div class="col-md-8">: {{ $ebook->deskripsi }}</div>
                    </div>
                </div>
                <!-- Detail E-Book -->
                <div class="col-md-12">

                    <div class="card p-3 shadow-sm">
                        <p>{{ $ebook->deskripsi }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Pratinjau PDF -->
        <div class="mt-4">
            <h4 class="mb-3">Pratinjau PDF</h4>
            <div class="text-center">
                @if ($ebook->file)
                    <iframe id="pdfPreview" src="{{ asset($ebook->file) }}" width="100%" height="600px"
                        class="shadow-sm"></iframe>
                @else
                    <p class="text-danger">File PDF tidak ditemukan.</p>
                @endif
            </div>
        </div> --}}
    </div>
@endsection

@section('scripts')
    <script>
        // Menambahkan fungsi untuk mengaktifkan full screen pada iframe
        document.getElementById('fullscreenBtn')?.addEventListener('click', function() {
            var iframe = document.getElementById('pdfPreview');
            if (iframe.requestFullscreen) {
                iframe.requestFullscreen();
            } else if (iframe.mozRequestFullScreen) { // Firefox
                iframe.mozRequestFullScreen();
            } else if (iframe.webkitRequestFullscreen) { // Chrome, Safari, Opera
                iframe.webkitRequestFullscreen();
            } else if (iframe.msRequestFullscreen) { // IE/Edge
                iframe.msRequestFullscreen();
            }
        });
    </script>
@endsection
