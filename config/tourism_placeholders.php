<?php

/*
|--------------------------------------------------------------------------
| Konten contoh (placeholder) frontend
|--------------------------------------------------------------------------
|
| Semua konten di sini BUKAN informasi resmi. Tampilan menandainya dengan
| label "Contoh konten". Ganti dengan data resmi (atau pindahkan ke database)
| sebelum dipublikasikan sebagai informasi wisata.
|
| Gambar mengacu ke public/assets/front/{nama}-{800|1600}.webp
|
*/

return [
    'discovery' => [
        ['label' => 'wt.disc_destinations', 'route' => ['destinasi.all'], 'image' => 'tolire'],
        ['label' => 'wt.disc_beach', 'route' => ['destinasi.all'], 'image' => 'sulamadaha'],
        ['label' => 'wt.disc_history', 'route' => ['berita.all'], 'image' => 'fora'],
        ['label' => 'wt.disc_culture', 'route' => ['berita.all'], 'image' => 'kedaton'],
        ['label' => 'wt.disc_culinary', 'route' => ['fasilitas.front', 'cafe-restorant'], 'image' => null],
        ['label' => 'wt.disc_events', 'route' => ['events.all'], 'image' => 'kora-kora'],
        ['label' => 'wt.disc_shopping', 'route' => ['ekraf.index'], 'image' => null],
        ['label' => 'wt.disc_adventure', 'route' => ['destinasi.all'], 'image' => 'batu-angus'],
    ],

    'experiences' => [
        ['title' => 'wt.exp_adventure', 'text' => 'wt.exp_adventure_text', 'image' => 'batu-angus'],
        ['title' => 'wt.exp_heritage', 'text' => 'wt.exp_heritage_text', 'image' => 'fora'],
        ['title' => 'wt.exp_culture', 'text' => 'wt.exp_culture_text', 'image' => 'kora-kora'],
        ['title' => 'wt.exp_culinary', 'text' => 'wt.exp_culinary_text', 'image' => 'ikan-nimo'],
        ['title' => 'wt.exp_island', 'text' => 'wt.exp_island_text', 'image' => 'hiri'],
    ],

    // Nama tempat mengacu ke destinasi yang sudah ada di database. Urutan/kombinasi = draft editorial.
    'itineraries' => [
        [
            'duration' => 'wt.day_1',
            'title' => 'Ternate Highlights',
            'places' => ['Fort Oranje', 'Kedaton Kesultanan Ternate', 'Danau Tolire'],
            'image' => 'tolire',
        ],
        [
            'duration' => 'wt.day_2',
            'title' => 'Culture & Nature',
            'places' => ['Makam Sultan Baabullah', 'Geowisata Batu Angus', 'Pantai Sulamadaha'],
            'image' => 'batu-angus',
        ],
        [
            'duration' => 'wt.day_3',
            'title' => 'The Complete Ternate Experience',
            'places' => ['Kedaton Kesultanan Ternate', 'Pantai Jikomalamo', 'Cengkeh Afo'],
            'image' => 'jikomalamo',
        ],
    ],

    // 'route' opsional; kartu tanpa route hanya menampilkan "segera hadir".
    'before_you_go' => [
        ['icon' => 'plane', 'title' => 'wt.before_flight', 'route' => null],
        ['icon' => 'bed', 'title' => 'wt.before_stay', 'route' => ['fasilitas.front', 'hotel']],
        ['icon' => 'car', 'title' => 'wt.before_around', 'route' => ['fasilitas.front', 'rent-car']],
        ['icon' => 'sun', 'title' => 'wt.before_weather', 'route' => null],
        ['icon' => 'wallet', 'title' => 'wt.before_tips', 'route' => null],
        ['icon' => 'pin', 'title' => 'wt.before_info', 'route' => ['kontak.create']],
    ],
];
