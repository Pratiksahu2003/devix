<section class="space-y-6 reveal-up is-visible">
    <div class="text-center max-w-2xl mx-auto">
        <h2 class="text-3xl font-serif text-brand-lens-blue">What's Included in the Service</h2>
        <p class="text-text-muted">High-end production specifications included with every session booking.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
        @foreach($features as $feature)
            <div class="flex items-center space-x-3 bg-white p-4 rounded-xl border border-border-subtle shadow-sm">
                <svg class="w-6 h-6 text-brand-lens-blue flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="text-text-main font-medium">{{ $feature }}</span>
            </div>
        @endforeach
    </div>
</section>
