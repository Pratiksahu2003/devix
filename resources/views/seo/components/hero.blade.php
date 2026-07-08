<section class="relative bg-gradient-to-br from-brand-lens-blue to-[#002f70] text-white rounded-3xl p-8 md:p-12 shadow-xl overflow-hidden reveal-up is-visible">
    <!-- Decorative glow -->
    <div class="absolute top-0 right-0 w-80 h-80 bg-brand-gold-accent opacity-10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-3xl space-y-6">
        <span class="inline-block px-3 py-1 bg-brand-gold-accent/20 border border-brand-gold-accent text-brand-gold-accent rounded-full text-xs font-semibold uppercase tracking-wider">
            Premium Studio Space
        </span>
        <h1 class="text-3xl md:text-5xl font-serif leading-tight font-bold">
            {{ $page['h1'] ?? '' }}
        </h1>
        <p class="text-lg text-gray-200 leading-relaxed">
            Ready-to-use professional environment in {{ $location['name'] ?? 'Dwarka' }} with premium camera support, acoustic isolation, and dedicated engineer assistance.
        </p>

        <!-- CTA Action Area -->
        <div class="flex flex-col sm:flex-row gap-4 pt-4">
            <a href="/contact" class="px-8 py-4 bg-brand-gold-accent text-white font-bold rounded-xl shadow-lg hover:bg-[#b0852d] transition text-center">
                Book Studio Session
            </a>
            <a href="{{ config('dywix.whatsapp_link') }}" target="_blank" rel="noopener" class="px-8 py-4 bg-[#25d366] text-white font-bold rounded-xl shadow-lg hover:bg-[#20ba56] transition text-center flex items-center justify-center space-x-2">
                <span>WhatsApp Booking</span>
            </a>
        </div>
    </div>
</section>
