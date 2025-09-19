@extends('admin.layouts.main', ['title' => 'Daftar Ekraf'])

@section('head')
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">List Ekraf</h5>

                        <div class="d-flex gap-2">
                            <!-- Tombol Bulk Delete -->
                            <button type="button" class="btn btn-danger" id="bulkDeleteBtn" style="display:none;">
                                <i class="bi bi-trash"></i> Hapus Terpilih
                            </button>

                            <!-- Tombol Add Ekraf -->
                            <a href="{{ route('ekrafs.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Add Ekraf
                            </a>
                        </div>
                    </div>

                    <!-- Form untuk bulk delete -->
                    <form id="bulkDeleteForm" action="{{ route('ekrafs.bulk-destroy') }}" method="POST"
                        style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <!-- Table with stripped rows -->
                    <table id="ekrafTable" class="table datatable">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th>Logo</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Alamat</th>
                                <th>Jumlah Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ekrafs as $item)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="item-checkbox" value="{{ $item->id }}">
                                    </td>
                                    <td>
                                        @if ($item->logo)
                                            <img src="{{ $item->logo }}" alt="Logo" width="70">
                                        @else
                                            <span class="text-muted">No Logo</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->address ?? '-' }}</td>
                                    <td>{{ $item->jumlah_produk }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('ekrafs.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $item->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('ekrafs.destroy', $item->id) }}" method="POST"
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

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- JavaScript untuk bulk delete -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('selectAll');
            const itemCheckboxes = document.querySelectorAll('.item-checkbox');
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
            const bulkDeleteForm = document.getElementById('bulkDeleteForm');

            // Handle select all checkbox
            selectAllCheckbox.addEventListener('change', function() {
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                toggleBulkDeleteButton();
            });

            // Handle individual checkboxes
            itemCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    // Update select all checkbox
                    const checkedCount = document.querySelectorAll('.item-checkbox:checked').length;
                    selectAllCheckbox.checked = checkedCount === itemCheckboxes.length;
                    selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount <
                        itemCheckboxes.length;

                    toggleBulkDeleteButton();
                });
            });

            // Show/hide bulk delete button
            function toggleBulkDeleteButton() {
                const checkedItems = document.querySelectorAll('.item-checkbox:checked');
                bulkDeleteBtn.style.display = checkedItems.length > 0 ? 'block' : 'none';
            }

            // Handle bulk delete button click with SweetAlert
            bulkDeleteBtn.addEventListener('click', function() {
                const checkedItems = document.querySelectorAll('.item-checkbox:checked');

                if (checkedItems.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Pilih minimal satu item untuk dihapus!',
                        confirmButtonColor: '#3085d6'
                    });
                    return;
                }

                const itemCount = checkedItems.length;
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: `Apakah Anda yakin ingin menghapus ${itemCount} item yang dipilih?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Clear existing hidden inputs
                        bulkDeleteForm.querySelectorAll('input[name="ids[]"]').forEach(input =>
                            input.remove());

                        // Add selected IDs to form
                        checkedItems.forEach(checkbox => {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'ids[]';
                            input.value = checkbox.value;
                            bulkDeleteForm.appendChild(input);
                        });

                        // Show loading
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Sedang memproses penghapusan data',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Submit form
                        bulkDeleteForm.submit();
                    }
                });
            });
        });

        // Function untuk delete individual item dengan SweetAlert
        function confirmDelete(id) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus item ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Sedang memproses penghapusan data',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        // Handle success/error notifications dari server
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#3085d6'
            });
        @endif
    </script>
@endsection
