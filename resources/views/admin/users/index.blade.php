@extends('admin.layouts.main', ['title' => 'Users'])

@section('main')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Users List</h5>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                    Add User
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="ebookTable" class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if ($user->name != 'Admin')
                                            <button type="button" class="btn btn-sm btn-warning"
                                                onclick="editUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}')">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            {{-- <form action="{{ route('users.destroy', $user->id) }}" method="POST"
class="d-inline"
onsubmit="return confirm('Are you sure you want to delete this user?')">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-sm btn-danger">
    <i class="bi bi-trash"></i>
</button>
</form> --}}
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                onclick="confirmDelete('{{ $user->id }}')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <form id="delete-form-{{ $user->id }}"
                                                action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <div class="mt-4">
                    {{ $users->links() }}
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Create User Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('users.store') }}" method="POST" id="createUserForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Create New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create_name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="create_name"
                                name="name" required value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="create_email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="create_email" name="email" required value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="create_password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="create_password" name="password" required minlength="8">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePassword('create_password')">
                                    <i class="bi bi-eye" id="create_password_icon"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="progress mt-2" style="height: 5px;">
                                <div id="create-password-strength" class="progress-bar" role="progressbar"
                                    style="width: 0%"></div>
                            </div>
                            <small class="text-muted">
                                Password strength: <span id="create-strength-text">None</span>
                                <br>Password must be at least 8 characters
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="create_password_confirmation" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="create_password_confirmation" name="password_confirmation" required minlength="8">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePassword('create_password_confirmation')">
                                    <i class="bi bi-eye" id="create_password_confirmation_icon"></i>
                                </button>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Display any general errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary submit-btn" id="createSubmitBtn"
                            disabled>Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_password" class="form-label">New Password (optional)</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="edit_password" name="password"
                                    minlength="8">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePassword('edit_password')">
                                    <i class="bi bi-eye" id="edit_password_icon"></i>
                                </button>
                            </div>
                            <div class="progress mt-2" style="height: 5px;">
                                <div id="edit-password-strength" class="progress-bar" role="progressbar"
                                    style="width: 0%"></div>
                            </div>
                            <small class="text-muted">
                                Password strength: <span id="edit-strength-text">None</span>
                                <br>Leave blank to keep current password
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_password" class="form-label">New Password (optional)</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="edit_password" name="password"
                                    minlength="8">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePassword('edit_password')">
                                    <i class="bi bi-eye" id="edit_password_icon"></i>
                                </button>
                            </div>
                            <div class="progress mt-2" style="height: 5px;">
                                <div id="edit-password-strength" class="progress-bar" role="progressbar"
                                    style="width: 0%"></div>
                            </div>
                            <small class="text-muted">
                                Password strength: <span id="edit-strength-text">None</span>
                                <br>Leave blank to keep current password
                            </small>
                        </div>
                        <div class="mb-3">
                            <label for="edit_password_confirmation" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="edit_password_confirmation"
                                    name="password_confirmation" minlength="8">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePassword('edit_password_confirmation')">
                                    <i class="bi bi-eye" id="edit_password_confirmation_icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary" id="editSubmitBtn">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background-color: #f8f9fa;
            border-color: #dee2e6;
            color: #6c757d;
        }
    </style>
@endsection

@section('scripts')
    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + '_icon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }

        function validateCreatePassword() {
            const password = document.getElementById('create_password').value;
            const confirmation = document.getElementById('create_password_confirmation').value;
            const name = document.getElementById('create_name').value;
            const email = document.getElementById('create_email').value;
            const submitBtn = document.getElementById('createSubmitBtn');

            const isValid = password.length >= 8 &&
                password === confirmation &&
                name.length > 0 &&
                email.length > 0;

            submitBtn.disabled = !isValid;
        }

        function updatePasswordStrength(password, strengthBarId, strengthTextId) {
            const strengthBar = document.getElementById(strengthBarId);
            const strengthText = document.getElementById(strengthTextId);

            let strength = 0;

            if (password.length >= 8) strength += 20;
            if (password.match(/[A-Z]/)) strength += 20;
            if (password.match(/[a-z]/)) strength += 20;
            if (password.match(/[0-9]/)) strength += 20;
            if (password.match(/[^A-Za-z0-9]/)) strength += 20;

            strengthBar.style.width = strength + '%';

            if (strength <= 20) {
                strengthBar.className = 'progress-bar bg-danger';
                strengthText.textContent = 'Very Weak';
            } else if (strength <= 40) {
                strengthBar.className = 'progress-bar bg-warning';
                strengthText.textContent = 'Weak';
            } else if (strength <= 60) {
                strengthBar.className = 'progress-bar bg-info';
                strengthText.textContent = 'Medium';
            } else if (strength <= 80) {
                strengthBar.className = 'progress-bar bg-primary';
                strengthText.textContent = 'Strong';
            } else {
                strengthBar.className = 'progress-bar bg-success';
                strengthText.textContent = 'Very Strong';
            }
        }

        // Add event listeners for create form
        document.getElementById('create_password').addEventListener('input', function() {
            validateCreatePassword();
            updatePasswordStrength(this.value, 'create-password-strength', 'create-strength-text');
        });
        document.getElementById('create_password_confirmation').addEventListener('input', validateCreatePassword);
        document.getElementById('create_name').addEventListener('input', validateCreatePassword);
        document.getElementById('create_email').addEventListener('input', validateCreatePassword);

        // Add event listener for edit form password
        document.getElementById('edit_password').addEventListener('input', function() {
            updatePasswordStrength(this.value, 'edit-password-strength', 'edit-strength-text');
        });

        // function editUser(id, name, email) {
        //     const form = document.getElementById('editUserForm');
        //     form.action = `/users/${id}`;

        //     document.getElementById('edit_name').value = name;
        //     document.getElementById('edit_email').value = email;
        //     document.getElementById('edit_password').value = '';

        //     const strengthBar = document.getElementById('edit-password-strength');
        //     const strengthText = document.getElementById('edit-strength-text');
        //     strengthBar.style.width = '0%';
        //     strengthText.textContent = 'None';

        //     new bootstrap.Modal(document.getElementById('editUserModal')).show();
        // }
        // Di bagian script, tambahkan fungsi untuk validasi form edit
        function validateEditForm() {
            const password = document.getElementById('edit_password').value;
            const confirmation = document.getElementById('edit_password_confirmation').value;
            const submitBtn = document.getElementById('editSubmitBtn');

            if (password || confirmation) {
                if (password !== confirmation || password.length < 8) {
                    submitBtn.disabled = true;
                    return;
                }
            }

            submitBtn.disabled = false;
        }

        // Add event listeners for edit form password fields
        document.getElementById('edit_password').addEventListener('input', function() {
            updatePasswordStrength(this.value, 'edit-password-strength', 'edit-strength-text');
            validateEditForm();
        });
        document.getElementById('edit_password_confirmation').addEventListener('input', validateEditForm);

        // Update editUser function
        function editUser(id, name, email) {
            const form = document.getElementById('editUserForm');
            form.action = `/dashboard/users/${id}`;

            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_password').value = '';
            document.getElementById('edit_password_confirmation').value = '';
            document.getElementById('editSubmitBtn').disabled = false;

            const strengthBar = document.getElementById('edit-password-strength');
            const strengthText = document.getElementById('edit-strength-text');
            strengthBar.style.width = '0%';
            strengthText.textContent = 'None';

            new bootstrap.Modal(document.getElementById('editUserModal')).show();
        }
    </script>
@endsection
