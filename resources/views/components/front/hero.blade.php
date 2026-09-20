<section data-scrub data-mouse-tilt class="dark-surface scrub-tall relative h-[220vh] bg-volcanic" aria-labelledby="hero-title">
    <div class="scrub-pin sticky top-0 flex h-screen items-end overflow-hidden text-white">
        <x-front.picture name="gamalama" :alt="__('wt.gamalama_label')" sizes="100vw" :eager="true"
            class="hero-media absolute inset-0 -z-20 h-full w-full object-cover" />
        <div class="hero-shade absolute inset-0 -z-10 bg-gradient-to-t from-volcanic/85 via-volcanic/15 to-volcanic/40"></div>

        <div class="hero-copy mx-auto w-full max-w-7xl px-4 pb-24 pt-32 sm:px-6 sm:pb-28 lg:px-8">
            <p class="eyebrow animate-fade-up">{{ __('wt.hero_label') }}</p>
            <h1 id="hero-title" class="mt-5 font-display text-5xl font-bold uppercase leading-[0.95] sm:text-7xl lg:text-8xl xl:text-9xl">
                <span class="animate-fade-up block [animation-delay:150ms]">{{ __('wt.hero_line_1') }}</span>
                <span class="animate-fade-up block [animation-delay:300ms]">{{ __('wt.hero_line_2') }}</span>
                <span class="animate-fade-up block [animation-delay:450ms]">{{ __('wt.hero_line_3') }}</span>
            </h1>
            <p class="animate-fade-up mt-6 max-w-xl text-base text-white/90 [animation-delay:600ms] sm:text-lg">{{ __('wt.hero_sub') }}</p>
            <div class="animate-fade-up mt-8 flex flex-wrap gap-3 [animation-delay:750ms]">
                <a href="#discover" class="btn-primary">{{ __('wt.hero_cta') }}</a>
                <a href="{{ route('destinasi.all') }}" class="btn-ghost">{{ __('wt.hero_cta_2') }}</a>
            </div>
        </div>

        <a href="#discover" class="hero-copy absolute bottom-6 left-1/2 hidden -translate-x-1/2 flex-col items-center gap-2 text-xs uppercase tracking-[0.3em] text-white/80 sm:flex" aria-label="{{ __('wt.scroll') }}">
            {{ __('wt.scroll') }}
            <span class="h-10 w-px animate-pulse bg-white/70"></span>
        </a>
    </div>
</section>
