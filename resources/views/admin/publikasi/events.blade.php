@extends('admin.layouts.main', ['title' => 'Daftar Events'])

@section('main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">List Events</h5>

                        <!-- Tombol Add Event -->
                        <a href="{{ route('events.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add Event
                        </a>
                    </div>

                    <!-- Table with stripped rows -->
                    <table id="eventsTable" class="table datatable">
                        <thead>
                            <tr>
                                <th>Poster</th>
                                <th>Nama Event</th>
                                <th>Lokasi</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td><img src="{{ $event->poster }}" alt="" width="70"></td>
                                    <td>{{ $event->name }}</td>
                                    <td>{{ $event->location }}</td>
                                    <td>{{ $event->date }}</td>
                                    <td>{{ $event->time }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $event->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <form id="delete-form-{{ $event->id }}"
                                            action="{{ route('events.destroy', $event->id) }}" method="POST"
                                            style="display:none;">
                                            @csrf
                                            @method('DELETE')

                                            <!-- Tombol Hapus -->
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $event->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
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
