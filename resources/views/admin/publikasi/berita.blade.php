@extends('admin.layouts.main', ['title' => 'Daftar Berita'])

@section('main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">List Berita</h5>

                        <!-- Tombol Add Berita -->
                        <a href="{{ route('berita.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add Berita
                        </a>
                    </div>

                    <!-- Table with stripped rows -->
                    <table id="beritaTable" class="table datatable">
                        <thead>
                            <tr>

                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Views</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($berita as $item)
                                <tr>
                                    <td><img src="{{ $item->image }}" alt="" width="70"></td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->views }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('berita.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $item->id }})">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>

                                        {{-- <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('berita.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <!-- Tombol Hapus -->
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $item->id }})">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form> --}}

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
