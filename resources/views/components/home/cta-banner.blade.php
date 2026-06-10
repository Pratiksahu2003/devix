<section class="relative bg-slate-950 py-24 text-white overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('storage/room/IMG_0779.jpeg') }}" alt="DyWix studio interior" class="h-full w-full object-cover">
    </div>
    <div class="absolute inset-0 bg-linear-to-t from-slate-950 via-slate-950/80 to-transparent"></div>

    <div class="relative z-10 mx-auto max-w-4xl px-4 text-center reveal-up" x-intersect="$el.classList.add('is-visible')">
        <h2 class="text-4xl font-bold tracking-tight sm:text-5xl mb-6">Ready to Create?</h2>
        <p class="text-xl text-slate-300 mb-10">Located in Dwarka Sector 13, Delhi NCR. Open 24/7 for your creative needs.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('pages.booking') }}" class="inline-flex items-center justify-center rounded-full bg-white px-8 py-4 text-sm font-bold text-slate-900 hover:bg-slate-100 transition">
                Book Your Slot
            </a>
            <a href="{{ config('company.map.view_url') }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center rounded-full border border-white/30 bg-white/10 px-8 py-4 text-sm font-bold text-white backdrop-blur-md hover:bg-white/20 transition">
                <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Get Directions
            </a>
        </div>
    </div>
</section>
