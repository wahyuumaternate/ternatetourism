@extends('admin.layouts.main', ['title' => 'Visi & Misi'])

@section('main')
    <!-- Reports -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Visi & Misi</h5>

                <form action="{{ route('visimisi.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="detail" class="form-label">Content</label>
                        <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $visi->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-outline-primary">Save</button>
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
                editor.on('NodeChange', function(e) {
                    // Periksa apakah elemen yang diubah adalah gambar
                    if (e.element && e.element.nodeName === 'IMG') {
                        e.element.style.maxWidth =
                            '100%'; // Batasi lebar maksimum gambar ke 100% kontainer
                        e.element.style.height = 'auto'; // Pastikan aspek rasio terjaga
                    }
                });
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
    </script>
@endsection
