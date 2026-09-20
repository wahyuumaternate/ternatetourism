# TASK: Redesign frontend "Wonderful Ternate" (Laravel 12 + Blade + Tailwind CSS)

Kamu bekerja di proyek Laravel yang sudah berjalan (`/Users/.../ternatetourism`). Redesign SELURUH tampilan publik (frontend) menjadi website pariwisata destinasi modern. Backend/admin (`resources/views/admin`, `/dashboard`) TIDAK boleh diubah.

Referensi konten & struktur: https://wonderful.ternatekota.go.id/ (baca untuk memahami konten, bukan untuk meniru tampilan).

## 0. LANGKAH WAJIB SEBELUM MENULIS KODE
1. Baca: `routes/web.php`, `app/Http/Controllers/FrontendController.php`, `DestinationController`, `EventsController`, `FasilitasController`, `EkrafController`, `BeritaController`, `MediaController`, semua model di `app/Models`, dan semua view di `resources/views/frontend` (+ `layouts/main.blade.php`, `navbar`, `footer`).
2. Baca `resources/lang/{id,en,ar}/pesan.php` dan `config/languages.php`. Semua teks baru harus lewat `__('pesan.xxx')` dan ditambahkan ke ketiga bahasa (id utama, en kedua, ar boleh disalin dari en jika belum ada terjemahan).
3. Buat rencana singkat (peta halaman lama -> baru, data yang dipakai per section) dan tunggu konfirmasi saya sebelum mengubah banyak file.
4. Kerjakan bertahap, satu tahap per commit-able unit: (a) fondasi layout + Tailwind, (b) beranda, (c) daftar & detail destinasi, (d) event, (e) halaman lain, (f) search, (g) polish/perf/SEO.

## 1. KONDISI TEKNIS SAAT INI (jangan diasumsikan lain)
- Laravel 12, PHP 8.3. Frontend lama memakai Bootstrap 5 CDN + Owl Carousel + jQuery + Fancybox + AOS + Bootstrap Icons, layout di `frontend/layouts/main.blade.php`.
- Tailwind 3 + Vite sudah terpasang (`tailwind.config.js`, `vite.config.js`, `resources/css/app.css`, `resources/js/app.js`) tapi hanya dipakai halaman auth.
- Leaflet sudah ada lokal di `public/leaflet`. Gunakan itu + OpenStreetMap.
- Model & kolom yang TERSEDIA:
  - `Destination`: name, image, description, lat, long, slug (TIDAK ada kategori, lokasi teks, galeri)
  - `Events`: name, slug, location, date, time, detail, lat, long, poster
  - `Fasilitas`: name, gambar, slug, deskripsi, kategori (enum)
  - `Ekraf` (+`EkrafCategories`): name, logo, description, category, address, phone, email, website, social_media, jumlah_produk
  - `Berita`: title, slug, excerpt, image, views, content
  - `Media`: title, type (photo|video), file, description
  - `Hero`: image, title, description; `Partner`; `StrukturDanVisi` (profil); `Kontak`; `Flight` (tiket pesawat)
- Aset gambar yang sudah ada di `public/assets` (mis. `banner_WT_2.jpg`, `DJI_20250104094318_0007_D.jpeg`, `batu_angus.jpg`, `sulamadaha.jpg`, `jiko*.jpg`, `kora_kora.jpg`, `hiri.JPG`, `ikannimo.JPG`, logo pemkot, logo WT). Pakai aset ini dulu sebelum placeholder.

## 2. KEPUTUSAN ARSITEKTUR
- Migrasi frontend ke Tailwind CSS (via Vite), HAPUS ketergantungan Bootstrap/jQuery/Owl di halaman publik. Alpine.js (sudah ada di devDependencies) untuk interaksi (navbar, drawer, search, tab, filter). Carousel/scroll horizontal pakai CSS scroll-snap, bukan plugin.
- Buat layout baru `resources/views/frontend/layouts/app.blade.php`; jangan menimpa `main.blade.php` sampai halaman baru siap, agar situs tidak rusak di tengah jalan. Hapus file `* copy.php` yang tidak terpakai HANYA setelah saya setuju.
- Komponen Blade anonim di `resources/views/components/front/`: `navbar`, `hero`, `discovery-card`, `destination-card`, `experience-card`, `culture-card`, `culinary-card`, `event-card`, `map-explorer`, `itinerary-card`, `travel-info-card`, `gallery`, `search`, `footer`, `section-heading`, `reveal` (scroll reveal).
- Tambahkan token warna & font di `tailwind.config.js`: 
  primary `#0B6E69`, ocean `#087EA4`, navy `#123B4A`, volcanic `#172026`, sand `#F5E9D4`, gold `#D9A441`, surface `#F7F7F4`.
  Font: Playfair Display (heading) + Plus Jakarta Sans (body), self-host atau Google Fonts dengan `display=swap` + preconnect.
