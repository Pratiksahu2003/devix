@props(['links' => []])

@if(count($links))
<section class="py-6 bg-white border-t border-border-subtle">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
            <div>
                <h2 class="text-sm font-bold text-text-main">Related Studio Pages</h2>
                <p class="text-xs text-text-muted mt-0.5">Connected services, locations, and guides across Delhi NCR</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('seo.resources') }}" class="rounded-md border border-border-subtle px-3 py-1.5 text-[10px] font-semibold text-text-main hover:border-brand-lens-blue transition">Resources</a>
                <a href="{{ route('seo.directory') }}" class="rounded-md bg-brand-lens-blue px-3 py-1.5 text-[10px] font-semibold text-white hover:opacity-90 transition">Directory</a>
            </div>
        </div>
        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5">
            @foreach($links as $group => $groupLinks)
                <div class="rounded-lg border border-border-subtle bg-surface-muted p-3">
                    <h3 class="text-[10px] font-bold uppercase tracking-wider text-brand-lens-blue mb-2">{{ $group }}</h3>
                    <ul class="space-y-1">
                        @foreach(array_slice($groupLinks, 0, 8) as $link)
                            <li>
                                <a href="{{ $link['url'] }}" class="text-[11px] text-text-muted hover:text-brand-lens-blue leading-snug line-clamp-2 transition">{{ $link['label'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
