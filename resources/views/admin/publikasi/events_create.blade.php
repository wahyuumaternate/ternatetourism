@extends('admin.layouts.main', ['title' => 'Create Event'])

@section('main')
    <!-- Reports -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Create Event</h5>

                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Event Name</label>
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
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                            name="location" value="{{ old('location') }}" required>
                        @error('location')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                            name="date" value="{{ old('date') }}" required>
                        @error('date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="time" class="form-label">Time</label>
                        <input type="time" class="form-control @error('time') is-invalid @enderror" id="time"
                            name="time" value="{{ old('time') }}" required>
                        @error('time')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="detail" class="form-label">Details</label>
                        <textarea id="detail" name="detail" class="form-control @error('detail') is-invalid @enderror" required>{{ old('detail') }}</textarea>
                        @error('detail')
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
                        <label for="poster" class="form-label">Poster</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('poster') is-invalid @enderror" id="poster-url"
                                name="poster" readonly>
                            <button class="btn btn-outline-secondary" type="button" id="select-poster">Select
                                Poster</button>
                            @error('poster')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Preview Poster -->
                    <div class="mb-3" id="poster-preview-container" style="display: none;">
                        <label for="poster-preview" class="form-label">Preview Poster</label>
                        <img id="poster-preview" src="#" alt="Preview Poster" class="img-thumbnail"
                            style="max-width: 100%; height: auto;">
                    </div>

                    <button type="submit" class="btn btn-outline-primary">Save Event</button>
                </form>

            </div>
        </div>
    </div><!-- End Reports -->
@endsection

@section('scripts')
    <script>
        tinymce.init({
            selector: '#detail',
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
        // Select poster
        document.getElementById('select-poster').addEventListener('click', function() {
            let route_prefix = "{{ url('filemanager') }}"; // URL ke Laravel File Manager
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');

            // Fungsi untuk mengatur URL poster
            window.SetUrl = function(items) {
                let file_url = items[0].url; // Ambil URL poster
                document.getElementById('poster-url').value = file_url; // Set URL ke input text

                // Menampilkan preview poster
                let posterPreview = document.getElementById('poster-preview');
                posterPreview.src = file_url;
                document.getElementById('poster-preview-container').style.display =
                    'block'; // Menampilkan container preview
            };
        });
    </script>
    <script>
        // Generate slug from title
        document.getElementById('name').addEventListener('keyup', function() {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^a-z0-9-]/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
            document.getElementById('slug').value = slug;
        });
    </script>
@endsection
