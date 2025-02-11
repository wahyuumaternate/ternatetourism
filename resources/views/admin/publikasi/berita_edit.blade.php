@extends('admin.layouts.main', ['title' => 'Edit Berita'])

@section('main')
    <!-- Reports -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Berita</h5>

                <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title', $berita->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                            name="slug" value="{{ old('slug', $berita->slug) }}" readonly>
                        @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Konten</label>
                        <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror">{{ old('content', $berita->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('image') is-invalid @enderror" id="image-url"
                                name="image" value="{{ old('image', $berita->image) }}" readonly>
                            <button class="btn btn-outline-secondary" type="button" id="select-image">Pilih Gambar</button>
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Preview Image -->
                    <div class="mb-3" id="image-preview-container"
                        style="display: {{ $berita->image ? 'block' : 'none' }};">
                        <label for="image-preview" class="form-label">Preview Gambar</label>
                        <img id="image-preview" src="{{ $berita->image ? $berita->image : '#' }}" alt="Preview Gambar"
                            class="img-thumbnail" style="max-width: 100%; height: auto;">
                    </div>

                    <button type="submit" class="btn btn-outline-primary">Simpan Perubahan</button>
                </form>

            </div>
        </div>
    </div><!-- End Reports -->
@endsection

@section('scripts')
    <script>
        tinymce.init({
            selector: '#content',
            height: 500,
            menubar: 'file edit view insert format tools table help',
            plugins: [
                'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic underline strikethrough blockquote | forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | removeformat | table link image media | code fullscreen preview ',
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
    </script>
    <script>
        // Generate slug from title
        document.getElementById('title').addEventListener('keyup', function() {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^a-z0-9-]/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
            document.getElementById('slug').value = slug;
        });
    </script>
    <script>
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
