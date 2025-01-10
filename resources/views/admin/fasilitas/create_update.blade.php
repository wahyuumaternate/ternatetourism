@extends('admin.layouts.main', ['title' => isset($fasilitas) ? 'Edit Fasilitas' : 'Tambah Fasilitas'])

@section('main')
    <!-- Reports -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ isset($fasilitas) ? 'Edit Fasilitas' : 'Tambah Fasilitas' }}</h5>

                <form action="{{ isset($fasilitas) ? route('fasilitas.update', $fasilitas->id) : route('fasilitas.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($fasilitas))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $fasilitas->name ?? '') }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                            name="slug" value="{{ old('slug', $fasilitas->slug ?? '') }}" readonly>
                        @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select @error('kategori') is-invalid @enderror" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="hotel"
                                {{ old('kategori', $fasilitas->kategori ?? '') == 'hotel' ? 'selected' : '' }}>Hotel
                            </option>
                            <option value="travel"
                                {{ old('kategori', $fasilitas->kategori ?? '') == 'travel' ? 'selected' : '' }}>Travel
                            </option>
                            <option value="cafe-restorant"
                                {{ old('kategori', $fasilitas->kategori ?? '') == 'cafe-restorant' ? 'selected' : '' }}>
                                Cafe & Restorant</option>
                            <option value="umkm"
                                {{ old('kategori', $fasilitas->kategori ?? '') == 'umkm' ? 'selected' : '' }}>UMKM
                            </option>
                            <option value="guide"
                                {{ old('kategori', $fasilitas->kategori ?? '') == 'guide' ? 'selected' : '' }}>Guide
                            </option>
                            <option value="rent-car"
                                {{ old('kategori', $fasilitas->kategori ?? '') == 'rent-car' ? 'selected' : '' }}>Rent
                                Car</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $fasilitas->deskripsi ?? '') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar URL</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('gambar') is-invalid @enderror" id="image-url"
                                name="gambar" value="{{ old('gambar', $fasilitas->gambar ?? '') }}" readonly>
                            <button class="btn btn-outline-secondary" type="button" id="select-image">Pilih Gambar</button>
                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Preview Image -->
                    <div class="mb-3" id="image-preview-container"
                        style="{{ isset($fasilitas) ? '' : 'display: none;' }}">
                        <label for="image-preview" class="form-label">Preview Gambar</label>
                        <img id="image-preview" src="{{ $fasilitas->gambar ?? '#' }}" alt="Preview Gambar"
                            class="img-thumbnail" style="max-width: 100%; height: auto;">
                    </div>

                    <button type="submit" class="btn btn-outline-primary">
                        {{ isset($fasilitas) ? 'Update Fasilitas' : 'Simpan Fasilitas' }}
                    </button>
                </form>

            </div>
        </div>
    </div><!-- End Reports -->
@endsection

@section('scripts')
    <script>
        tinymce.init({
            selector: '#deskripsi',
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
    </script>
    <script>
        document.getElementById('select-image').addEventListener('click', function() {
            let route_prefix = "{{ url('filemanager') }}";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');

            window.SetUrl = function(items) {
                let file_url = items[0].url;
                document.getElementById('image-url').value = file_url;

                let imagePreview = document.getElementById('image-preview');
                imagePreview.src = file_url;
                document.getElementById('image-preview-container').style.display = 'block';
            };
        });
    </script>
@endsection
