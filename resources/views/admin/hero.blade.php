@extends('admin.layouts.main', ['title' => 'Hero'])

@section('main')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Hero List</h5>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#createHeroModal">
                    Add Hero
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="heroTable" class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($heroes as $hero)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ $hero->image }}" alt="Hero Image"
                                            style="max-height: 50px;max-width: 70px;">
                                    </td>
                                    <td>{{ $hero->title }}</td>
                                    <td>{{ $hero->description }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning"
                                            onclick="editHero({{ $hero->id }}, '{{ $hero->image }}', '{{ $hero->title }}', '{{ $hero->description }}')">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                            onclick="confirmDelete('{{ $hero->id }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $hero->id }}"
                                            action="{{ route('heroes.destroy', $hero->id) }}" method="POST"
                                            style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Hero Modal -->
    <div class="modal fade" id="createHeroModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('heroes.store') }}" method="POST" id="createHeroForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Hero</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create_image" class="form-label">Image URL</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="create_image" name="image" required>
                                <button class="btn btn-outline-secondary" type="button" id="create-select-image">
                                    <i class="bi bi-image"></i> Choose
                                </button>
                            </div>
                            <div id="create-image-preview-container" style="display: none; margin-top: 10px;">
                                <img id="create-image-preview" class="img-fluid" style="max-height: 200px;">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="create_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="create_title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="create_description" class="form-label">Description</label>
                            <textarea class="form-control" id="create_description" name="description" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary">Create Hero</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Hero Modal -->
    <div class="modal fade" id="editHeroModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editHeroForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Hero</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_image" class="form-label">Image URL</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="edit_image" name="image" required>
                                <button class="btn btn-outline-secondary" type="button" id="edit-select-image">
                                    <i class="bi bi-image"></i> Choose
                                </button>
                            </div>
                            <div id="edit-image-preview-container" style="display: none; margin-top: 10px;">
                                <img id="edit-image-preview" class="img-fluid" style="max-height: 200px;">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="edit_title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit_description" name="description" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary">Update Hero</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function editHero(id, image, title, description) {
            const form = document.getElementById('editHeroForm');
            form.action = `/dashboard/heroes/${id}`;

            document.getElementById('edit_image').value = image;
            document.getElementById('edit_title').value = title;
            document.getElementById('edit_description').value = description;

            // Show image preview if image exists
            if (image) {
                document.getElementById('edit-image-preview').src = image;
                document.getElementById('edit-image-preview-container').style.display = 'block';
            }

            new bootstrap.Modal(document.getElementById('editHeroModal')).show();
        }



        // Image manager for create modal
        document.getElementById('create-select-image').addEventListener('click', function() {
            let route_prefix = "{{ url('filemanager') }}";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');

            window.SetUrl = function(items) {
                let file_url = items[0].url;
                document.getElementById('create_image').value = file_url;

                let imagePreview = document.getElementById('create-image-preview');
                imagePreview.src = file_url;
                document.getElementById('create-image-preview-container').style.display = 'block';
            };
        });

        // Image manager for edit modal
        document.getElementById('edit-select-image').addEventListener('click', function() {
            let route_prefix = "{{ url('filemanager') }}";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');

            window.SetUrl = function(items) {
                let file_url = items[0].url;
                document.getElementById('edit_image').value = file_url;

                let imagePreview = document.getElementById('edit-image-preview');
                imagePreview.src = file_url;
                document.getElementById('edit-image-preview-container').style.display = 'block';
            };
        });
    </script>
@endsection
