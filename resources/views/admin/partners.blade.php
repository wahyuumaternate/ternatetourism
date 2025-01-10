@extends('admin.layouts.main', ['title' => 'Partners'])

@section('main')
    <div class="container-fluid">


        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Partners List</h5>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#createPartnerModal">
                    Add Partner
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="partnerTable" class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($partners as $partner)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ $partner->logo }}" alt="Partner Logo"
                                            style="max-height: 50px;max-width: 70px;">
                                    </td>
                                    <td>{{ $partner->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning"
                                            onclick="editPartner({{ $partner->id }}, '{{ $partner->logo }}', '{{ $partner->name }}')">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                            onclick="confirmDelete('{{ $partner->id }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $partner->id }}"
                                            action="{{ route('partners.destroy', $partner->id) }}" method="POST"
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

    <!-- Create Partner Modal -->
    <div class="modal fade" id="createPartnerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('partners.store') }}" method="POST" id="createPartnerForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Partner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create_logo" class="form-label">Logo URL</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="create_logo" name="logo" required>
                                <button class="btn btn-outline-secondary" type="button" id="create-select-logo">
                                    <i class="bi bi-image"></i> Choose
                                </button>
                            </div>
                            <div id="create-logo-preview-container" style="display: none; margin-top: 10px;">
                                <img id="create-logo-preview" class="img-fluid" style="max-height: 200px;">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="create_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="create_name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary">Create Partner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Partner Modal -->
    <div class="modal fade" id="editPartnerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editPartnerForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Partner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_logo" class="form-label">Logo URL</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="edit_logo" name="logo" required>
                                <button class="btn btn-outline-secondary" type="button" id="edit-select-logo">
                                    <i class="bi bi-image"></i> Choose
                                </button>
                            </div>
                            <div id="edit-logo-preview-container" style="display: none; margin-top: 10px;">
                                <img id="edit-logo-preview" class="img-fluid" style="max-height: 200px;">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary">Update Partner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function editPartner(id, logo, name) {
            const form = document.getElementById('editPartnerForm');
            form.action = `/dashboard/partners/${id}`;

            document.getElementById('edit_logo').value = logo;
            document.getElementById('edit_name').value = name;

            if (logo) {
                document.getElementById('edit-logo-preview').src = logo;
                document.getElementById('edit-logo-preview-container').style.display = 'block';
            }

            new bootstrap.Modal(document.getElementById('editPartnerModal')).show();
        }



        // Image manager for create modal
        document.getElementById('create-select-logo').addEventListener('click', function() {
            let route_prefix = "{{ url('filemanager') }}";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');

            window.SetUrl = function(items) {
                let file_url = items[0].url;
                document.getElementById('create_logo').value = file_url;

                let logoPreview = document.getElementById('create-logo-preview');
                logoPreview.src = file_url;
                document.getElementById('create-logo-preview-container').style.display = 'block';
            };
        });

        // Image manager for edit modal
        document.getElementById('edit-select-logo').addEventListener('click', function() {
            let route_prefix = "{{ url('filemanager') }}";
            window.open(route_prefix + '?type=file', 'FileManager', 'width=800,height=600');

            window.SetUrl = function(items) {
                let file_url = items[0].url;
                document.getElementById('edit_logo').value = file_url;

                let logoPreview = document.getElementById('edit-logo-preview');
                logoPreview.src = file_url;
                document.getElementById('edit-logo-preview-container').style.display = 'block';
            };
        });
    </script>
@endsection
