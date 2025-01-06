@extends('admin.layouts.main', ['title' => 'Galeri Video'])

@section('main')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Galeri Video</h5>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#uploadModal">
                            <i class="bi bi-plus-circle"></i> Tambah Video
                        </button>
                    </div>

                    <table id="mediaTable" class="table datatable">
                        <thead>
                            <tr>
                                <th>Video</th>
                                <th>Judul</th>
                                <th>Tanggal Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($media as $item)
                                <tr>
                                    <td style="vertical-align: middle;">
                                        @php
                                            // Mengambil ID video dari URL
                                            $videoUrl = $item->file; // Asumsi ini adalah url YouTube pengguna.
                                            preg_match(
                                                '/(?:youtu\.be\/|(?:www\.|m\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=))([^&\n]{11})/',
                                                $videoUrl,
                                                $matches,
                                            );
                                            $videoId = isset($matches[1]) ? $matches[1] : null;
                                        @endphp
                                        @if ($videoId)
                                            <iframe width="150" height="100"
                                                src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0"
                                                allowfullscreen></iframe>
                                        @else
                                            <p>Video tidak dapat diputar</p>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle;">{{ $item->title }}</td>
                                    <td style="vertical-align: middle;">{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td style="vertical-align: middle;">
                                        <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $item->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                            onclick="confirmDelete({{ $item->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('media.destroy', $item->id) }}" method="POST"
                                            style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Media</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('media.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" value="video" name="type">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Judul</label>
                                                        <input type="text" class="form-control" name="title"
                                                            value="{{ $item->title }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Description</label>
                                                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $item->description) }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="file" class="form-label">Link Video YouTube</label>
                                                        <input type="text" class="form-control"
                                                            id="youtube-url-edit-{{ $item->id }}" name="file"
                                                            value="{{ $item->file }}" required>
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

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Media Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('media.store') }}" method="POST" id="uploadForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                        </div>
                        <input type="hidden" value="video" name="type">
                        <div class="mb-3">
                            <label for="file" class="form-label">Link Video YouTube</label>
                            <input type="text" class="form-control @error('file') is-invalid @enderror"
                                id="youtube-url" name="file" required value="{{ old('file') }}">
                            @error('file')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
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
        // Delete confirmation
        function deleteMedia(id) {
            if (confirm('Apakah Anda yakin ingin menghapus media ini?')) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        }

        // Show modal again if there are validation errors
        @if ($errors->any())
            new bootstrap.Modal(document.getElementById('uploadModal')).show();
        @endif

        // Auto close alert messages after 5 seconds
        window.setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
@endsection