- Hormati `prefers-reduced-motion`.

## 3. ATURAN KONTEN (PALING PENTING)
- Jangan mengarang harga tiket, jam buka, nomor kontak, alamat, event, jarak, fasilitas, statistik.
- Data dari database ditampilkan apa adanya. Bila sebuah section butuh data yang belum ada di DB (kuliner, budaya/sejarah, itinerary, tips perjalanan, cuaca, ketinggian Gamalama, dll):
  - Gunakan salah satu: (a) data dari `Fasilitas`/`Berita`/`Ekraf` bila memang relevan, (b) placeholder yang diberi label jelas "Contoh konten" / badge "Draft", (c) sembunyikan section jika kosong (`@if($x->isNotEmpty())`).
  - Kumpulkan semua placeholder dalam satu file (`config/tourism_placeholders.php` atau seeder), agar mudah diganti admin nanti. Beri saya daftar placeholder di akhir tiap tahap.
- Itinerary = "rekomendasi editorial", bukan itinerary resmi. Cantumkan label itu.
- Fakta umum (Gunung Gamalama, Kesultanan Ternate, Kepulauan Rempah) hanya boleh ditulis sebagai narasi umum yang terverifikasi. Bila ragu, tandai `TODO: verifikasi` dan tanyakan saya.
- Kolom yang tidak ada (mis. kategori destinasi) JANGAN dipalsukan di UI. Jika saya butuh, usulkan migration (mis. `category`, `location_name`, `gallery`, `is_featured`, `meta_description`) beserta perubahan form admin, dan minta persetujuan dulu.

## 4. BRAND & TONE
Brand: WONDERFUL TERNATE. Tagline: "Discover the Wonder of Ternate".
Bahasa utama Indonesia, kedua Inggris (Arab tetap didukung karena sudah ada).
Tone: inspirational, adventurous, warm, elegant, authentic, tropical, culturally rich, modern.
Tema visual: Gunung Gamalama + laut + pulau + sejarah + budaya + kuliner + masyarakat. Prioritas: Foto > Tipografi > Konten > Dekorasi UI. Editorial, banyak whitespace, sudut membulat lembut, animasi halus 300-700ms. BUKAN tampilan pemerintahan, dashboard, atau template Bootstrap.

## 5. STRUKTUR BERANDA (urutan)
1. Navbar transparan di hero -> solid putih + border tipis saat scroll (sticky). Menu: Destinasi, Pengalaman, Budaya, Kuliner, Event, Jelajahi Ternate. Kanan: Search, Bahasa (id/en/ar via route `lang.switch`), CTA "Plan Your Trip". Mobile: hamburger -> drawer fullscreen.
   Sesuaikan menu dengan route yang benar-benar ada (`destinasi.all`, `events.all`, `fasilitas.front`, `ekraf.index`, `berita.all`, `frontFoto`, `frontVideo`, `kontak.create`, `flights.index`, `profil`). Menu tanpa halaman tujuan -> arahkan ke anchor beranda atau tandai "segera hadir", jangan link mati.
2. Hero fullscreen (data dari model `Hero` bila ada, fallback ke `assets/banner_WT_2.jpg`): label "MALUKU UTARA · INDONESIA", H1 "DISCOVER / THE WONDER / OF TERNATE", subheadline, CTA "Jelajahi Ternate" + "Lihat Destinasi", scroll indicator, slow zoom, overlay gradient tipis, preload gambar hero.
3. Quick Discovery "Apa yang ingin kamu temukan?" (8 kartu gambar+overlay; tautkan hanya ke halaman yang ada).
4. Introduction editorial asimetris ("Ternate bukan sekadar tempat untuk dikunjungi.") + "Explore the story ->" ke halaman profil.
5. Featured Destinations (masonry/asimetris) dari `Destination::latest()`, batasi 6-8. Card: gambar, nama, arrow. Hover zoom halus.
6. Experience Ternate (Adventure, Heritage, Culture, Culinary, Island Escape) horizontal scroll-snap.
7. Section Gamalama full-width (teks narasi; quick facts HANYA jika ada data terverifikasi).
8. Stories from Ternate (budaya/sejarah) dari `Berita`/`StrukturDanVisi`, layout editorial.
9. Taste of Ternate (kuliner) dari `Fasilitas` kategori kuliner bila ada, atau `Ekraf`; sembunyikan/placeholder berlabel bila tidak ada.
10. What's Happening (event): 1 featured besar + daftar kecil dari `Events` mendatang (`date >= today`), tanggal/bulan besar. Jika kosong, tampilkan empty state yang ramah, bukan event palsu.
11. Peta interaktif Leaflet+OSM: marker dari `Destination` (lat/long) dan `Events` (lat/long); filter All/Destinations/Events (Culinary/Culture hanya bila data punya koordinat). Popup: gambar, nama, kategori, deskripsi singkat, "View detail ->". Data dikirim via JSON dari controller (bukan hardcode di Blade). Validasi lat/long (kolom string!) dengan `is_numeric` sebelum dipakai.
12. Plan Your Journey: 3 kartu (1/2/3 hari) sebagai rekomendasi editorial berlabel, bukan resmi.
13. Before You Go: 6 kartu info. Tautkan ke `flights.index` untuk "How to Get Here" bila relevan. Isi lain = placeholder berlabel.
14. Galeri masonry dari `Media` type photo (lightbox ringan, tanpa jQuery/Fancybox) + CTA "Follow @wonderfulternate" (akun sosial resmi sudah ada di `footer.blade.php`; gunakan URL yang sama).
15. CTA besar "Your Ternate Story Starts Here." + tombol "Start Exploring".
16. Footer modern: logo WT, tagline, navigasi, Contact/Privacy/Terms (halaman yang belum ada -> `#` berlabel atau dibuat sederhana), sosial (Instagram, Facebook, YouTube, TikTok dari footer lama; hapus Twitter jika akun resmi tidak ada), "Pemerintah Kota Ternate" + logo pemkot/Pesona Indonesia yang sudah ada.

