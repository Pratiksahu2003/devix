<section class="bg-white py-12 border-b border-border-subtle overflow-hidden">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mb-8 text-center">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-brand-lens-blue mb-2">Our Network</p>
        <h2 class="text-2xl font-bold text-text-main tracking-tight">Trusted by Industry Leaders</h2>
    </div>

    <div class="relative w-full overflow-hidden">
        <div class="pointer-events-none absolute inset-y-0 left-0 w-24 bg-linear-to-r from-white to-transparent z-10"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 w-24 bg-linear-to-l from-white to-transparent z-10"></div>

        <div class="marquee-track flex items-center gap-12 hover:[animation-play-state:paused] py-4">
            @foreach (range(1, 2) as $loop)
            <div class="flex items-center gap-12 shrink-0">
                @foreach (range(1, 9) as $i)
                <div class="flex h-24 w-32 items-center justify-center">
                    <img src="{{ asset('brand/' . $i . '.webp') }}"
                        class="max-h-16 w-auto object-contain opacity-70 hover:opacity-100 transition-opacity"
                        alt="Client logo {{ $i }}" loading="lazy" width="128" height="64">
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</section>
