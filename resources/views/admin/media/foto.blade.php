@extends('admin.layouts.main', ['title' => 'Galeri Photo'])

@section('main')

    {{-- Galeri Table --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Galeri Photo</h5>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#uploadModal">
                            <i class="bi bi-plus-circle"></i> Tambah Photo
                        </button>
                    </div>

                    <table id="mediaTable" class="table datatable">
                        <thead>
                            <tr>
                                <th>File</th>
                                <th>Judul</th>
                                <th>Tanggal Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($media as $item)
                                <tr>
                                    <td>
                                        @if ($item->type == 'photo')
                                            <img src="{{ asset($item->file) }}" alt="{{ $item->title }}" width="70">
                                        @else
                                            <video width="70" controls>
                                                <source src="{{ asset($item->file) }}" type="video/mp4">
                                            </video>
                                        @endif
                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td>
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

                                {{-- Edit Modal --}}
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
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Judul</label>
                                                        <input type="text"
                                                            class="form-control @error('title') is-invalid @enderror"
                                                            name="title" value="{{ old('title', $item->title) }}"
                                                            required>
                                                        @error('title')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Deskripsi</label>
                                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" required>{{ old('description', $item->description) }}</textarea>
                                                        @error('description')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="type" value="photo">
                                                    <div class="mb-3">
                                                        <label class="form-label">File</label>
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control @error('file') is-invalid @enderror"
                                                                id="image-url-edit-{{ $item->id }}" name="file"
                                                                value="{{ old('file', $item->file) }}" readonly>
                                                            <button class="btn btn-outline-primary" type="button"
                                                                onclick="openFileManager({{ $item->id }})">Pilih
                                                                Media</button>
                                                        </div>
                                                        @error('file')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 d-flex justify-content-center">
                                                        <div id="image-preview-container-edit-{{ $item->id }}">
                                                            <img src="{{ asset($item->file) }}"
                                                                id="image-preview-edit-{{ $item->id }}"
                                                                class="img-fluid" alt="Preview" width="200">
                                                        </div>
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
                    <h5 class="modal-title">Tambah Media Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('media.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="type" value="photo">
                        <div class="mb-3">
                            <label for="file" class="form-label">File</label>
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
                        <div class="mb-3" id="image-preview-container" style="display: none;">
                            <label class="form-label">Preview</label>
                            <img id="image-preview" class="img-fluid" alt="Preview">
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
        // Untuk memilih file di FileManager
        document.getElementById('select-file').addEventListener('click', function() {
            let route_prefix = "{{ url('filemanager') }}";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');

            window.SetUrl = function(items) {
                let file_url = items[0].url;
                document.getElementById('file-url').value = file_url;
                let imagePreview = document.getElementById('image-preview');
                imagePreview.src = file_url;
                document.getElementById('image-preview-container').style.display = 'block';
            };
        });

        // Untuk edit modal file
        function openFileManager(id) {
            let route_prefix = "{{ url('filemanager') }}";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');

            window.SetUrl = function(items) {
                let file_url = items[0].url;
                document.getElementById(`image-url-edit-${id}`).value = file_url;
                let imagePreview = document.getElementById(`image-preview-edit-${id}`);
                imagePreview.src = file_url;
            };
        }

        // Konfirmasi hapus
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus media ini?')) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        }
    </script>
@endsection