## 6. HALAMAN LAIN
- Detail destinasi (`destinasi.show`): hero fullwidth, nama, lokasi (koordinat dari DB), Overview (dari `description`), Highlights/Things to do/Gallery hanya jika data ada, peta lokasi Leaflet, "Nearby" dihitung dari lat/long (haversine, jarak dihitung otomatis, bukan diketik manual), CTA "Explore More Destinations".
- Daftar destinasi, event (daftar + detail), berita, ekraf, fasilitas, galeri foto/video, kontak, tiket pesawat, profil: restyle dengan design system yang sama; logika controller/route dipertahankan.
- Global search: autocomplete Alpine + endpoint JSON baru (`/search?q=`), throttle, hasil dikelompokkan (Destinasi, Event, Fasilitas, Ekraf, Berita/Artikel) dari tabel yang ada; placeholder "Cari destinasi, kuliner, budaya, atau event...". Escape input, minimal 2 karakter, batasi hasil.

## 7. SEO, PERFORMA, AKSESIBILITAS
- Setiap halaman: `<title>`, meta description, Open Graph, Twitter card, canonical, `lang` mengikuti locale (saat ini hardcode `en`), hreflang bila memungkinkan. JSON-LD `TouristAttraction`/`Event` pada detail destinasi/event, hanya dengan field yang benar-benar ada.
- Satu H1 per halaman, heading semantik, `aria-label`, alt text bermakna (dari nama/judul), focus ring terlihat, navigasi keyboard penuh (drawer & search trap focus), kontras WCAG AA.
- Gambar: `loading="lazy"`, `decoding="async"`, width/height atau aspect-ratio (cegah CLS), `fetchpriority="high"` + preload untuk hero. Untuk gambar yang diunggah admin, buat varian WebP + `srcset` memakai `intervention/image-laravel` yang sudah terpasang (mis. helper/Blade component `<x-front.picture>` yang membuat & meng-cache varian). Jangan memuat video besar; hero pakai gambar (video opsional dengan poster + `preload="none"`).
- Bangun aset dengan `npm run build`; hilangkan CDN yang tidak lagi dipakai. Cache query beranda (mis. `Cache::remember`) bila aman.
- Responsif 320-1920px, mobile-first, tanpa horizontal scroll, CTA ramah jempol.

## 8. BATASAN
- Jangan ubah skema database, route yang sudah ada, atau logika admin tanpa persetujuan. Route baru (search, JSON peta) boleh ditambah.
- Jangan hapus file/aset lama tanpa konfirmasi. Jangan commit kecuali saya minta.
- Ikuti gaya kode proyek. Komentar seperlunya.
- Tulis Feature test sederhana untuk: beranda 200, detail destinasi 200 & 404, endpoint search, switch bahasa.

## 9. DEFINITION OF DONE per tahap
- `php artisan test` hijau, `npm run build` sukses, halaman dibuka tanpa error di 375px, 768px, 1280px.
- Laporkan: file yang dibuat/diubah, placeholder yang dipakai, data yang kurang dan usulan migration, serta hal yang perlu saya verifikasi (fakta/konten).

Mulai dari langkah 0 (baca proyek), lalu berikan rencana. Jangan menulis kode sebelum rencana saya setujui.
