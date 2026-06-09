@props([
    'title',
    'description',
    'breadcrumbs' => [],
    'badge' => 'SEO Resource Hub',
])

<section class="bg-slate-950 border-b border-white/10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 py-8">
        @if(count($breadcrumbs))
            <x-seo.breadcrumbs :crumbs="$breadcrumbs" theme="dark" />
        @endif
        <span class="inline-block rounded-md bg-white/10 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-white/80 mb-3">{{ $badge }}</span>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white">{{ $title }}</h1>
        <p class="mt-2 text-sm text-slate-300 max-w-3xl leading-relaxed">{{ $description }}</p>
        <p class="mt-3 text-xs text-slate-400 max-w-3xl leading-relaxed">
            Curated by the {{ config('company.brand') }} studio team — a verified production facility in Dwarka, Delhi NCR with 500+ completed projects.
            Every page links to real services, locations, and pricing. Updated {{ now()->format('F Y') }}.
        </p>
    </div>
</section>

<div class="bg-[var(--color-surface-muted)] py-6">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        {{ $slot }}
    </div>
</div>
