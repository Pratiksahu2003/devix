@extends('seo.layout')

@section('content')
<article class="bg-surface text-text-main py-10 px-4 md:px-8">
    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Header -->
        <header class="space-y-4">
            <div class="text-sm font-semibold text-brand-gold-accent uppercase tracking-wider">
                {{ $blog['category'] ?? 'Guide' }}
            </div>
            <h1 class="text-4xl md:text-5xl font-serif text-brand-lens-blue tracking-tight leading-tight">
                {{ $blog['title'] ?? ($page['h1'] ?? '') }}
            </h1>
            <div class="flex items-center space-x-4 text-text-muted text-sm border-b border-border-subtle pb-4">
                <span>By {{ $blog['author'] ?? 'DyWix Studio' }}</span>
                <span>•</span>
                <span>Published on {{ $blog['published_at'] ?? date('Y-m-d') }}</span>
            </div>
        </header>

        <!-- Content -->
        <section class="prose max-w-none text-lg leading-relaxed text-text-muted space-y-6">
            <p class="font-medium text-text-main">{{ $blog['intro'] ?? ($page['intro'] ?? '') }}</p>
            <div class="whitespace-pre-line">
                {!! $blog['content'] ?? ($page['sections']['content'] ?? '') !!}
            </div>
        </section>

        <!-- CTAs -->
        <div class="border-t border-b border-border-subtle py-8 my-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <h3 class="text-xl font-bold font-serif text-brand-lens-blue">Need Professional Production?</h3>
                <p class="text-text-muted">Schedule your slot at DyWix Studio today.</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ config('dywix.whatsapp_link') }}" class="px-6 py-3 bg-[#25d366] text-white font-semibold rounded-lg shadow hover:bg-[#20ba56] transition">
                    WhatsApp Us
                </a>
                <a href="/contact" class="px-6 py-3 bg-brand-lens-blue text-white font-semibold rounded-lg shadow hover:bg-[#003d90] transition">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</article>
@endsection
