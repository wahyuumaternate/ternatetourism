@props(['story'])

<a href="{{ route('berita.detail', $story->slug) }}" {{ $attributes->class(['group block']) }}>
    <div class="photo-card">
        <x-front.picture :src="$story->image" :alt="$story->title" sizes="(min-width: 1024px) 33vw, 100vw"
            class="aspect-[4/3] w-full object-cover transition duration-700 group-hover:scale-105" />
    </div>
    <p class="eyebrow mt-4">{{ $story->created_at->translatedFormat('d M Y') }}</p>
    <h3 class="mt-2 font-display text-2xl leading-snug text-volcanic transition group-hover:text-primary">{{ $story->title }}</h3>
    <p class="mt-2 line-clamp-2 text-sm text-volcanic/65">{{ $story->excerpt }}</p>
</a>
