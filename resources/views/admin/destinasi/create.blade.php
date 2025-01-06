@extends('admin.layouts.main', ['title' => 'Tambah Destinasi'])

@section('main')
    <!-- Add Destination Form -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Destinasi</h5>

                <form action="{{ route('destinations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Destinasi</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                            name="slug" value="{{ old('slug') }}" readonly>
                        @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lat" class="form-label">Latitude</label>
                        <input type="text" class="form-control @error('lat') is-invalid @enderror" id="lat"
                            name="lat" value="{{ old('lat') }}" required>
                        @error('lat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="long" class="form-label">Longitude</label>
                        <input type="text" class="form-control @error('long') is-invalid @enderror" id="long"
                            name="long" value="{{ old('long') }}" required>
                        @error('long')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('image') is-invalid @enderror" id="image-url"
                                name="image" readonly>
                            <button class="btn btn-outline-secondary" type="button" id="select-image">Pilih Gambar</button>
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Preview Image -->
                    <div class="mb-3" id="image-preview-container" style="display: none;">
                        <label for="image-preview" class="form-label">Preview Gambar</label>
                        <img id="image-preview" src="#" alt="Preview Gambar" class="img-thumbnail"
                            style="max-width: 100%; height: auto;">
                    </div>

                    <button type="submit" class="btn btn-outline-primary">Simpan Destinasi</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        tinymce.init({
            selector: '#description',
            height: 500,
            menubar: 'file edit view insert format tools table help',
            plugins: [
                'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | removeformat | table link image media | code fullscreen preview',
            toolbar_mode: 'sliding',
            content_css: [
                'https://www.tiny.cloud/css/codepen.min.css'
            ],
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
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
    </script>
    <script>
        // Generate slug from name
        document.getElementById('name').addEventListener('keyup', function() {
            const name = this.value;
            const slug = name.toLowerCase()
                .replace(/[^a-z0-9-]/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
            document.getElementById('slug').value = slug;
        });

        // Select image and preview
        document.getElementById('select-image').addEventListener('click', function() {
            let route_prefix = "{{ url('filemanager') }}"; // URL ke Laravel File Manager
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');

            // Fungsi untuk mengatur URL gambar
            window.SetUrl = function(items) {
                let file_url = items[0].url; // Ambil URL gambar
                document.getElementById('image-url').value = file_url; // Set URL ke input text

                // Menampilkan preview gambar
                let imagePreview = document.getElementById('image-preview');
                imagePreview.src = file_url;
                document.getElementById('image-preview-container').style.display =
                    'block'; // Menampilkan container preview
            };
        });
    </script>
@endsection
