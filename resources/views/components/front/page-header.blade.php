@props(['eyebrow' => null, 'title', 'subtitle' => null, 'image' => null])

<header class="dark-surface relative isolate overflow-hidden bg-volcanic pb-16 pt-36 text-white sm:pb-24 sm:pt-44">
    @if ($image)
        <div class="absolute inset-0 -z-20 bg-navy">
            <x-front.picture :src="$image" alt="" sizes="100vw" data-parallax="0.15" :eager="true" class="relative -top-[15%] h-[130%] w-full object-cover" />
        </div>
        <div class="absolute inset-0 -z-10 bg-gradient-to-t from-volcanic via-volcanic/50 to-volcanic/40"></div>
    @endif
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-up max-w-3xl">
            @if ($eyebrow)
                <p class="eyebrow">{{ $eyebrow }}</p>
            @endif
            <h1 class="mt-3 font-display text-4xl leading-[1.05] sm:text-6xl lg:text-7xl">{{ $title }}</h1>
            @if ($subtitle)
                <p class="mt-5 max-w-2xl text-base text-white/80 sm:text-lg">{{ $subtitle }}</p>
            @endif
            {{ $slot }}
        </div>
    </div>
</header>
