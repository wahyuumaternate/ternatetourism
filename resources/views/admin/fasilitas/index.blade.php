@extends('admin.layouts.main', ['title' => 'Daftar Fasilitas'])

@section('main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">List Fasilitas {{ $kategori }}</h5>

                        <!-- Tombol Add Fasilitas -->
                        <a href="{{ route('fasilitas.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add Fasilitas
                        </a>
                    </div>

                    <!-- Table with stripped rows -->
                    <table id="fasilitasTable" class="table datatable">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fasilitas as $item)
                                <tr>
                                    <td><img src="{{ $item->gambar }}" alt="" width="70"></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('fasilitas.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $item->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('fasilitas.destroy', $item->id) }}" method="POST"
                                            style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDelete(id) {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    document.getElementById('delete-form-' + id).submit();
                }
            }
        </script>
    @endpush
@endsection
