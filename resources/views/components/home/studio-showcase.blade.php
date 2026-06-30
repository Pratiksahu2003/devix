@props(['podcastImages' => []])

<section class="relative bg-slate-950 py-20 text-white overflow-hidden border-t border-white/5">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div class="space-y-8 reveal-up" x-intersect="$el.classList.add('is-visible')">
                <div>
                    <span class="text-brand-lens-blue font-bold tracking-widest uppercase text-xs">The Studio</span>
                    <h2 class="mt-2 text-4xl font-bold tracking-tighter sm:text-5xl">
                        Create. Record.
                        <span class="block mt-2 text-transparent bg-clip-text bg-linear-to-r from-brand-lens-blue via-white to-brand-lens-blue-soft">Go Live.</span>
                    </h2>
                    <p class="mt-4 text-lg text-slate-400 font-light leading-relaxed">
                        A premium podcast and content studio for creators and brands. Show up and speak — we handle the production.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ([
                        ['title' => 'Crystal-Clear Audio', 'desc' => 'Shure SM7B microphones & Rodecaster Pro II for studio-quality sound.', 'icon' => 'M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z'],
                        ['title' => 'Cinematic 4K Multi-Cam', 'desc' => 'Sony Cinema Line cameras for professional video podcasts.', 'icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'],
                        ['title' => 'Plug & Record Setup', 'desc' => 'Fully equipped — perfect for podcasts, interviews & content creation.', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'wide' => true],
                    ] as $feature)
                    <div class="rounded-xl bg-white/5 p-5 border border-white/10 hover:border-brand-lens-blue/50 transition-all duration-300 hover:bg-white/10 reveal-up {{ ($feature['wide'] ?? false) ? 'sm:col-span-2' : '' }}">
                        <svg class="h-6 w-6 text-brand-lens-blue mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feature['icon'] }}" />
                        </svg>
                        <h3 class="font-bold text-white">{{ $feature['title'] }}</h3>
                        <p class="text-sm text-slate-400 mt-2">{{ $feature['desc'] }}</p>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('pages.podcast') }}" class="inline-flex items-center gap-2 rounded-full bg-brand-lens-blue px-6 py-3 text-sm font-bold text-white hover:bg-[#003a88] transition-all duration-300 hover:scale-105 active:scale-95 shadow-lg shadow-brand-lens-blue/30">
                    Explore Podcast Studio
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            @if(count($podcastImages) > 0)
                <div class="relative h-[450px] w-full rounded-2xl overflow-hidden shadow-2xl shadow-black/50 ring-2 ring-brand-lens-blue/20 reveal-up delay-200" 
                     x-intersect="$el.classList.add('is-visible')"
                     x-data="{ 
                         activeSlide: 0, 
                         images: {{ json_encode($podcastImages) }},
                         init() {
                             setInterval(() => {
                                 this.activeSlide = (this.activeSlide + 1) % this.images.length;
                             }, 4000);
                         }
                     }">
                    
                    <!-- Slides -->
                    <template x-for="(img, index) in images" :key="index">
                        <div x-show="activeSlide === index" 
                             x-transition:enter="transition ease-out duration-700"
                             x-transition:enter-start="opacity-0 scale-105"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-500"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="absolute inset-0 w-full h-full">
                            <img :src="img.src" :alt="'Podcast Studio View ' + (index + 1)" class="h-full w-full object-cover transition-transform duration-700 hover:scale-105">
                        </div>
                    </template>

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-linear-to-t from-slate-950/80 via-transparent to-transparent"></div>
                    
                    <!-- Navigation Dots -->
                    <div class="absolute top-4 right-4 flex gap-1.5 z-10 bg-black/45 backdrop-blur-md px-2.5 py-1.5 rounded-full border border-white/10">
                        <template x-for="(img, index) in images" :key="index">
                            <button @click="activeSlide = index" 
                                    :class="activeSlide === index ? 'bg-white w-4' : 'bg-white/40 hover:bg-white/70 w-1.5'" 
                                    class="h-1.5 rounded-full transition-all duration-300"
                                    :aria-label="'Go to slide ' + (index + 1)"></button>
                        </template>
                    </div>

                    <!-- Text Overlay -->
                    <div class="absolute bottom-6 left-6 right-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-emerald-500/20 px-3 py-1 text-[10px] font-bold text-emerald-400 backdrop-blur-md border border-emerald-500/30 mb-3">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span> Available Today
                        </div>
                        <h4 class="text-2xl font-bold">The Podcast Lounge</h4>
                        <p class="text-xs text-slate-300 mt-1">Ready for your next episode</p>
                    </div>
                </div>
            @else
                <div class="relative h-[450px] w-full rounded-2xl overflow-hidden shadow-2xl shadow-black/50 ring-2 ring-brand-lens-blue/20 reveal-up delay-200" x-intersect="$el.classList.add('is-visible')">
                    <img src="{{ asset('storage/room/IMG_0783.jpeg') }}" alt="Podcast Studio at DyWix" class="h-full w-full object-cover transition-transform duration-700 hover:scale-110">
                    <div class="absolute inset-0 bg-linear-to-t from-slate-950/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-emerald-500/20 px-3 py-1 text-[10px] font-bold text-emerald-400 backdrop-blur-md border border-emerald-500/30 mb-3">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span> Available Today
                        </div>
                        <h4 class="text-2xl font-bold">The Podcast Lounge</h4>
                        <p class="text-xs text-slate-300 mt-1">Ready for your next episode</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
