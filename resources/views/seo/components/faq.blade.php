<section class="space-y-6 max-w-4xl mx-auto reveal-up is-visible">
    <div class="text-center max-w-2xl mx-auto">
        <h2 class="text-3xl font-serif text-brand-lens-blue">Frequently Asked Questions</h2>
        <p class="text-text-muted">Answers to common queries about our studio features, bookings, and location.</p>
    </div>
    <div class="space-y-4 pt-4">
        @foreach($faqs as $index => $faq)
            <details class="group bg-white border border-border-subtle rounded-xl p-5 shadow-sm [&_summary::-webkit-details-marker]:hidden" @if($index === 0) open @endif>
                <summary class="flex items-center justify-between cursor-pointer focus:outline-none">
                    <h3 class="text-lg font-semibold text-text-main pr-4">
                        {{ $faq['question'] }}
                    </h3>
                    <span class="ml-1.5 flex-shrink-0 rounded-full bg-brand-lens-blue-soft p-1.5 text-brand-lens-blue group-open:rotate-180 transition duration-300">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </summary>
                <p class="mt-4 leading-relaxed text-text-muted text-sm border-t border-border-subtle pt-4">
                    {{ $faq['answer'] }}
                </p>
            </details>
        @endforeach
    </div>
</section>
