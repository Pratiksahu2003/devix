@if(!empty($links))
<section class="border-t border-border-subtle pt-10 space-y-6 reveal-up is-visible">
    <h2 class="text-2xl font-serif text-brand-lens-blue font-bold text-center">Related Studio Services & Locations</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-5xl mx-auto">
        @foreach($links as $link)
            @php
                $label = ucwords(str_replace(['-in-', '-on-rent-', '-'], [' in ', ' on Rent ', ' '], ltrim($link, '/')));
                if (empty($label)) {
                    $label = 'Home';
                }
            @endphp
            <a href="{{ $link }}" class="p-3 bg-surface-muted border border-border-subtle rounded-xl text-center text-sm font-semibold text-text-muted hover:text-brand-lens-blue hover:border-brand-lens-blue transition shadow-sm truncate">
                {{ $label }}
            </a>
        @endforeach
    </div>
</section>
@endif
