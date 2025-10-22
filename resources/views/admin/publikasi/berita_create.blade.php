@extends('backend.layouts.main')

@section('title', 'Tambah Berita Baru')
@section('page-title', 'Tambah Berita Baru')

@section('breadcrumb')
    <li class="breadcrumb-item">Website</li>
    <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Kelola Berita</a></li>
    <li class="breadcrumb-item active">Tambah Berita</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah Berita</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Kolom Kiri - Data Utama -->
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Berita <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                        id="judul" name="judul" value="{{ old('judul') }}" required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="konten" class="form-label">Konten Berita <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control tinymce-editor @error('konten') is-invalid @enderror" id="konten" name="konten"
                                        rows="10" required>{{ old('konten') }}</textarea>
                                    @error('konten')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Hidden slug field -->
                                <input type="hidden" id="slug" name="slug" value="{{ old('slug') }}">

                                <!-- Hidden excerpt field -->
                                <input type="hidden" id="excerpt" name="excerpt" value="{{ old('excerpt') }}">
                            </div>

                            <!-- Kolom Kanan - Data Pendukung -->
                            <div class="col-md-4">
                                <!-- Status Publikasi -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Status Publikasi</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select @error('status') is-invalid @enderror" id="status"
                                                name="status">
                                                <option value="draft"
                                                    {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                <option value="published"
                                                    {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="tanggal_publish" class="form-label">Tanggal Publikasi</label>
                                            <input type="datetime-local"
                                                class="form-control @error('tanggal_publish') is-invalid @enderror"
                                                id="tanggal_publish" name="tanggal_publish"
                                                value="{{ old('tanggal_publish') }}">
                                            <small class="text-muted">Untuk berita yang dijadwalkan.</small>
                                            @error('tanggal_publish')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="penulis" class="form-label">Penulis <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('penulis') is-invalid @enderror" id="penulis"
                                                name="penulis" value="{{ old('penulis', Auth::user()->name) }}" required>
                                            @error('penulis')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Kategori -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Kategori</h5>
                                    </div>
                                    <div class="card-body">
                                        <select class="form-select @error('kategori_id') is-invalid @enderror"
                                            id="kategori_id" name="kategori_id">
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}"
                                                    {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                    {{ $kategori->nama ?? $kategori->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Gambar Utama -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Gambar Utama</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="image-url" class="form-label">URL Gambar</label>
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control @error('gambar') is-invalid @enderror"
                                                    id="image-url" name="gambar" value="{{ old('gambar') }}" readonly>
                                                <button class="btn btn-primary" type="button" id="select-image">
                                                    <i class="bi bi-image"></i> Pilih Gambar
                                                </button>
                                            </div>
                                            <small class="d-block text-muted mt-2">Klik tombol untuk memilih gambar dari
                                                File Manager.</small>
                                            @error('gambar')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Preview Image -->
                                        <div id="image-preview-container"
                                            style="display: {{ old('gambar') ? 'block' : 'none' }};">
                                            <label class="form-label">Preview Gambar</label>
                                            <div>
                                                <img id="image-preview" src="{{ old('gambar') }}" alt="Preview Gambar"
                                                    class="img-thumbnail"
                                                    style="max-width: 100%; height: auto; border-radius: 5px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tags -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Tags</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" class="form-control @error('tags') is-invalid @enderror"
                                            id="tags" name="tags" value="{{ old('tags') }}"
                                            placeholder="Tag1, Tag2, Tag3">
                                        <small class="text-muted">Pisahkan dengan tanda koma (,)</small>
                                        @error('tags')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('berita.index') }}" class="btn btn-secondary me-2">
                                        <i class="bi bi-x-circle"></i> Batal
                                    </a>
                                    <button type="submit" name="save_action" value="save_as_draft"
                                        class="btn btn-success me-2">
                                        <i class="bi bi-file-earmark"></i> Simpan Draft
                                    </button>
                                    <button type="submit" name="save_action" value="publish" class="btn btn-primary">
                                        <i class="bi bi-send"></i> Publikasikan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .tox-promotion,
        .tox-statusbar__branding {
            display: none !important;
        }
    </style>
@endpush

@push('scripts')
    {{-- TinyMCE --}}
    <script src="{{ asset('backend/assets/vendor/tinymce/tinymce.min.js') }}"></script>

    <script>
        // Auto-generate slug from title
        document.getElementById('judul').addEventListener('keyup', function() {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^a-z0-9-]/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
            document.getElementById('slug').value = slug;
        });

        // TinyMCE Initialization dengan File Manager
        tinymce.init({
            selector: '#konten',
            height: 500,
            menubar: 'file edit view insert format tools table help',
            plugins: [
                'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic underline strikethrough blockquote | forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | removeformat | table link image media | code fullscreen preview',
            toolbar_mode: 'sliding',
            content_css: [
                'https://www.tiny.cloud/css/codepen.min.css'
            ],

            // Nonaktifkan beforeunload warning
            init_instance_callback: function(editor) {
                editor.on('BeforeSetContent', function(e) {
                    // Suppress warnings
                });
            },

            // File Manager untuk TinyMCE
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype === 'image') {
                    let route_prefix = "{{ url('filemanager') }}";
                    window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');
                    window.SetUrl = function(items) {
                        let file_url = items[0].url;
                        callback(file_url, {
                            alt: items[0].name
                        });
                    };
                }
            },

            // Setup untuk auto-resize gambar
            setup: function(editor) {
                editor.on('NodeChange', function(e) {
                    if (e.element && e.element.nodeName === 'IMG') {
                        e.element.style.maxWidth = '100%';
                        e.element.style.height = 'auto';
                    }
                });
                editor.on('change', function() {
                    editor.save();
                });
            }
        });

        // Button Pilih Gambar Utama - File Manager
        document.getElementById('select-image').addEventListener('click', function() {
            let route_prefix = "{{ url('filemanager') }}";

            // Buka File Manager dalam window popup
            window.open(route_prefix + '?type=file', 'FileManager', 'width=900,height=600');

            // Fungsi callback yang akan dipanggil oleh File Manager
            window.SetUrl = function(items) {
                console.log('File Manager callback triggered:', items); // Debug log

                // Ambil URL gambar yang dipilih
                let file_url = items[0].url;

                console.log('Selected image URL:', file_url); // Debug log

                // Set URL ke input field
                document.getElementById('image-url').value = file_url;

                // Update preview gambar
                let imagePreview = document.getElementById('image-preview');
                imagePreview.src = file_url;

                // Tampilkan container preview
                document.getElementById('image-preview-container').style.display = 'block';

                console.log('Image preview updated'); // Debug log
            };
        });
    </script>
@endpush
