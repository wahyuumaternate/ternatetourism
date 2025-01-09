@extends('admin.layouts.main', ['title' => 'Daftar Ekraf'])

@section('main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">List Ekraf</h5>

                        <!-- Tombol Add Ekraf -->
                        <a href="{{ route('ekrafs.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add Ekraf
                        </a>
                    </div>

                    <!-- Table with stripped rows -->
                    <table id="ekrafTable" class="table datatable">
                        <thead>
                            <tr>
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
@endsection
