@extends('admin.layouts.main', ['title' => 'Kontak Masuk'])

@section('main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Kontak Masuk dari Pengunjung</h5>

                        <!-- Export Button -->
                        <a href="{{ route('admin.kontak.export') }}" class="btn btn-outline-success">
                            <i class="bi bi-download"></i> Export Data
                        </a>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card border-warning">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-warning">{{ $statistik['baru'] ?? 0 }}</h5>
                                    <p class="card-text">Pesan Baru</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-info">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-info">{{ $statistik['dibaca'] ?? 0 }}</h5>
                                    <p class="card-text">Dibaca</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-primary">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-primary">{{ $statistik['diproses'] ?? 0 }}</h5>
                                    <p class="card-text">Diproses</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-success">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-success">{{ $statistik['selesai'] ?? 0 }}</h5>
                                    <p class="card-text">Selesai</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table with stripped rows -->
                    <table id="kontakTable" class="table datatable">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Subjek</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kontaks as $kontak)
                                <tr class="{{ $kontak->status == 'baru' ? 'table-warning' : '' }}">
                                    <td>{{ $kontak->tanggal_kontak->format('d/m/Y H:i') }}</td>
                                    <td>
                                        {{ $kontak->nama }}
                                        @if ($kontak->status == 'baru')
                                            <span class="badge bg-warning text-dark ms-1">Baru</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $kontak->email }}"
                                            class="text-decoration-none">{{ $kontak->email }}</a>
                                    </td>
                                    <td>
                                        @if ($kontak->telepon)
                                            <a href="tel:+62{{ $kontak->telepon }}"
                                                class="text-decoration-none">+62{{ $kontak->telepon }}</a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $subjekColors = [
                                                'Informasi Wisata' => 'primary',
                                                'Bantuan Perjalanan' => 'info',
                                                'Saran & Masukan' => 'success',
                                                'Kerjasama' => 'warning',
                                                'Keluhan' => 'danger',
                                                'Lainnya' => 'secondary',
                                            ];
                                            $subjekColor = $subjekColors[$kontak->subjek] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $subjekColor }}">{{ $kontak->subjek }}</span>
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'baru' => 'warning',
                                                'dibaca' => 'info',
                                                'diproses' => 'primary',
                                                'selesai' => 'success',
                                            ];
                                            $statusColor = $statusColors[$kontak->status] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $statusColor }}">{{ ucfirst($kontak->status) }}</span>
                                    </td>
                                    <td>
                                        <!-- Tombol Lihat Detail -->
                                        <button type="button" class="btn btn-info btn-sm"
                                            onclick="viewKontak({{ $kontak->id }})" title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>

                                        <!-- Tombol Status Management -->
                                        @if ($kontak->status == 'baru' || $kontak->status == 'dibaca')
                                            <form action="{{ route('admin.kontak.diproses', $kontak) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-primary btn-sm"
                                                    title="Tandai Diproses">
                                                    <i class="bi bi-gear"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if ($kontak->status == 'diproses')
                                            <form action="{{ route('admin.kontak.selesai', $kontak) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm"
                                                    title="Tandai Selesai">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Tombol Balas Email -->
                                        <button type="button" class="btn btn-outline-success btn-sm"
                                            onclick="replyKontak('{{ $kontak->email }}', '{{ $kontak->nama }}', '{{ $kontak->subjek }}')"
                                            title="Balas Email">
                                            <i class="bi bi-reply"></i>
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $kontak->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <form id="delete-form-{{ $kontak->id }}"
                                            action="{{ route('admin.kontak.destroy', $kontak->id) }}" method="POST"
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

    <!-- Modal Detail Kontak -->
    <div class="modal fade" id="detailKontakModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Kontak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nama:</strong></td>
                                    <td id="detail-nama"></td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td id="detail-email"></td>
                                </tr>
                                <tr>
                                    <td><strong>Telepon:</strong></td>
                                    <td id="detail-telepon"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Subjek:</strong></td>
                                    <td id="detail-subjek"></td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal:</strong></td>
                                    <td id="detail-tanggal"></td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td id="detail-status"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <strong>Pesan:</strong>
                            <div class="border rounded p-3 mt-2" id="detail-pesan"
                                style="background-color: #f8f9fa; min-height: 100px; white-space: pre-wrap;">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3" id="detail-ip-section" style="display: none;">
                        <div class="col-12">
                            <small class="text-muted">
                                <strong>IP Address:</strong> <span id="detail-ip"></span>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-outline-success" onclick="replyFromDetail()">
                        <i class="bi bi-reply"></i> Balas Email
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let currentDetailData = {};

        // Lihat detail kontak
        function viewKontak(id) {
            fetch(`/dashboard/kontak-dashboard/${id}`)
                .then(response => response.json())
                .then(data => {
                    currentDetailData = data;

                    document.getElementById('detail-nama').textContent = data.nama;
                    document.getElementById('detail-email').innerHTML =
                        `<a href="mailto:${data.email}">${data.email}</a>`;
                    document.getElementById('detail-telepon').innerHTML = data.telepon ?
                        `<a href="tel:+62${data.telepon}">+62${data.telepon}</a>` : '-';
                    document.getElementById('detail-subjek').innerHTML =
                        `<span class="badge bg-primary">${data.subjek}</span>`;
                    document.getElementById('detail-tanggal').textContent = new Date(data.tanggal_kontak)
                        .toLocaleString('id-ID');
                    document.getElementById('detail-status').innerHTML =
                        `<span class="badge bg-${getStatusColor(data.status)}">${data.status}</span>`;
                    document.getElementById('detail-pesan').textContent = data.pesan;

                    if (data.ip_address) {
                        document.getElementById('detail-ip').textContent = data.ip_address;
                        document.getElementById('detail-ip-section').style.display = 'block';
                    } else {
                        document.getElementById('detail-ip-section').style.display = 'none';
                    }

                    new bootstrap.Modal(document.getElementById('detailKontakModal')).show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat detail kontak');
                });
        }

        // Balas email
        function replyKontak(email, nama, subjek) {
            const subject = `Re: ${subjek}`;
            const body =
                `Halo ${nama},\n\nTerima kasih telah menghubungi Wonderful Ternate.\n\n\n\nSalam,\nTim Wonderful Ternate`;
            const mailtoLink = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
            window.location.href = mailtoLink;
        }

        function replyFromDetail() {
            if (currentDetailData.email) {
                replyKontak(currentDetailData.email, currentDetailData.nama, currentDetailData.subjek);
            }
        }



        // Helper function
        function getStatusColor(status) {
            const colors = {
                'baru': 'warning',
                'dibaca': 'info',
                'diproses': 'primary',
                'selesai': 'success'
            };
            return colors[status] || 'secondary';
        }
    </script>
@endsection
