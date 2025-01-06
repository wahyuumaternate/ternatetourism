<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Profil</span><i class="bi bi-chevron-down ms-auto"></i>
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
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#publikasi" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Publikasi</span><i class="bi bi-chevron-down ms-auto"></i>
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
        </li><!-- End Forms Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#media" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Media</span><i class="bi bi-chevron-down ms-auto"></i>
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
                <li>
                    <a href="{{ route('ebooks.index') }}">
                        <i class="bi bi-circle"></i><span>E-Book</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Forms Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#fasilitas" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Fasilitas</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="fasilitas" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="forms-layouts.html">
                        <i class="bi bi-circle"></i><span>Hotel</span>
                    </a>
                </li>
                <li>
                    <a href="forms-elements.html">
                        <i class="bi bi-circle"></i><span>Travel</span>
                    </a>
                </li>
                <li>
                    <a href="forms-elements.html">
                        <i class="bi bi-circle"></i><span>Cafe & Restorant</span>
                    </a>
                </li>
                <li>
                    <a href="forms-elements.html">
                        <i class="bi bi-circle"></i><span>Guide</span>
                    </a>
                </li>
                <li>
                    <a href="forms-elements.html">
                        <i class="bi bi-circle"></i><span>Rent Car</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('destinations.index') }}">
                <i class="bi bi-person"></i>
                <span>Destinasi</span>
            </a>
        </li><!-- End Profile Page Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Ekraf</span>
            </a>
        </li><!-- End Profile Page Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('manajemen.media.index') }}">
                <i class="bi bi-person"></i>
                <span>Manajemen Media</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#pengaturan" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Pengaturan</span><i class="bi bi-chevron-down ms-auto"></i>
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
        </li><!-- End Forms Nav -->
    </ul>

</aside><!-- End Sidebar-->
