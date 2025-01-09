@extends('admin.layouts.main', ['title' => 'Edit Ekraf'])

@section('main')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Ekraf</h5>

                <form action="{{ route('ekrafs.update', $ekraf->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Ekraf</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $ekraf->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                            name="slug" value="{{ old('slug', $ekraf->slug) }}" readonly>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $ekraf->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('logo') is-invalid @enderror" id="logo-url"
                                name="logo" value="{{ old('logo', $ekraf->logo) }}" readonly>
                            <button class="btn btn-outline-secondary" type="button" id="select-logo">Pilih Logo</button>
                        </div>
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Preview Logo -->
                    <div class="mb-3" id="logo-preview-container" style="{{ $ekraf->logo ? '' : 'display: none;' }}">
                        <label class="form-label">Preview Logo</label>
                        <img id="logo-preview" src="{{ $ekraf->logo }}" alt="Preview Logo" class="img-thumbnail"
                            style="max-width: 200px; height: auto;">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $ekraf->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                            value="{{ old('address', $ekraf->address) }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone', $ekraf->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email', $ekraf->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" name="website"
                                value="{{ old('website', $ekraf->website) }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="social_media" class="form-label">Media Sosial</label>
                            <input type="text" class="form-control @error('social_media') is-invalid @enderror"
                                name="social_media" value="{{ old('social_media', $ekraf->social_media) }}">
                            @error('social_media')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_produk" class="form-label">Jumlah Produk</label>
                        <input type="number" class="form-control @error('jumlah_produk') is-invalid @enderror"
                            name="jumlah_produk" value="{{ old('jumlah_produk', $ekraf->jumlah_produk) }}" required>
                        @error('jumlah_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-outline-primary">Update</button>
                        <a href="{{ route('ekrafs.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // TinyMCE initialization
        tinymce.init({
            selector: '#description',
            height: 300,
            menubar: 'file edit view insert format tools table help',
            plugins: [
                'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | removeformat | table link image media | code fullscreen preview',
            toolbar_mode: 'sliding',
            content_css: ['https://www.tiny.cloud/css/codepen.min.css'],
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });

        // Generate slug from name
        document.getElementById('name').addEventListener('keyup', function() {
            const name = this.value;
            const slug = name.toLowerCase()
                .replace(/[^a-z0-9-]/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
            document.getElementById('slug').value = slug;
        });

        // Logo file manager
        document.getElementById('select-logo').addEventListener('click', function() {
            let route_prefix = "{{ url('filemanager') }}";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');

            window.SetUrl = function(items) {
                let file_url = items[0].url;
                document.getElementById('logo-url').value = file_url;

                let logoPreview = document.getElementById('logo-preview');
                logoPreview.src = file_url;
                document.getElementById('logo-preview-container').style.display = 'block';
            };
        });
    </script>
@endsection
