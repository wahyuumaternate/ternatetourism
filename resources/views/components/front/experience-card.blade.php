@props(['title', 'text', 'name'])

<article data-cover class="photo-card group aspect-[4/5] w-72 shrink-0 snap-start sm:w-80 lg:w-96">
    <x-front.picture :name="$name" :alt="$title" sizes="384px"
        class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105" />
    <div class="absolute inset-0 bg-gradient-to-t from-volcanic/90 via-volcanic/10 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 p-6 text-white">
        <h3 class="font-display text-3xl">{{ $title }}</h3>
        <p class="mt-2 text-sm text-white/80">{{ $text }}</p>
    </div>
</article>
