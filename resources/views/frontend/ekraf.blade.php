@extends('frontend.layouts.main')
@section('body')
    <div class="container ekraf">
        <!-- Initial Categories -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-wrap" id="category-container">
                    <a href="{{ route('ekraf.index') }}" class="category-item text-decoration-none text-dark">
                        <div class="category-box bg-body-tertiary rounded text-center">
                            <i class="bi bi-grid-fill text-primary"></i>
                            <div>Semua</div>
                            <small class="text-muted">{{ $totalEkraf }}</small>
                        </div>
                    </a>

                    <!-- Menampilkan 5 kategori pertama -->
                    @foreach ($allCategories->take(5) as $category)
                        <a href="{{ route('ekraf.filterByCategory', $category->slug) }}"
                            class="category-item text-decoration-none text-dark">
                            <div class="category-box bg-body-tertiary rounded text-center">
                                <i class="bi {{ $category->icon ?? 'bi-collection' }} text-primary"></i>
                                <div>{{ $category->name }}</div>
                                <small class="text-muted">{{ $category->ekraf_count }}</small>
                            </div>
                        </a>
                    @endforeach

                    <!-- Menyembunyikan kategori sisanya -->
                    @foreach ($allCategories->skip(5) as $category)
                        <a href="{{ route('ekraf.filterByCategory', $category->slug) }}"
                            class="category-item text-decoration-none text-dark hidden">
                            <div class="category-box bg-body-tertiary rounded text-center">
                                <i class="bi {{ $category->icon ?? 'bi-collection' }} text-primary"></i>
                                <div>{{ $category->name }}</div>
                                <small class="text-muted">{{ $category->ekraf_count }}</small>
                            </div>
                        </a>
                    @endforeach

                </div>

                <!-- Tombol "Lihat Lebih Banyak" -->
                @if ($allCategories->count() > 5)
                    <div class="text-center">
                        <button id="load-more" class="btn border-0 btn-primary">Lihat Lebih Banyak</button>
                        <button id="collapse" class="btn border-0 btn-secondary" style="display:none;">Tutup</button>
                    </div>
                @endif
            </div>



        </div>

        <!-- Search and Content Area -->
        <div class="row">
            <div class="d-flex justify-content-center mb-4">
                <div class="col-6">
                    <div class="search-box">
                        <input type="text" class="form-control" placeholder="Cari Ekraf..." id="searchEkraf">
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-12">
                <h3 class="text-center mb-4">
                    Semua Ekraf
                </h3>
                <div class="row row-cols-1 row-cols-md-3 g-4" id="ekrafList">
                    @forelse ($ekrafs as $ekraf)
                        <div class="col">
                            <a href="/ekraf/{{ $ekraf->slug }}" class="text-decoration-none text-dark border">
                                <div class="d-flex align-items-center gap-3 p-3 border-0 rounded h-100">
                                    <!-- Gambar -->
                                    <img src="{{ $ekraf->logo ? asset('storage/' . $ekraf->logo) : 'https://via.placeholder.com/60' }}"
                                        class="rounded-circle" alt="{{ $ekraf->name }}"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                    <!-- Teks -->
                                    <div>
                                        <h6 class="mb-1 fw-semibold">{{ $ekraf->name }}</h6>
                                        <small class="text-muted">{{ $ekraf->category->name }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center text-muted">Tidak ada data untuk kategori ini</div>
                        </div>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $ekrafs->links() }}
                </div>
            </div>


        </div>
    </div>

    @push('css')
        <style>
            #ekrafList .col a {
                display: flex;
                align-items: center;
                height: 100%;
                /* Pastikan semua kolom memiliki tinggi yang sama */
            }

            #ekrafList .col img {
                width: 60px;
                height: 60px;
                object-fit: cover;
                flex-shrink: 0;
                /* Pastikan gambar tidak mengecil */
            }

            #ekrafList .col .d-flex {
                align-items: center;
                /* Gambar dan teks sejajar vertikal */
                min-height: 80px;
                /* Tetapkan tinggi minimum untuk kontainer */
            }

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

            .category-item.hidden {
                display: none;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Fungsi untuk menampilkan kategori tambahan
            document.getElementById('load-more').addEventListener('click', function() {
                // Mengambil elemen dengan ID 'category-container'
                const container = document.getElementById('category-container');

                // Mengambil kategori yang tersembunyi dan menampilkannya
                const hiddenCategories = container.querySelectorAll('.category-item.hidden');
                hiddenCategories.forEach(item => {
                    item.classList.remove('hidden'); // Hapus kelas 'hidden' untuk menampilkan
                });

                // Menyembunyikan tombol "Lihat Lebih Banyak"
                this.style.display = 'none';

                // Menampilkan tombol "Tutup"
                document.getElementById('collapse').style.display = 'inline-block';
            });

            // Fungsi untuk menutup kategori tambahan
            document.getElementById('collapse').addEventListener('click', function() {
                // Mengambil elemen dengan ID 'category-container'
                const container = document.getElementById('category-container');

                // Menyembunyikan kategori tambahan
                const allCategories = container.querySelectorAll('.category-item');
                allCategories.forEach((item, index) => {
                    if (index >= 5) {
                        item.classList.add(
                            'hidden'
                        ); // Menambahkan kelas 'hidden' untuk menyembunyikan kategori ke-6 dan seterusnya
                    }
                });

                // Menyembunyikan tombol "Tutup"
                this.style.display = 'none';

                // Menampilkan kembali tombol "Lihat Lebih Banyak"
                document.getElementById('load-more').style.display = 'inline-block';
            });

            // Menambahkan kelas 'hidden' pada kategori selain 5 pertama
            document.addEventListener('DOMContentLoaded', function() {
                const categories = document.querySelectorAll('.category-item');
                categories.forEach((item, index) => {
                    if (index >= 5) {
                        item.classList.add('hidden');
                    }
                });
            });
        </script>

        <script>
            // Search functionality
            let searchTimer;
            document.getElementById('searchEkraf').addEventListener('input', function(e) {
                clearTimeout(searchTimer);
                const query = e.target.value; // Ambil nilai input dari pencarian

                searchTimer = setTimeout(() => {
                    if (query.trim() !== '') { // Cek jika query tidak kosong
                        fetch(`/ekraf/search?query=${encodeURIComponent(query)}`) // Encode query untuk URL
                            .then(response => response.json())
                            .then(data => {
                                const ekrafList = document.getElementById('ekrafList');
                                ekrafList.innerHTML = '';

                                if (data.data.length === 0) {
                                    ekrafList.innerHTML =
                                        '<div class="text-center text-muted">Tidak ada hasil ditemukan</div>';
                                } else {
                                    data.data.forEach(ekraf => {
                                        ekrafList.innerHTML += `
                            <div class="col-md-4">
                                <a href="/ekraf/${ekraf.slug}" class="text-decoration-none text-dark">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="${ekraf.logo || 'https://via.placeholder.com/60'}" 
                                             class="rounded" alt="${ekraf.name}">
                                        <div>
                                            <h6 class="mb-1 fw-semibold">${ekraf.name}</h6>
                                            <small class="text-muted">${ekraf.category.name}</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        `;
                                    });
                                }
                            })
                            .catch(err => {
                                console.error('Error fetching search results:', err);
                            });
                    }
                }, 300);
            });
        </script>
    @endpush
@endsection
