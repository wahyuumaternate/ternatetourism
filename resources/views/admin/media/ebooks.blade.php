@extends('admin.layouts.main', ['title' => 'Manajemen E-Book'])

@section('main')
    {{-- Tabel E-Book --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Manajemen E-Book</h5>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#uploadModal">
                            <i class="bi bi-plus-circle"></i> Tambah E-Book
                        </button>
                    </div>

                    <table id="ebookTable" class="table datatable">
                        <thead>
                            <tr>
                                <th>Gambar Sampul</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Tanggal Terbit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ebooks as $ebook)
                                <tr>
                                    <td style="vertical-align: middle;">
                                        <img src="{{ asset($ebook->gambar_sampul) }}" alt="Sampul E-Book" width="70">
                                    </td>
                                    <td style="vertical-align: middle;">{{ $ebook->judul }}</td>
                                    <td style="vertical-align: middle;">{{ $ebook->penulis }}</td>
                                    <td style="vertical-align: middle;">
                                        {{ $ebook->tanggal_terbit ? $ebook->tanggal_terbit->format('d/m/Y') : '-' }}</td>
                                    <td style="vertical-align: middle;">
                                        <!-- Tombol Detail -->
                                        <a href="{{ route('ebooks.show', $ebook->kode_buku) }}"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $ebook->kode_buku }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                            onclick="confirmDelete('{{ $ebook->kode_buku }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $ebook->kode_buku }}"
                                            action="{{ route('ebooks.destroy', $ebook->kode_buku) }}" method="POST"
                                            style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </td>
                                </tr>

                                {{-- Edit Modal --}}
                                <div class="modal fade" id="editModal{{ $ebook->kode_buku }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit E-Book</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('ebooks.update', $ebook->kode_buku) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="judul" class="form-label">Judul</label>
                                                        <input type="text"
                                                            class="form-control @error('judul') is-invalid @enderror"
                                                            name="judul" value="{{ old('judul', $ebook->judul) }}"
                                                            required>
                                                        @error('judul')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="penulis" class="form-label">Penulis</label>
                                                        <input type="text"
                                                            class="form-control @error('penulis') is-invalid @enderror"
                                                            name="penulis" value="{{ old('penulis', $ebook->penulis) }}"
                                                            required>
                                                        @error('penulis')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3">{{ old('deskripsi', $ebook->deskripsi) }}</textarea>
                                                        @error('deskripsi')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="jumlah_halaman" class="form-label">Jumlah
                                                            Halaman</label>
                                                        <input type="number"
                                                            class="form-control @error('jumlah_halaman') is-invalid @enderror"
                                                            name="jumlah_halaman"
                                                            value="{{ old('jumlah_halaman', $ebook->jumlah_halaman) }}">
                                                        @error('jumlah_halaman')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="penerbit" class="form-label">Penerbit</label>
                                                        <input type="text"
                                                            class="form-control @error('penerbit') is-invalid @enderror"
                                                            name="penerbit"
                                                            value="{{ old('penerbit', $ebook->penerbit) }}">
                                                        @error('penerbit')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tanggal_terbit" class="form-label">Tanggal
                                                            Terbit</label>
                                                        <input type="date"
                                                            class="form-control @error('tanggal_terbit') is-invalid @enderror"
                                                            name="tanggal_terbit"
                                                            value="{{ old('tanggal_terbit', $ebook->tanggal_terbit) }}">
                                                        @error('tanggal_terbit')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="kategori" class="form-label">Kategori</label>
                                                        <input type="text"
                                                            class="form-control @error('kategori') is-invalid @enderror"
                                                            name="kategori"
                                                            value="{{ old('kategori', $ebook->kategori) }}">
                                                        @error('kategori')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="bahasa" class="form-label">Bahasa</label>
                                                        <input type="text"
                                                            class="form-control @error('bahasa') is-invalid @enderror"
                                                            name="bahasa" value="{{ old('bahasa', $ebook->bahasa) }}">
                                                        @error('bahasa')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="file" class="form-label">File E-Book</label>
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control @error('file') is-invalid @enderror"
                                                                id="file-url-edit-{{ $ebook->id }}" name="file"
                                                                value="{{ old('file', $ebook->file) }}" readonly>
                                                            <button class="btn btn-outline-primary" type="button"
                                                                onclick="openFileManager({{ $ebook->id }})">Pilih
                                                                File</button>
                                                        </div>
                                                        @error('file')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="gambar_sampul" class="form-label">Gambar
                                                            Sampul</label>
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control @error('gambar_sampul') is-invalid @enderror"
                                                                id="cover-url-edit-{{ $ebook->id }}"
                                                                name="gambar_sampul"
                                                                value="{{ old('gambar_sampul', $ebook->gambar_sampul) }}"
                                                                readonly>
                                                            <button class="btn btn-outline-primary" type="button"
                                                                onclick="openCoverManager({{ $ebook->id }})">Pilih
                                                                Sampul</button>
                                                        </div>
                                                        @error('gambar_sampul')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-outline-primary">Update</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Upload Modal --}}
    <div class="modal fade" id="uploadModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah E-Book Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('ebooks.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                name="judul" value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" class="form-control @error('penulis') is-invalid @enderror"
                                name="penulis" value="{{ old('penulis') }}" required>
                            @error('penulis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                            <input type="number" class="form-control @error('jumlah_halaman') is-invalid @enderror"
                                name="jumlah_halaman" value="{{ old('jumlah_halaman') }}">
                            @error('jumlah_halaman')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" class="form-control @error('penerbit') is-invalid @enderror"
                                name="penerbit" value="{{ old('penerbit') }}">
                            @error('penerbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_terbit" class="form-label">Tanggal Terbit</label>
                            <input type="date" class="form-control @error('tanggal_terbit') is-invalid @enderror"
                                name="tanggal_terbit" value="{{ old('tanggal_terbit') }}">
                            @error('tanggal_terbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                                name="kategori" value="{{ old('kategori') }}">
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bahasa" class="form-label">Bahasa</label>
                            <input type="text" class="form-control @error('bahasa') is-invalid @enderror"
                                name="bahasa" value="{{ old('bahasa') }}" required>
                            @error('bahasa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">File E-Book</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('file') is-invalid @enderror"
                                    id="file-url" name="file" readonly value="{{ old('file') }}">
                                <button class="btn btn-outline-secondary" type="button" id="select-file">Pilih
                                    File</button>
                            </div>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="gambar_sampul" class="form-label">Gambar Sampul</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('gambar_sampul') is-invalid @enderror"
                                    id="cover-url" name="gambar_sampul" readonly value="{{ old('gambar_sampul') }}">
                                <button class="btn btn-outline-secondary" type="button" id="select-cover">Pilih
                                    Sampul</button>
                            </div>
                            @error('gambar_sampul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-outline-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Pilih file e-book
        document.getElementById('select-file').addEventListener('click', function() {
            let route_prefix = "{{ url('filemanager') }}";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');

            window.SetUrl = function(items) {
                document.getElementById('file-url').value = items[0].url;
            };
        });

        // Pilih gambar sampul
        document.getElementById('select-cover').addEventListener('click', function() {
            let route_prefix = "{{ url('filemanager') }}";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');

            window.SetUrl = function(items) {
                document.getElementById('cover-url').value = items[0].url;
            };
        });

        // Konfirmasi hapus
    </script>
    <script>
        // Fungsi untuk memilih file e-book
        function openFileManager(id) {
            let route_prefix = "{{ url('filemanager') }}";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');

            window.SetUrl = function(items) {
                document.getElementById(`file-url-edit-${id}`).value = items[0].url;
            };
        }

        // Fungsi untuk memilih gambar sampul
        function openCoverManager(id) {
            let route_prefix = "{{ url('filemanager') }}";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');

            window.SetUrl = function(items) {
                document.getElementById(`cover-url-edit-${id}`).value = items[0].url;
            };
        }
    </script>
@endsection
