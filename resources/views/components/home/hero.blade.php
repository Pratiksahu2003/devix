@props(['slides' => []])

<section class="relative w-full min-h-[85vh] md:min-h-[80vh] flex items-center overflow-hidden group"
    x-data="{ slide: 0, total: {{ count($slides) }}, paused: false, startTimer() { return setInterval(() => { if (!this.paused) this.slide = (this.slide + 1) % this.total }, 4500) }, timer: null }"
    x-init="timer = startTimer(); $watch('slide', () => { clearInterval(timer); timer = startTimer() })"
    @mouseenter="paused = true"
    @mouseleave="paused = false">
    <div class="absolute inset-0">
        @foreach ($slides as $i => $img)
        <div x-show="slide === {{ $i }}"
            x-transition:enter="transition ease-out duration-1200"
            x-transition:enter-start="opacity-0 scale-110"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-1200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-105"
            class="absolute inset-0"
            :class="{ 'z-10': slide === {{ $i }} }">
            <img src="{{ $img }}" alt="DyWix studio {{ $i + 1 }}" class="h-full w-full object-cover object-center" fetchpriority="{{ $i === 0 ? 'high' : 'auto' }}" width="1920" height="1080">
        </div>
        @endforeach
        <div class="absolute inset-0 z-20 bg-linear-to-r from-slate-950 via-slate-950/90 to-slate-950/40 pointer-events-none"></div>
        <div class="absolute inset-0 z-20 bg-linear-to-t from-slate-950/60 via-transparent to-slate-950/30 pointer-events-none"></div>
        <div class="absolute top-8 left-8 right-8 h-px bg-linear-to-r from-transparent via-brand-lens-blue/40 to-transparent z-20 pointer-events-none"></div>
    </div>

    <div class="relative z-30 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-12 lg:gap-16">
            <div class="max-w-2xl reveal-up" x-intersect="$el.classList.add('is-visible')">
                <div class="inline-flex items-center gap-2 rounded-full border border-brand-lens-blue/50 bg-brand-lens-blue/15 px-4 py-2 mb-6 backdrop-blur-sm">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-[10px] font-bold tracking-[0.35em] text-brand-lens-blue-soft uppercase">Studio Open 24/7</span>
                </div>

                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white leading-[1.05] tracking-tight">
                    <span class="block font-sans">Your Creative</span>
                    <span class="block mt-1 font-serif bg-linear-to-r from-white via-brand-lens-blue-soft to-brand-lens-blue bg-clip-text text-transparent bg-size-[200%_auto] animate-gradient">Space Awaits</span>
                </h1>
                <p class="mt-5 text-lg md:text-xl text-slate-300 max-w-lg leading-relaxed">
                    Pro gear, versatile sets & 24/7 access. Podcast, fashion, product, commercial & videography — all under one roof in Delhi NCR.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('pages.booking') }}" class="group/btn inline-flex items-center gap-2 rounded-full bg-brand-lens-blue px-8 py-4 text-sm font-bold text-white shadow-[0_0_40px_rgba(0,74,173,0.4)] transition-all duration-300 hover:bg-[#003a88] hover:shadow-[0_0_50px_rgba(0,74,173,0.6)] hover:scale-105 active:scale-[0.98]">
                        Book Now
                        <svg class="h-5 w-5 transition-transform group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <a href="{{ route('pages.gallery') }}" class="inline-flex items-center gap-2 rounded-full border-2 border-white/40 bg-white/5 px-8 py-4 text-sm font-semibold text-white backdrop-blur-sm transition-all duration-300 hover:bg-white/15 hover:border-white/60">
                        View Gallery
                    </a>
                </div>

                <div class="mt-6 flex flex-wrap gap-8 text-slate-400 text-sm">
                    <span><span class="font-bold text-white">1000+</span> Shoots</span>
                    <span><span class="font-bold text-white">250+</span> Clients</span>
                    <span><span class="font-bold text-brand-lens-blue-soft">24/7</span> Access</span>
                </div>
            </div>

            <div class="hidden lg:block shrink-0 reveal-up delay-200" x-intersect="$el.classList.add('is-visible')">
                <div class="relative w-72 xl:w-80 aspect-4/5 rounded-2xl overflow-hidden border-2 border-white/20 shadow-2xl shadow-black/50 ring-2 ring-brand-lens-blue/20">
                    @foreach ($slides as $i => $img)
                    <div x-show="slide === {{ $i }}"
                        x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-500"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute inset-0">
                        <img src="{{ $img }}" alt="DyWix studio" class="h-full w-full object-cover" loading="lazy" decoding="async" width="320" height="400">
                    </div>
                    @endforeach
                    <div class="absolute inset-0 bg-linear-to-t from-slate-950/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <span class="text-xs font-bold tracking-widest text-white/90 uppercase">{{ config('company.brand') }} Studio</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-6 right-6 flex gap-2 z-30">
            @foreach (range(0, count($slides) - 1) as $i)
            <button @click="slide = {{ $i }}" class="rounded-full transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-brand-lens-blue/60"
                :class="slide === {{ $i }} ? 'bg-brand-lens-blue w-8 h-2' : 'bg-white/30 hover:bg-white/50 w-2 h-2'"
                aria-label="Slide {{ $i + 1 }}"></button>
            @endforeach
        </div>
    </div>
</section>
