<section class="bg-gradient-to-br from-[#0a0f1d] to-[#121c32] text-white rounded-3xl p-8 md:p-12 shadow-xl border border-white/5 reveal-up is-visible">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div class="space-y-6">
            <h2 class="text-3xl font-serif leading-tight font-bold">
                Ready to Record or Shoot in {{ $location['name'] ?? 'Delhi NCR' }}?
            </h2>
            <p class="text-gray-400 leading-relaxed text-sm">
                Secure your booking slot today. Walk into our Dwarka Sector 13 studio floor, and start recording with zero setup time.
            </p>
            <div class="space-y-2 text-sm text-gray-300">
                <p>📍 <strong>Address:</strong> {{ config('dywix.address') }}</p>
                <p>📞 <strong>Phone:</strong> {{ config('dywix.phone') }}</p>
                <p>✉️ <strong>Email:</strong> {{ config('dywix.email') }}</p>
            </div>
        </div>

        <div class="flex flex-col gap-4">
            <div class="bg-white/5 backdrop-blur border border-white/10 p-6 rounded-2xl space-y-4">
                <h3 class="font-serif text-lg font-semibold text-brand-gold-accent">Contact DyWix Studio</h3>
                <p class="text-xs text-gray-400 leading-relaxed">Book directly through WhatsApp or contact form to check slot availability.</p>
                <div class="flex flex-col gap-3">
                    <a href="{{ config('dywix.whatsapp_link') }}" target="_blank" rel="noopener" class="px-6 py-3 bg-[#25d366] text-white font-bold rounded-xl shadow hover:bg-[#20ba56] transition text-center flex items-center justify-center space-x-2">
                        <span>Message on WhatsApp</span>
                    </a>
                    <a href="/contact" class="px-6 py-3 bg-brand-lens-blue text-white font-bold rounded-xl shadow hover:bg-[#003d90] transition text-center">
                        Request Custom Proposal
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
