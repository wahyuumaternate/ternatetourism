<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-building"></i><span>Profil</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('visimisi.index') }}">
                        <i class="bi bi-circle"></i><span>Visi & Misi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('struktur.index') }}">
                        <i class="bi bi-circle"></i><span>Struktur Organisasi</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#publikasi" data-bs-toggle="collapse" href="#">
                <i class="bi bi-newspaper"></i><span>Publikasi</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="publikasi" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('berita.index') }}">
                        <i class="bi bi-circle"></i><span>Berita</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('events.index') }}">
                        <i class="bi bi-circle"></i><span>Events</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#media" data-bs-toggle="collapse" href="#">
                <i class="bi bi-collection-play"></i><span>Media</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="media" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('media.index') }}">
                        <i class="bi bi-circle"></i><span>Foto</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('indexVidio.index') }}">
                        <i class="bi bi-circle"></i><span>Vidio</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('ebooks.index') }}">
                        <i class="bi bi-circle"></i><span>E-Book</span>
                    </a>
                </li> --}}
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#fasilitas" data-bs-toggle="collapse" href="#">
                <i class="bi bi-stars"></i><span>Fasilitas</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="fasilitas" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('fasilitas.kategori', 'hotel') }}">
                        <i class="bi bi-circle"></i><span>Hotel</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('fasilitas.kategori', 'travel') }}">
                        <i class="bi bi-circle"></i><span>Travel</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('fasilitas.kategori', 'cafe-restorant') }}">
                        <i class="bi bi-circle"></i><span>Cafe & Restorant</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('fasilitas.kategori', 'guide') }}">
                        <i class="bi bi-circle"></i><span>Guide</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('fasilitas.kategori', 'rent-car') }}">
                        <i class="bi bi-circle"></i><span>Rent Car</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('destinations.index') }}">
                <i class="bi bi-geo-alt"></i>
                <span>Destinasi</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#ekraf-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bag-check"></i><span>Ekraf</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="ekraf-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('ekrafs.index') }}">
                        <i class="bi bi-circle"></i><span>List Ekraf</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('ekraf-categories.index') }}">
                        <i class="bi bi-circle"></i><span>Sub Sektor Ekraf</span>
                    </a>
                </li>
            </ul>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('ekrafs.index') }}">
                <i class="bi bi-bag-check"></i>
                <span>Ekraf</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('manajemen.media.index') }}">
                <i class="bi bi-camera-reels"></i>
                <span>Manajemen Media</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#pengaturan" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gear"></i><span>Pengaturan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="pengaturan" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('media.index') }}">
                        <i class="bi bi-circle"></i><span>Hotel</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('indexVidio.index') }}">
                        <i class="bi bi-circle"></i><span>User</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
