@extends('frontend.layouts.main')
@section('body')
    <div class="container ekraf">
        <!-- Initial Categories -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-wrap">
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-grid-fill text-primary"></i>
                            <div>Semua</div>
                            <small class="text-muted">1860</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-cup-hot-fill text-primary"></i>
                            <div>Kuliner</div>
                            <small class="text-muted">650</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-bag-fill text-primary"></i>
                            <div>Fashion</div>
                            <small class="text-muted">398</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-brush-fill text-primary"></i>
                            <div>Kriya</div>
                            <small class="text-muted">388</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-tv-fill text-primary"></i>
                            <div>Televisi & Radio</div>
                            <small class="text-muted">6</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <button class="text-decoration-none border-0 p-1" id="toggleCategories">
                Tampilkan Semua <i class="bi bi-chevron-down ms-1"></i>
            </button>
        </div>

        <!-- Hidden Categories -->
        <div class="row mb-4 d-none" id="hiddenCategories">
            <div class="col-12">
                <div class="d-flex flex-wrap">
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-book-fill text-primary"></i>
                            <div>Penerbitan</div>
                            <small class="text-muted">20</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-building text-primary"></i>
                            <div>Arsitektur</div>
                            <small class="text-muted">15</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-megaphone-fill text-primary"></i>
                            <div>Periklanan</div>
                            <small class="text-muted">18</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-music-note-beamed text-primary"></i>
                            <div>Musik</div>
                            <small class="text-muted">25</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-camera-fill text-primary"></i>
                            <div>Fotografi</div>
                            <small class="text-muted">39</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-music-player-fill text-primary"></i>
                            <div>Seni Pertunjukan</div>
                            <small class="text-muted">33</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-box-fill text-primary"></i>
                            <div>Desain Produk</div>
                            <small class="text-muted">81</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-palette-fill text-primary"></i>
                            <div>Seni Rupa</div>
                            <small class="text-muted">34</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-house-door-fill text-primary"></i>
                            <div>Desain Interior</div>
                            <small class="text-muted">20</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-film text-primary"></i>
                            <div>Film, Animasi dan Video</div>
                            <small class="text-muted">40</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-vector-pen text-primary"></i>
                            <div>DKV</div>
                            <small class="text-muted">48</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-phone-fill text-primary"></i>
                            <div>Aplikasi</div>
                            <small class="text-muted">40</small>
                        </div>
                    </a>
                    <a href="#" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-controller text-primary"></i>
                            <div>Game</div>
                            <small class="text-muted">5</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Left Sidebar and Content Area -->
        <div class="row">
            <div class="d-flex justify-content-center mb-4">
                <div class="col-6">
                    <div class="search-box">
                        <input type="text" class="form-control" placeholder="Cari Ekraf...">
                    </div>
                </div>
            </div>
            {{-- <!-- Left Sidebar -->
            <div class="col-md-3">
                <div class="search-box mb-4">
                    <input type="text" class="form-control" placeholder="Cari Ekraf...">
                </div>

                <div class="kategori-section">
                    <h6 class="text-uppercase mb-3">KATEGORI</h6>
                    <div class="d-flex flex-column gap-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="semuaKategori" checked>
                            <label class="form-check-label" for="semuaKategori">Semua Kategori</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="pelakuBisnis">
                            <label class="form-check-label" for="pelakuBisnis">Pelaku Bisnis</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="komunitasBisnis">
                            <label class="form-check-label" for="komunitasBisnis">Komunitas Bisnis</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="usahaBisnis">
                            <label class="form-check-label" for="usahaBisnis">Usaha/Bisnis</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="lembagaPendidikan">
                            <label class="form-check-label" for="lembagaPendidikan">Lembaga Pendidikan</label>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Main Content -->
            <div class="col-md-12">
                <h3 class="d-flex justify-content-center mb-4">Semua</h3>
                <div class="row g-4">
                    @for ($i = 1; $i <= 6; $i++)
                        <div class="col-md-4">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="https://via.placeholder.com/60" class="rounded"
                                        alt="Item {{ $i }}">
                                    <div>
                                        <h6 class="mb-1 fw-semibold">Paket Website UKM Bisnis</h6>
                                        <small class="text-muted">Pelaku Bisnis</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <style>
            .btn-tampil {
                cursor: pointer;
                font-size: 14px;
                border-radius: 10% !important;
            }

            .btn-tampil:hover span,
            .btn-tampil:hover i {
                color: #157347 !important;
            }

            .btn-tampil:focus {
                outline: none;
                box-shadow: none;
            }

            .category-item {
                flex: 0 0 auto;
                margin-right: 1rem;
                margin-bottom: 1rem;
            }

            .category-box {
                width: 120px;
                padding: 1rem;
                transition: all 0.3s ease;
            }

            .category-box:hover {
                transform: translateY(-3px);
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .category-box i {
                font-size: 1.5rem;
                margin-bottom: 0.5rem;
            }

            .bg-body-tertiary {
                background-color: #f8f9fa;
            }

            .btn-link:hover {
                background: none;
            }

            .kategori-section {
                background: #fff;
                padding: 20px;
                border-radius: 8px;
                border: 1px solid #dee2e6;
            }

            .form-check-input:checked {
                background-color: #198754;
                border-color: #198754;
            }

            .ekraf {
                margin-top: 120px;
                margin-bottom: 120px;
            }

            .text-primary {
                color: #ff6500 !important;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.getElementById('toggleCategories').addEventListener('click', function() {
                const hiddenCategories = document.getElementById('hiddenCategories');
                const icon = this.querySelector('i');

                if (hiddenCategories.classList.contains('d-none')) {
                    hiddenCategories.classList.remove('d-none');
                    this.innerHTML = 'Tampilkan Sedikit <i class="bi bi-chevron-up ms-1"></i>';
                } else {
                    hiddenCategories.classList.add('d-none');
                    this.innerHTML = 'Tampilkan Semua <i class="bi bi-chevron-down ms-1"></i>';
                }
            });
        </script>
    @endpush
@endsection
