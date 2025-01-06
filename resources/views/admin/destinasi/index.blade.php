@extends('admin.layouts.main', ['title' => 'Daftar Destinasi'])

@section('main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">List Destinasi</h5>

                        <!-- Tombol Add Destinasi -->
                        <a href="{{ route('destinations.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add Destinasi
                        </a>
                    </div>

                    <!-- Table with stripped rows -->
                    <table id="destinationsTable" class="table datatable">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($destinations as $destination)
                                <tr>
                                    <td><img src="{{ $destination->image }}" alt="Gambar Destinasi" width="70">
                                    </td>
                                    <td>{{ $destination->name }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('destinations.edit', $destination->slug) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $destination->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <!-- Form Hapus -->
                                        <form id="delete-form-{{ $destination->id }}"
                                            action="{{ route('destinations.destroy', $destination->slug) }}" method="POST"
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
@endsection
