@extends('admin.layouts.main', ['title' => 'Dashboard'])
@section('main')
    <!-- Reports -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Welcome Back {{ Auth::user()->name }}</h5>
            </div>
        </div>
    </div><!-- End Reports -->
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Visitors Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card visitors-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('dashboard', ['period' => 'today']) }}">Hari
                                            Ini</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('dashboard', ['period' => 'month']) }}">Bulan Ini</a></li>
                                    <li><a class="dropdown-item" href="{{ route('dashboard', ['period' => 'year']) }}">Tahun
                                            Ini</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Pengunjung <span>| Hari Ini</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $visitorCount ?? 0 }}</h6>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Data Pengunjung <span>| Hari Ini</span></h5>
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th>Alamat IP</th>
                                    <th>Lokasi</th>
                                    <th>Nehara</th>
                                    <th>Halaman Dikunjungi</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visitors as $visitor)
                                    <tr>
                                        <td>{{ $visitor->ip }}</td>
                                        <td>{{ $visitor->city ?? 'Tidak Diketahui' }},
                                            {{ $visitor->country ?? 'Tidak Diketahui' }}</td>
                                        <td>{{ $visitor->page_visited }}</td>
                                        <td>{{ $visitor->created_at->locale('id')->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
@endsection
