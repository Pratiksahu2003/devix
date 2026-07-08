<section class="bg-surface-muted p-8 rounded-2xl border border-border-subtle space-y-6 reveal-up is-visible">
    <div class="text-center max-w-2xl mx-auto">
        <h2 class="text-3xl font-serif text-brand-lens-blue">Service Area & Location Coverage</h2>
        <p class="text-text-muted">Convenient professional support for clients near {{ $location['name'] ?? 'Dwarka' }}.</p>
    </div>
    <div class="max-w-4xl mx-auto space-y-6">
        <p class="text-text-muted text-lg leading-relaxed text-center">
            {{ $page['sections']['local_coverage'] ?? '' }}
        </p>

        @if(!empty($location['nearby_areas']))
            <div class="flex flex-wrap justify-center gap-2 pt-2">
                @foreach($location['nearby_areas'] as $area)
                    <span class="px-3 py-1 bg-white border border-border-subtle text-text-muted rounded-full text-sm font-medium shadow-sm">
                        {{ $area }}
                    </span>
                @endforeach
            </div>
        @endif

        <div class="bg-white p-6 rounded-xl border border-border-subtle shadow-sm space-y-4">
            <h3 class="font-serif text-xl text-brand-lens-blue font-bold">Directions & Travel Context</h3>
            <p class="text-text-muted leading-relaxed">
                {{ $location['travel_context'] ?? '' }}
            </p>
        </div>
    </div>
</section>
