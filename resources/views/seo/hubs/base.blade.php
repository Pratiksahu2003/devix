@extends('layouts.app')

@section('title', $page['title'])

@section('seo_head')
    <x-seo.head :meta="$page['meta']" :schema="$page['schema_graph']" />
@endsection

@section('content')
    {{-- Compact Hero --}}
    <section class="relative bg-slate-950 border-b border-white/10">
        <div class="absolute inset-0">
            <img src="{{ asset($page['hero_image']) }}" alt="{{ $page['h1'] }}" class="h-full w-full object-cover opacity-40" />
            <div class="absolute inset-0 bg-linear-to-r from-slate-950 via-slate-950/90 to-slate-950/50"></div>
        </div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 py-8 sm:py-10">
            <x-seo.breadcrumbs :crumbs="$page['breadcrumbs']" theme="dark" />
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center gap-1.5 rounded-md bg-white/10 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-white/80 mb-3">{{ $page['badge'] }}</span>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white leading-tight">{{ $page['h1'] }}</h1>
                    <p class="mt-3 text-sm sm:text-base text-slate-300 leading-relaxed">{{ $page['intro'] }}</p>
                </div>
                <div class="flex flex-wrap gap-2 shrink-0">
                    <a href="{{ route('pages.booking') }}" class="inline-flex items-center gap-1.5 rounded-lg bg-white px-4 py-2.5 text-xs font-bold text-slate-900 hover:bg-slate-100 transition">Book Now</a>
                    <a href="{{ route('pages.pricing') }}" class="inline-flex items-center rounded-lg border border-white/25 px-4 py-2.5 text-xs font-semibold text-white hover:bg-white/10 transition">Pricing</a>
                    <a href="tel:{{ config('company.phone.raw') }}" class="inline-flex items-center rounded-lg border border-white/15 px-4 py-2.5 text-xs text-white/80 hover:text-white transition">{{ config('company.phone.intl') }}</a>
                </div>
            </div>
            <div class="mt-5 grid grid-cols-4 gap-2 max-w-xl">
                @foreach($page['highlights'] as $stat)
                    <div class="rounded-lg border border-white/10 bg-white/5 px-2 py-2 text-center">
                        <div class="text-lg font-bold text-white leading-none">{{ $stat['value'] }}</div>
                        <div class="text-[9px] uppercase tracking-wide text-white/45 mt-0.5">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Main compact body --}}
    <div class="bg-surface-muted py-6 sm:py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="grid lg:grid-cols-12 gap-5">

                {{-- ═══ MAIN COLUMN ═══ --}}
                <div class="lg:col-span-8 space-y-4">

                    {{-- Overview + Why Choose --}}
                    <div class="rounded-xl border border-border-subtle bg-white p-4 sm:p-5 shadow-sm">
                        <h2 class="text-base font-bold text-text-main mb-2">About {{ $page['service']['name'] }}</h2>
                        <p class="text-sm text-text-muted leading-relaxed mb-4">{{ $page['overview'] }}</p>
                        <p class="text-xs text-text-muted leading-relaxed italic border-l-2 border-brand-lens-blue pl-3 mb-4">{{ $page['author_note'] }}</p>
                        <div class="grid sm:grid-cols-2 gap-2">
                            @foreach($page['why_choose'] as $point)
                                <div class="flex gap-2 text-xs text-text-muted leading-snug">
                                    <svg class="h-3.5 w-3.5 shrink-0 text-brand-lens-blue mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    {{ $point }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- E-E-A-T Pillars --}}
                    <div class="grid sm:grid-cols-2 gap-3">
                        @foreach($page['eeat_pillars'] as $pillar)
                            <div class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-brand-lens-blue mb-1.5">{{ $pillar['title'] }}</h3>
                                <p class="text-xs text-text-muted leading-relaxed">{{ $pillar['body'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    {{-- Content Sections --}}
                    @foreach($page['sections'] as $section)
                        <article class="rounded-xl border border-border-subtle bg-white p-4 sm:p-5 shadow-sm">
                            <h2 class="text-sm font-bold text-text-main mb-2">{{ $section['title'] }}</h2>
                            <p class="text-xs sm:text-sm text-text-muted leading-relaxed">{{ $section['body'] }}</p>
                        </article>
                    @endforeach

                    {{-- Studio vs DIY --}}
                    <article class="rounded-xl border border-border-subtle bg-white p-4 sm:p-5 shadow-sm">
                        <h2 class="text-sm font-bold text-text-main mb-2">Professional Studio vs DIY Setup</h2>
                        <p class="text-xs sm:text-sm text-text-muted leading-relaxed">{{ $page['studio_comparison'] }}</p>
                    </article>

                    {{-- Equipment + Process row --}}
                    <div class="grid sm:grid-cols-2 gap-3">
                        @if(!empty($page['equipment']))
                        <div class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm">
                            <h2 class="text-sm font-bold text-text-main mb-2">Equipment Included</h2>
                            <ul class="space-y-1">
                                @foreach($page['equipment'] as $item)
                                    <li class="text-xs text-text-muted flex gap-1.5"><span class="text-brand-lens-blue">•</span>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if(!empty($page['process']))
                        <div class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm">
                            <h2 class="text-sm font-bold text-text-main mb-2">How It Works</h2>
                            <ol class="space-y-1.5">
                                @foreach($page['process'] as $i => $step)
                                    <li class="flex gap-2 text-xs text-text-muted"><span class="font-bold text-brand-lens-blue shrink-0">{{ $i + 1 }}.</span>{{ $step }}</li>
                                @endforeach
                            </ol>
                        </div>
                        @endif
                    </div>

                    {{-- Use Cases + Includes --}}
                    <div class="grid sm:grid-cols-2 gap-3">
                        <div class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm">
                            <h2 class="text-sm font-bold text-text-main mb-2">Popular Use Cases</h2>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($page['use_cases'] as $case)
                                    <span class="rounded-md bg-brand-lens-blue-soft px-2 py-1 text-[10px] font-medium text-brand-lens-blue">{{ $case }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm">
                            <h2 class="text-sm font-bold text-text-main mb-2">Package Includes</h2>
                            <ul class="space-y-1">
                                @foreach($page['includes'] as $item)
                                    <li class="text-xs text-text-muted flex gap-1.5"><span class="text-emerald-500">✓</span>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- Case Studies --}}
                    <div class="grid sm:grid-cols-2 gap-3">
                        @foreach($page['case_studies'] as $study)
                            <div class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm">
                                <h3 class="text-xs font-bold text-text-main mb-1.5">{{ $study['title'] }}</h3>
                                <p class="text-xs text-text-muted leading-relaxed">{{ $study['body'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    {{-- Expert Tips --}}
                    <div class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm">
                        <h2 class="text-sm font-bold text-text-main mb-2">Expert Tips from Our Team</h2>
                        <div class="grid sm:grid-cols-2 gap-x-4 gap-y-1.5">
                            @foreach($page['expert_tips'] as $tip)
                                <p class="text-xs text-text-muted leading-snug flex gap-1.5"><span class="text-emerald-500 shrink-0">→</span>{{ $tip }}</p>
                            @endforeach
                        </div>
                    </div>

                    {{-- Local Access --}}
                    @if(!empty($page['local_access']))
                    <div class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm">
                        <h2 class="text-sm font-bold text-text-main mb-2">Getting Here from {{ $page['local_access']['metro'] ? $page['local_info']['name'] ?? 'Your Area' : 'NCR' }}</h2>
                        <div class="grid sm:grid-cols-3 gap-3 mb-3 text-xs">
                            <div><span class="font-semibold text-text-main">Metro:</span> <span class="text-text-muted">{{ $page['local_access']['metro'] }}</span></div>
                            <div><span class="font-semibold text-text-main">Drive:</span> <span class="text-text-muted">{{ $page['local_access']['drive_time'] }}</span></div>
                            <div><span class="font-semibold text-text-main">Parking:</span> <span class="text-text-muted">{{ $page['local_access']['parking'] }}</span></div>
                        </div>
                        <ul class="space-y-1">
                            @foreach($page['local_access']['tips'] as $tip)
                                <li class="text-xs text-text-muted">• {{ $tip }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Map compact --}}
                    @if(!empty($page['local_info']))
                    <div class="rounded-xl border border-border-subtle bg-white overflow-hidden shadow-sm">
                        <div class="p-4 border-b border-border-subtle flex flex-wrap items-center justify-between gap-2">
                            <div>
                                <h2 class="text-sm font-bold text-text-main">Studio Location</h2>
                                <p class="text-xs text-text-muted mt-0.5">{{ implode(', ', config('company.address.lines')) }} · {{ config('company.address.landmark') }}</p>
                            </div>
                            <a href="{{ $page['local_info']['map_url'] }}" target="_blank" rel="noopener" class="text-xs font-semibold text-brand-lens-blue hover:underline">Directions →</a>
                        </div>
                        <iframe src="{{ $page['local_info']['embed_url'] }}" class="w-full h-48" loading="lazy" title="Studio map"></iframe>
                    </div>
                    @endif

                    {{-- Testimonials compact --}}
                    <div class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm">
                        <h2 class="text-sm font-bold text-text-main mb-3">Client Reviews</h2>
                        <div class="grid sm:grid-cols-3 gap-3">
                            @foreach($page['testimonials'] as $t)
                                <blockquote class="rounded-lg bg-surface-muted p-3">
                                    <div class="flex gap-0.5 mb-1.5">
                                        @for($s = 0; $s < ($t['rating'] ?? 5); $s++)
                                            <svg class="h-3 w-3 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                    </div>
                                    <p class="text-[11px] text-text-muted leading-relaxed italic">"{{ $t['text'] }}"</p>
                                    <footer class="mt-2 text-[10px] text-text-muted"><strong class="text-text-main">{{ $t['name'] }}</strong> · {{ $t['role'] }}, {{ $t['location'] }}</footer>
                                </blockquote>
                            @endforeach
                        </div>
                    </div>

                    {{-- FAQs — all visible, 2-col, crawlable --}}
                    <div class="rounded-xl border border-border-subtle bg-white p-4 sm:p-5 shadow-sm">
                        <h2 class="text-sm font-bold text-text-main mb-3">Frequently Asked Questions</h2>
                        <div class="grid sm:grid-cols-2 gap-x-5 gap-y-4">
                            @foreach($page['faqs'] as $faq)
                                <div>
                                    <h3 class="text-xs font-semibold text-text-main mb-1">{{ $faq['q'] }}</h3>
                                    <p class="text-xs text-text-muted leading-relaxed">{{ $faq['a'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ═══ SIDEBAR ═══ --}}
                <aside class="lg:col-span-4 space-y-4">
                    {{-- Trust card --}}
                    <div class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm lg:sticky lg:top-20">
                        <div class="flex items-center gap-2.5 mb-3">
                            <img src="{{ asset(config('company.logo')) }}" alt="{{ config('company.brand') }}" class="h-8 w-auto" />
                            <div>
                                <p class="text-xs font-bold text-text-main">{{ $page['eeat']['organization'] }}</p>
                                <p class="text-[10px] text-text-muted">{{ $page['eeat']['reviewed_by'] }} · {{ $page['eeat']['last_updated'] }}</p>
                            </div>
                        </div>
                        @foreach($page['eeat']['credentials'] as $cred)
                            <p class="text-[10px] text-text-muted flex gap-1.5 mb-1"><span class="text-brand-lens-blue">✓</span>{{ $cred }}</p>
                        @endforeach
                        <div class="mt-3 pt-3 border-t border-border-subtle flex flex-col gap-2">
                            <a href="{{ route('pages.booking') }}" class="text-center rounded-lg bg-brand-lens-blue py-2.5 text-xs font-bold text-white hover:opacity-90 transition">Book Session</a>
                            <a href="https://wa.me/91{{ config('company.phone.raw') }}" target="_blank" rel="noopener" class="text-center rounded-lg border border-border-subtle py-2.5 text-xs font-semibold text-text-main hover:bg-gray-50 transition">WhatsApp</a>
                        </div>
                    </div>

                    {{-- Pricing compact --}}
                    @if(!empty($page['pricing_context']))
                    <div class="rounded-xl border border-brand-lens-blue/30 bg-brand-lens-blue-soft p-4 shadow-sm">
                        <h3 class="text-xs font-bold text-text-main mb-2">{{ $page['service']['name'] }} · {{ $page['pricing_context']['location'] }}</h3>
                        <div class="space-y-2 mb-3">
                            <div class="flex justify-between text-xs"><span class="text-text-muted">Hourly</span><strong class="text-text-main">{{ $page['pricing_context']['hourly_from'] }}</strong></div>
                            <div class="flex justify-between text-xs"><span class="text-text-muted">Half Day</span><strong class="text-brand-lens-blue">{{ $page['pricing_context']['half_day_from'] }}</strong></div>
                            <div class="flex justify-between text-xs"><span class="text-text-muted">Full Day</span><strong class="text-text-main">{{ $page['pricing_context']['full_day_from'] }}</strong></div>
                        </div>
                        <p class="text-[10px] text-text-muted leading-snug mb-3">{{ $page['pricing_context']['note'] }}</p>
                        <a href="{{ $page['pricing_context']['booking_url'] }}" class="block text-center rounded-lg bg-brand-lens-blue py-2 text-xs font-bold text-white hover:opacity-90 transition">Book Now</a>
                    </div>
                    @endif

                    {{-- Quick links --}}
                    <div class="rounded-xl border border-border-subtle bg-white p-4 shadow-sm">
                        <h3 class="text-xs font-bold text-text-main mb-2">Explore</h3>
                        <ul class="space-y-1.5 text-xs">
                            <li><a href="{{ seo_url('service', $page['service']['slug']) }}" class="text-brand-lens-blue hover:underline">{{ $page['service']['name'] }}</a></li>
                            <li><a href="{{ route('seo.locations') }}" class="text-text-muted hover:text-brand-lens-blue">All Locations</a></li>
                            <li><a href="{{ route('seo.industries') }}" class="text-text-muted hover:text-brand-lens-blue">Industries</a></li>
                            <li><a href="{{ route('seo.guides') }}" class="text-text-muted hover:text-brand-lens-blue">Guides</a></li>
                            <li><a href="{{ route('seo.resources') }}" class="text-text-muted hover:text-brand-lens-blue">Resources Hub</a></li>
                            <li><a href="{{ route('seo.directory') }}" class="text-text-muted hover:text-brand-lens-blue">Full Directory</a></li>
                            <li><a href="{{ route('pages.gallery') }}" class="text-text-muted hover:text-brand-lens-blue">Gallery</a></li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <x-seo.internal-links :links="$internalLinks" />

    {{-- Compact CTA --}}
    <section class="bg-brand-lens-blue py-6 border-t border-white/10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <h2 class="text-base font-bold text-white">Book {{ $page['service']['name'] }} Today</h2>
                <p class="text-xs text-white/75 mt-0.5">24×7 studio in Dwarka · Equipment included · {{ config('company.phone.intl') }}</p>
            </div>
            <div class="flex gap-2 shrink-0">
                <a href="{{ route('pages.booking') }}" class="rounded-lg bg-white px-5 py-2.5 text-xs font-bold text-brand-lens-blue hover:bg-gray-100 transition">Book Now</a>
                <a href="{{ route('pages.contact') }}" class="rounded-lg border border-white/30 px-5 py-2.5 text-xs font-semibold text-white hover:bg-white/10 transition">Contact</a>
            </div>
        </div>
    </section>
@endsection
