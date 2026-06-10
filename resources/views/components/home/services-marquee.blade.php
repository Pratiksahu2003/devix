<section class="relative overflow-hidden bg-slate-950 py-6 md:py-8 border-b border-white/10">
    <div class="pointer-events-none absolute inset-y-0 left-0 w-32 bg-linear-to-r from-slate-950 to-transparent z-10"></div>
    <div class="pointer-events-none absolute inset-y-0 right-0 w-32 bg-linear-to-l from-slate-950 to-transparent z-10"></div>

    <div class="marquee-track flex items-center gap-16 hover:[animation-play-state:paused]">
        <div class="flex items-center gap-16 shrink-0">
            @foreach (['Video Production', 'Podcast & Interview', 'Professional Model Portfolio', 'Live Streaming', 'Advertisement', 'Professional Photography', 'Video Editing', 'Studio for Rentals', 'Kid Portfolio Shoot', 'Creative Space'] as $index => $text)
            <div class="flex items-center gap-6">
                <span class="text-2xl font-black uppercase italic tracking-tighter transition-colors duration-300 hover:text-brand-lens-blue {{ $index % 2 != 0 ? 'text-transparent' : 'text-white' }}"
                    @if ($index % 2 != 0) style="-webkit-text-stroke: 1px rgba(255,255,255,0.35);" @endif>
                    {{ $text }}
                </span>
                <svg class="h-8 w-8 text-brand-lens-blue animate-spin-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            @endforeach
        </div>
    </div>
</section>
