 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
     <div class="container">
         <!-- <a href="#"
                ><img
                    class="navbar-brand"
                    src="https://upload.wikimedia.org/wikipedia/commons/7/75/Lambang_Kota_Ternate.png"
                    alt=""
                    width="35"
            /></a>
            <a href="#"
                ><img
                    class="navbar-brand"
                    src="https://www.kemenparekraf.go.id/_next/image?url=https%3A%2F%2Fapi2.kemenparekraf.go.id%2Fstorage%2Fapp%2Fuploads%2Fpublic%2F621%2F437%2F638%2F621437638c977337188787.png&w=3840&q=75"
                    alt=""
                    width="100"
            /></a> -->
         <a href="/"><img class="navbar-brand" src="{{ asset('assets/TTE_TOURISM_LOGO.png') }}" alt=""
                 width="80" /></a>

         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav ms-auto">
                 <li class="nav-item">
                     <a class="nav-link" href="/">Beranda</a>
                 </li>
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button"
                         data-bs-toggle="dropdown" aria-expanded="false">
                         Profil
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                         <li>
                             <a class="dropdown-item" href="{{ route('profil', 'visi-misi') }}">Visi Misi</a>
                         </li>
                         <li>
                             <a class="dropdown-item" href="{{ route('profil', 'struktur') }}">Struktur Organisasi</a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('destinasi.all') }}">Destinasi</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="/ekraf">Ekraf</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('events.all') }}">Events</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('berita.all') }}">Berita</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#contact">E-Book</a>
                 </li>
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="mediaDropdown" role="button"
                         data-bs-toggle="dropdown" aria-expanded="false">
                         Media
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="mediaDropdown">
                         <li>
                             <a class="dropdown-item" href="#">Gallery</a>
                         </li>
                         <li>
                             <a class="dropdown-item" href="#">Vidio</a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="fasilitasDropdown" role="button"
                         data-bs-toggle="dropdown" aria-expanded="false">
                         Fasilitas
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="fasilitasDropdown">
                         <li>
                             <a class="dropdown-item" href="#">Hotel</a>
                         </li>
                         <li>
                             <a class="dropdown-item" href="#">Travel</a>
                         </li>
                         <li>
                             <a class="dropdown-item" href="#">Cafe & Restorant</a>
                         </li>
                         <li>
                             <a class="dropdown-item" href="#">UMKM</a>
                         </li>
                         <li>
                             <a class="dropdown-item" href="#">Guide</a>
                         </li>
                         <li>
                             <a class="dropdown-item" href="#">Rent Car</a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item dropdown">
                     <a class="nav-link" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown"
                         aria-expanded="false">
                         <img src="{{ asset('assets/' . (app()->getLocale() == 'id' ? 'id.png' : 'en.png')) }}"
                             alt="Language" width="20" class="me-2">
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                         <li>
                             <a class="dropdown-item" href="#">
                                 <img src="{{ asset('assets/id.png') }}" alt="Indonesian" class="me-2"
                                     width="20">Indonesia
                             </a>
                         </li>
                         <li>
                             <a class="dropdown-item" href="#">
                                 <img src="{{ asset('assets/en.png') }}" alt="English" class="me-2"
                                     width="20">English
                             </a>
                         </li>
                     </ul>
                 </li>
             </ul>
         </div>
     </div>
 </nav>
