@props(['facility'])

<a href="{{ route('fasilitas.detail', $facility->slug) }}" {{ $attributes->class(['photo-card group block']) }}>
    <x-front.picture :src="$facility->gambar" :alt="$facility->name" sizes="(min-width: 1024px) 33vw, 100vw"
        class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105" />
    <div class="absolute inset-0 bg-gradient-to-t from-volcanic/85 via-volcanic/5 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 p-5 text-white">
        <h3 class="font-display text-2xl">{{ $facility->name }}</h3>
        <p class="mt-1 line-clamp-2 text-sm text-white/80">{{ Str::limit(trim(strip_tags((string) $facility->deskripsi)), 90) }}</p>
    </div>
</a>
